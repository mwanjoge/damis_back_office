<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDefaultPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user has default password and is not already on the password change page
        if ($user && $user->is_default_password && !$request->routeIs('password.change') && !$request->routeIs('password.update')) {
            return redirect()->route('password.change');
        }

        return $next($request);
    }
}
