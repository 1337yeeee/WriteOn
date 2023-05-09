<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasPermission('admin')) {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}
