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


public function storeSaving(Request $request, User $user)
{
    $request->validate([
        'amount' => ['required', 'numeric', 'min:1'],
        'remark' => ['nullable', 'string', 'max:255'],
    ]);

    // OPTIONAL: block saving for other admins
    if ($user->role === 'admin' && $user->id !== auth()->id()) {
        abort(403, 'Cannot save for another admin.');
    }

    // Calculate user's approved savings so far
    $totalApproved = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->sum('amount');

    $saving = Saving::create([
        'user_id' => $user->id, // 👈 SPECIFIC USER
        'amount' => $request->amount,
        'remark' => $request->remark ?? 'Pending deposit',
        'status' => 'pending',
        'total_savings' => $totalApproved + $request->amount,
    ]);

    return redirect()->back()
        ->with('success', "Saving added for {$user->name} and pending approval.");
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
public function memberSavings(User $user) // inject the user you want
{
    // Optional: prevent admin from checking other admins
    // if ($user->role === 'admin') {
    //     abort(403, 'Cannot view admin savings.');
    // }

    // Get all savings for that member (latest first)
    $savings = Saving::where('user_id', $user->id)
        ->latest()
        ->paginate(20);

    // Total approved & applied savings
    $totalSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', true)
        ->sum('amount');

    return view('member.savings', compact('savings', 'totalSavings', 'user'));
}



}

