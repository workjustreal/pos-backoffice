<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(array('emp_id' => $input['email'], 'password' => $input['password']), true)) {
            if (Auth::user()->isAppPermission()) {
                if (!self::get_token_pos()) {
                    return redirect()->route('login')->with('error', 'ขอ Token ไม่สำเร็จ กรุณาล็อกอินใหม่');
                }
                return redirect('/home');
            } else {
                Auth::logout();
                Session::flush();
                alert()->warning('คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
                return redirect()->route('login')->with('error', 'คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
                return redirect('/login');
            }
        } else {
            return redirect()->route('login')->with('error', 'รหัสพนักงาน หรือรหัสผ่านไม่ถูกต้อง');
        }
    }

    public function autologin()
    {
        if (Auth::check()) {
            if (!self::get_token_pos()) {
                return redirect()->route('login')->with('error', 'ขอ Token ไม่สำเร็จ กรุณาล็อกอินใหม่');
            }
            if (!Auth::user()->isAppPermission()) {
                return redirect()->route('kaceecenter-callback', 'คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
            }
        }
        return redirect('/home');
    }

    public function authen_from_center(Request $request)
    {
        if ( $request->token) {
            $loginRequest = User::where(DB::raw('md5("remember_token")'),  $request->token)->first(['id']);
            if ($loginRequest) {
                Auth::loginUsingId($loginRequest->id);
                if (Auth::user()->isAppPermission()) {
                    return redirect('/home');
                } else {
                    return redirect()->route('kaceecenter-callback', 'คุณไม่มีสิทธิเข้าใช้งานระบบนี้');
                }
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }

    public function get_token_pos()
    {
        $url = '192.168.2.12:1144/api/auth/token/auto';
        $response = Http::get($url);
        if ($response->status() == '200') {
            session()->put('token', $response['data']['token']);
            return true;
        } else {
            Auth::logout();
            Session::flush();
            Session::forget('token');
            return false;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('kaceecenter-callback-logout');
    }
}