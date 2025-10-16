<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    //
    public function apply(){
        return view('loan.apply');
    }
}
