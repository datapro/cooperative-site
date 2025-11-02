<?php

namespace App\Http\Controllers\Member;
use Illuminate\Support\Facades\Auth; // Import this!
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;

class MemberSavingsController extends Controller
{


public function storesaving(Request $request)
{
    $request->validate([
        'amount' => ['required', 'string', 'max:255'],
        // 'date' => ['required', 'string', 'max:255'],
        'remark' => ['nullable|string|max:255'],

    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to make a loan payment.');
    }

    $user = Auth::user();
    Saving::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'remark' => $request->remark ?? 'Pending deposit',
            'status' => 'pending',
            'date' => now(),
        ]);

    return redirect()->back()->with('success', 'Your saving is pending admin approval.');
}


    public function  contribution(){
         $user_id = auth()->id();
        $savings = Saving::where('user_id', $user_id)
                 ->latest()  // same as orderBy('created_at', 'desc')
                 ->get();
        $total = $savings->sum('amount');
        return view('member.contribution',compact('savings','total'));
    }

    public function profile()
    {
        $user_id = auth()->id();
        $user = auth()->user();
        $savings = Saving::where('user_id', $user_id)
                 ->latest()  // same as orderBy('created_at', 'desc')
                 ->get();
        $total = $savings->sum('amount');
        // Get total loan borrowed
        $totalBorrowed = Loan::where('user_id', $user->id)->sum('amount_borrowed');

        return view('member.profile',compact('user','savings','total','totalBorrowed'));
    }




    public function memberedit($id){
        $user = User::findOrFail($id);
        return view('member.memberupdate',compact('user'));
    }


    public function memberupdate(Request $request,$id,){
        
    // If a new image is uploaded
    $user = User::findOrFail($id);

    $user->update($request->except('passport'));

    if ($request->hasFile('passport')) {

        // Delete old passport if it exists
        if ($user->passport && file_exists(public_path('images/' . $user->passport))) {
            unlink(public_path('images/' . $user->passport));
        }

        // Upload new file
        $file = $request->file('passport');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Save new filename to DB
        $user->passport = $filename;
}

    // Save other fields if any

    $user->save();
    // show savings
    $user_id = auth()->id();
    $savings = Saving::where('user_id', $user_id)
                 ->latest()  // same as orderBy('created_at', 'desc')
                 ->get();

    $total = $savings->sum('amount');
     // Get total loan borrowed
    $totalBorrowed = Loan::where('user_id', $user->id)->sum('amount_borrowed');

        return view('member.profile',compact('user','total','savings','totalBorrowed'))->with('success', 'Member updated successfully!');
 }


    // member savings show 
 public function userSavings()
 
    {
          if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to make a loan payment.');
    }
        $user = Auth::user();

    //     // Get all savings records for the user (latest first)
        $savings = Saving::where('user_id', $user->id)
            ->latest()
            ->get();

    //     // Compute total savings
    //     $total = $savings->sum('amount');

    //     // Get total loan borrowed
    //     $totalBorrowed = Loan::where('user_id', $user->id)->sum('amount_borrowed');

    //     //  Get last loan record (optional)
    //     $latestLoan = Loan::where('user_id', $user->id)->latest()->first();

    //     $latestLoanAmount = $latestLoan ? $latestLoan->amount_borrowed : 0;
    //     $deductedFromSavings = $latestLoan ? $latestLoan->deducted_from_savings : 0;

        // Pass data to Blade
        return view('member.savings',compact('savings'));
 
    }



}

