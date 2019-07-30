<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('admin/dashboard');
        }

	    if ($request->user() && ! $request->user()->subscribed('main')) {
	        // This user is not a paying customer...
	        return redirect('billing');
	    }

        return $next($request);
    }
}
