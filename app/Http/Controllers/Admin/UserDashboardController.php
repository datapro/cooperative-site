<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserDashboardController extends Controller
{
    //
    public function show(User $user)
    {
        // prevent admin dashboard being viewed as a user
        if ($user->role === 'admin') {
            abort(403);
        }

        // load user-specific data here
        return view('home', [
            'user' => $user,
        ]);
    }
}
