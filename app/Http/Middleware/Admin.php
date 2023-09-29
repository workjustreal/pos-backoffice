<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use DB;

class Admin
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
        if (Auth::check()) {
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->where('level', '=', "1")->get();
            if ($permiss->isNotEmpty()) {
                return $next($request);
            } else {
                 return redirect('/');
            }
        } else {
             return redirect('/');
        }
    }
}