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
    // Validate input
    $validated = $request->validate([
        'requested_amount' => 'required|numeric|min:1',
        'g_form' => 'required|file|mimes:pdf,doc,docx|max:4048',
    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to request loan.');
    }

    $user = Auth::user();
    if ($user->status !== 'active') {
        return back()->with('error', 'Your account is inactive. Please contact admin.');
    }

    // File upload
    $file = $request->file('g_form');
    $formName = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('forms'), $formName);

    // Save Loan
    Loan::create([
        'user_id' => $user->id,
        'requested_amount' => $validated['requested_amount'],
        'amount_repaid' => 0,
        'status' => 'pending',
        'g_form' => $formName,
    ]);

    return back()->with('success', 'Loan request submitted successfully and awaiting approval.');
}



}
