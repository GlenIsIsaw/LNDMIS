<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->role_as == 1 || Auth::user()->role_as == 0 || Auth::user()->role_as == 2)
            {
                return $next($request);
            }
            elseif (Auth::user()->role_as == 3) {
                return redirect('/college');
            }elseif (Auth::user()->role_as == 4) {
                return redirect('/invitation');
            }else
            {
                return redirect()->back()->with('message', 'Access Denied');
            }
        }
        else
        {
            return redirect()->back()->with('message', 'Please Login First');
        }
    }
}
