<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import this!
use App\Models\Saving;
use App\Models\Loan;

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
  
        $user_id = auth()->id();
        $savings = Saving::where('user_id', $user_id)
                ->latest()  // same as orderBy('created_at', 'desc')
                ->get();
        $total = $savings->sum('amount');

        return view('home',compact('savings','total'));
    }
}
