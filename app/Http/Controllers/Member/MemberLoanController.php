<?php

namespace App\Http\Controllers\Member;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import this!
use App\Models\Saving;
use App\Models\Loan;


class MemberLoanController extends Controller
{
    //
  public function requestLoan(Request $request)
{
    // Validate inputs
    $validated=$request->validate([
        'requested_amount' => 'required|numeric|min:1',
        'g_form' => 'required|file|mimes:pdf,doc,docx|max:4048', // 4MB max
    ]);
      if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to request loan.');
    }

    $user = Auth::user();
    if ($user->status !== 'active') {
        return redirect()->back()->with('error', 'Your account is inactive. Please contact admin.');
    }
    // Handle file upload
    $formName = null;
    if ($request->hasFile('g_form')) {
        $file = $request->file('g_form');
        $formName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('forms'), $formName);
    }

    // Save loan record
    $loan = Loan::create([
        'user_id' => $user->id,
        'requested_amount' => $validated['requested_amount'],
        // 'amount_borrowed' => null, // Not yet approved
        'amount_repaid' => 0,
        'status' => 'Pending Request',
        'g_form' => $formName,
    ]);

    return redirect()->back()->with('success', 'Loan request submitted successfully and awaiting approval.');

}


// pay loan

public function payLoan(Request $request)
{
    // Ensure user is logged in
    $user = Auth::user();
    
    if ($user->status !== 'active') {
        return redirect()->back()->with('error', 'Your account is inactive. Please contact admin.');
    }

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to repay a loan.');
    }

    // Find user's active or pending loan
    $loan = Loan::where('user_id', $user->id)
                ->whereIn('status', ['active', 'Pending Request'])
                ->first();

    if (!$loan) {
        return redirect()->back()->with('error', 'You have no active loan to repay.');
    }

    // Validate repayment amount
    $request->validate([
        'repayment_amount' => 'required|numeric|min:1',
    ]);

    $repaymentAmount = $request->repayment_amount;

    // Check total savings
    $totalSavings = Saving::where('user_id', $user->id)->sum('amount');

    if ($totalSavings < $repaymentAmount) {
        return redirect()->back()->with('error', 'Repayment failed — insufficient savings balance.');
    }

    // Start transaction
    DB::transaction(function () use ($user, $loan, $repaymentAmount) {

        // 1️⃣ Deduct repayment from savings
        Saving::create([
            'user_id' => $user->id,
            'amount' => -$repaymentAmount,
            'remark' => 'Loan repayment deducted from savings',
            'date' => now(),
        ]);

        // 2️⃣ Update loan repayment
        $loan->amount_repaid = ($loan->amount_repaid ?? 0) + $repaymentAmount;

        // 3️⃣ Compute remaining balance
        $borrowed = $loan->amount_borrowed ?? 0;
        $remaining = $borrowed - $loan->amount_repaid;

        // 4️⃣ Update loan status based on remaining balance
        if ($remaining <= 0) {
            $loan->status = 'cleared'; // ✅ Loan fully repaid
            $loan->amount_repaid = $borrowed; // Avoid overpaying
        } elseif ($loan->amount_repaid > 0 && $loan->amount_repaid < $borrowed) {
            $loan->status = 'active'; // ⚙️ Loan partially repaid
        } else {
            $loan->status = 'Pending Request'; // 🕐 Not yet processed
        }

        $loan->save();
    });

    return redirect()->back()->with('success', 'Loan repayment processed successfully.');
}


}
