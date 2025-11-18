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
        $interestRate = $request->input('interest_rate', $loan->interest_rate ?? 10);

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
    $user = User::with(['loans' => function ($q) {
        $q->where('status', 'approved');
    }])->findOrFail($userId);

    // Approved savings not yet used
    $approvedSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', false)
        ->sum('amount');

    // Loan repayment using form input (interest + amount paid)
    $loanRepayment = $this->calculateLoanRepayment($user, $request);

    // Determine difference
    $netToAdd = $approvedSavings - $loanRepayment;

    if ($netToAdd > 0) {

        // Save bonus to savings
        $user->total_savings += $netToAdd;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Savings Credit',
            'loan_type' => $request->input('loan_type'),
            'processing_charge' => $request->input('processing_charge') ?? 0,
            'amount' => $netToAdd,
            'note' => 'Excess repayment added to savings',
        ]);

    } else {

        $outstanding = abs($netToAdd);

        // Add deficit to most recent loan
        $latestLoan = $user->loans()->where('status', 'approved')->latest()->first();

        if ($latestLoan) {
            $latestLoan->outstanding_balance += $outstanding;
            $latestLoan->save();
        }

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Loan Repayment',
            'loan_type' => $request->input('loan_type'),
            'amount' => $outstanding,
            'processing_charge' => $request->input('processing_charge') ?? 0,
            'note' => 'Savings used for loan repayment (₦' . number_format($approvedSavings, 2) . ')',
        ]);
    }

    // Mark savings as applied
    Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->update(['is_applied' => true]);

    return back()->with('success', 'Monthly calculation completed successfully!');
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
