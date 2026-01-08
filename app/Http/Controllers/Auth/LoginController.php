<?php

namespace App\Http\Controllers\Auth;
  use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    // protected $redirectTo = '/home'; 
  

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate(); // 🔐 important security step

        $user = Auth::user();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin');
        }

        if ($user->role === 'member') {
           return redirect()->route('memberdashboard', $user->id);
        }

        // fallback (optional)
        Auth::logout();
        return redirect()->route('login')->with('error', 'Unauthorized role.');
    }

    return back()->with('error', 'Invalid email or password. Please try again.');
}
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function userlogin(){
        return view('auth.userlogin');
    }
}
