<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
// use App\Http\Requests\LoanPaymentRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;
use App\Models\User;
use App\Models\Saving;
// use App\Models\LoanRepayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanRepaymentController extends Controller
{

    // Admin approves repayment
    public function approve($id)
    {
        $repayment = LoanRepayment::findOrFail($id);
        $repayment->update(['status' => 'approved']);

        // Update loan amount repaid
        $loan = $repayment->loan;
        $loan->amount_repaid += $repayment->amount;

        // If fully paid, close loan
        if ($loan->amount_repaid >= $loan->requested_amount) {
            $loan->status = 'closed';
        }

        $loan->save();

        return back()->with('success', 'Repayment approved successfully!');
    }


protected function calculateLoanRepayment($user, Request $request)
{
    $totalRepayment = 0;

    foreach ($user->loans as $loan) {

        // Accept interest rate from form input — fallback to DB or default
        $interestRate = $request->input('interest_rate');

        // Accept amount paid by user for this cycle
        $amountPaid = $request->input('amount_paid', 0);

        // Total interest
        $interestAmount = ($loan->requested_amount * $interestRate) / 100;

        // Total amount due
        $totalDue = $loan->requested_amount + $interestAmount;

        // Outstanding balance remaining
        $outstanding = $totalDue - $loan->amount_repaid;

        if ($outstanding > 0) {

            // User's payment should not exceed outstanding
            $repayThisMonth = min($amountPaid, $outstanding);

            $totalRepayment += $repayThisMonth;

            // Update the loan amount repaid
            $loan->amount_repaid += $repayThisMonth;
            $loan->save();
        }
    }

    return $totalRepayment;
}

public function finalizeCalculations($userId, Request $request)
{
    $request->validate([
        'processing_charge' => 'nullable|numeric',
        'amount_paid' => 'required|numeric|min:0',
    ]);

    $user = User::with(['loans' => fn($q) => $q->whereIn('status', ['approved', 'complete'])])
        ->findOrFail($userId);

    if ($user->loans->isEmpty()) {
        return back()->with('error', 'No loans found for this user.');
    }

    // Total approved savings not yet applied
    $approvedSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', false)
        ->sum('amount');

    $amountPaid = $request->input('amount_paid');
    $paymentMade = false;
    $excessTotal = 0;

    foreach ($user->loans as $loan) {

        // Set loan type if not saved before
        if (!$loan->loan_type && $request->has('loan_type')) {
            $loan->loan_type = $request->loan_type;
            $loan->save();
        }

        $principal = $loan->requested_amount;
        $interest  = ($loan->interest_rate / 100) * $principal * max(1, $loan->duration);

        $totalDue  = $principal + $interest;

        // Stop if loan already fully paid
        if ($loan->amount_repaid >= $totalDue) {
            continue;
        }

        // Dynamic duration
        $durationMonths   = max(1, $loan->duration);
        $monthlyPrincipal = $principal / $durationMonths;
        $monthlyInterest  = $interest / $durationMonths;
        $monthlyExpected  = $monthlyPrincipal + $monthlyInterest;

        // Payment to apply
        $payment = min($approvedSavings + $amountPaid, $totalDue - $loan->amount_repaid);

        if ($payment <= 0) {
            continue;
        }

        $loan->amount_repaid += $payment;

        // ============================
        // CHECK FOR FULL PAYMENT + EXCESS
        // ============================

        if ($loan->amount_repaid >= $totalDue) {

            $loan->status = 'complete';

            // Find excess
            $excess = $loan->amount_repaid - $totalDue;

            if ($excess > 0) {
                $loan->excess_payment += $excess;
                $excessTotal += $excess;

                // Correct amount repaid
                $loan->amount_repaid = $totalDue;
            }
        }

        $loan->save();

        // Record repayment transaction
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Loan Repayment',
            'loan_type' => $loan->loan_type, // picked from database
            'amount' => $payment,
            'processing_charge' => $request->input('processing_charge') ?? 0,
            'note' => 'Repayment applied to loan #' . $loan->id,
            'excess_payment' => $excess ?? 0,
            
        ]);

        // Reduce savings + amount paid
        $usedFromSavings = min($approvedSavings, $payment);
        $approvedSavings -= $usedFromSavings;
        $amountPaid -= ($payment - $usedFromSavings);

        $paymentMade = true;
    }

    if (!$paymentMade) {
        return back()->with('error', 'No payment was made because all loans are fully paid!');
    }

    // Mark approved savings as used
    Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', false)
        ->update(['is_applied' => true]);


    // Show RED alert if there was excess
    if ($excessTotal > 0) {
        return back()->with('error', 
            'Loan fully paid! Excess returned: ₦' . number_format($excessTotal, 2)
        );
    }

    return back()->with('success', 'Loan repayment processed successfully!');
}



// approve and reject loan 
public function approveOrReject($id)
    {
        $loan = Loan::findOrFail($id);

        // Toggle between statuses (or set based on action)
        if ($loan->status === 'pending') {
            $loan->status = 'approved';
        } elseif ($loan->status === 'approved') {
            $loan->status = 'rejected';
        } else {
            $loan->status = 'pending';
        }

        $loan->save();

        return back()->with('success', 'Loan status updated successfully!');
    }

}
