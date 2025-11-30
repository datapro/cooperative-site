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
        'remark' => ['nullable|string|max:255'],

    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to make a loan payment.');
    }

    $user = Auth::user();
    $saving = new Saving([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'remark' => $request->remark ?? 'Pending deposit',
            'status' => 'pending',
        ]);

         // Calculate user's total savings so far
        $total = Saving::where('user_id', $request->user_id)
        ->where('status', 'approved')
        ->sum('amount');

    $saving->total_savings = $total + $request->amount;
    $saving->save();

    return redirect()->back()->with('success', 'Your saving is pending admin approval.');
}


   public function contribution()
{
    // Ensure user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to make a loan payment.');
    }

    $user = Auth::user();
    $user_id = $user->id;

    $savings = Saving::where('user_id', $user_id)
                ->latest()
                ->paginate(20);

    $totalSavings = Saving::where('user_id', $user_id)
                    ->where('status', 'approved')
                    ->where('is_applied', true)
                    ->sum('amount');

    // Pass all variables correctly
    return view('member.contribution', compact('savings', 'totalSavings', 'user'));
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
        // $totalBorrowed = Loan::where('user_id', $user->id)->sum('amount_borrowed');

        return view('member.profile',compact('user','savings','total'));
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
    // $totalBorrowed = Loan::where('user_id', $user->id)->sum('amount_borrowed');

        return view('member.profile',compact('user','total','savings'))->with('success', 'Member updated successfully!');
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
            ->paginate(20);

        $totalSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', true)
        ->sum('amount');
        
        return view('member.savings',compact('savings','totalSavings','user'));
 
    }



}

