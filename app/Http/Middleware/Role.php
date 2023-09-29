<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
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
        if (!$request->session()->exists('is_role')) {
            return redirect('/login');
        }

        // if (Auth::user()->is_role == 1) {
        //     return redirect()->route('admin');
        // }

        // if (Auth::user()->is_role == 2) {
        //     return redirect()->route('user');
        // }
        return $next($request);
    }
}
