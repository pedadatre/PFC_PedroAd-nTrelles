<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Unauthorized. Please login first.'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to access this feature.');
        }

        return $next($request);
    }
}