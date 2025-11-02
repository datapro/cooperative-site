<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanRepaymentController extends Controller
{
    //
     // Show member loan details and repayment form
    public function show($loanId)
    {
        $loan = Loan::with('repayments')->findOrFail($loanId);
         $availableSavings = $member->totalSavings();
        $outstanding = $loan->requested_amount - $loan->amount_repaid;
        
        return view('admin.repay-loan', compact('loan', 'outstanding','availableSavings'));
    }

    // Store new repayment
    public function store(Request $request, $loanId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $loan = Loan::findOrFail($loanId);

        // prevent overpayment
        if ($request->amount > ($loan->requested_amount - $loan->amount_repaid)) {
            return back()->with('error', 'Repayment amount exceeds outstanding balance.');
        }

        LoanRepayment::create([
            'loan_id' => $loan->id,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'payment_date' => now(),
            'status' => 'pending', // admin approves later
        ]);

        return back()->with('success', 'Repayment submitted for approval.');
    }

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
}
