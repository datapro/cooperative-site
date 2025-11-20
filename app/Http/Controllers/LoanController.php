<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import this!
use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;

class LoanController extends Controller
{
    //guest loan logics 
    public function apply(){
        return view('loan.apply');
    }


// member loan logics 
public function memberloan(){
    $user_id = auth()->id();
        $loans = Loan::where('user_id', $user_id)
                 ->latest()  // same as orderBy('created_at', 'desc')
                 ->paginate(20);
        
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'User not authenticated and logged out.');
        }

        $loan = Loan::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();
    return view('member.loan',compact('loans','loan'));
    }

}
