<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProductPrice
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
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->whereIn('level', [10,1])->get();
            if ($permiss->isNotEmpty()) {
                return $next($request);
            } else {
                return redirect('pos/price');
            }
        } else {
            return redirect('pos/price');
        }
    }
}