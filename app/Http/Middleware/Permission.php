<?php

namespace App\Http\Middleware;

use Auth;
use DB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Permission
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
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->get();
            if ($permiss->isNotEmpty()) {
                return $next($request);
            } else {
                return redirect()->route('kaceecenter-callback', 'คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
            }
        } else {
            return redirect()->route('kaceecenter-callback', 'คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
        }
    }
}