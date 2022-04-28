<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard('dashboard')->user()) {
            Auth::guard('dashboard')->logout();
            return redirect('dashboard\login');
        }else{
            if(Auth::guard('dashboard')->user()->isActive() != true){
                Auth::guard('dashboard')->logout();
                return redirect('dashboard\login')->with('error',__('dashboard.messages.your_account_is_in_active'));
            }
        }

        return $next($request);
    }
}
