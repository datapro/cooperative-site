<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import this!
use App\Models\Saving;
use App\Models\Loan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
  
            {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to make a loan payment.');
        }
        
        $user = Auth::user();
        $user_id = auth()->id();

        $savings = Saving::where('user_id', $user_id)
                ->latest()  // same as orderBy('created_at', 'desc')
                ->get();
        
                
        $totalSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', true)
        ->sum('amount');

        return view('home',compact('savings','totalSavings','user'));
    }
}
public function memberdashboard(user $user)
    {
         {
           // Get all savings for that member (latest first)
    $savings = Saving::where('user_id', $user->id)
        ->latest()
        ->paginate(20);

    // Total approved & applied savings
    $totalSavings = Saving::where('user_id', $user->id)
        ->where('status', 'approved')
        ->where('is_applied', true)
        ->sum('amount');

        return view('member.memberdashboard',compact('savings','totalSavings','user'));
    }
    }

}
