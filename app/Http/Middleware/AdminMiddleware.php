<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
  if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user->role === 'admin') {
        // Allow admin to continue
        return $next($request);
    }

    if ($user->role === 'member') {
        // Redirect member to their dashboard
        return redirect()->route('memberdashboard', $user->id);
    }

    // If role is something else, deny access
    abort(403, 'Unauthorized');
}
}
