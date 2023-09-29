<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Auth;

class MembermanageController extends Controller
{
    public function index()
    {
        $url = '192.168.2.12:1144/api/pos/member/permission';
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,

        ]);
        $data = $response['data'];
        $data = collect($data)->sortBy('shop_name')->toArray();
        return view('member.membermanage')->with('data', $data);
    }

    public function register()
    {
        $shop_url = '192.168.2.12:1144/api/pos/shop';
        $token = session()->get('token');
        $response = Http::get($shop_url, [
            'token' => $token,
        ]);
        $shop_data = $response['data'];
        return view('member.pos-register')->with('shop_data', $shop_data);
    }

    public function edit($id)
    {
        $shop_url = '192.168.2.12:1144/api/pos/shop';
        $token = session()->get('token');
        $response = Http::get($shop_url, [
            'token' => $token,
        ]);
        $shop_data = $response['data'];
        $url = '192.168.2.12:1144/api/pos/member/detail/' . $id;
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $data = $response['data'];
        return view('member.memberedit')->with('id', $id)->with('data', $data)->with('shop_data', $shop_data);
    }

    public function changepassword($id)
    {
        $url = '192.168.2.12:1144/api/pos/member/detail/' . $id;
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
            'id' => $id,
        ]);
        $data = $response['data'];
        return view("member.changepassword")->with('id', $id)->with('data', $data);
    }

    public function resetpass($id)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/member/item/resetpass';
        $response = Http::post($url, [
            'token' => $token,
            'id' => $id,
            'password' => "kacee",
        ]);
        if ($response->status() == 200) {
            return redirect('admin/member-manage');
            sleep(1);
        } else {
            alert()->error('ตรวจสอบข้อมูลก่อน');
            return back();
        }
    }

    public function delete($id)
    {
        $url = '192.168.2.12:1144/api/pos/member/item/del';
        $token = session()->get('token');
        Http::post($url, [
            'token' => $token,
            'id' => $id,
        ]);
        sleep(1);
        return redirect('admin/member-manage');
    }

    public function updateuser(Request $request, $id)
    {
        $url = '192.168.2.12:1144/api/pos/member/item/edit';
        $token = session()->get('token');
        $response = Http::post($url, [
            'token' => $token,
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'shop_id' => $request->shop_id,
        ]);
        if ($response->status() == '200') {
            alert()->success('อัปเดตข้อมูลเรียบร้อย');
            return redirect('admin/member-manage');
        } else {
            alert()->error('User นี้มีอยู่แล้ว');
            return back();
        }
    }

    public function createuser(Request $request)
    {
        $request->validate([
            'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:5',
        ], [
            'password.unique' => "รหัสผ่านไม่ตรงกัน",
        ]);

        $url = '192.168.2.12:1144/api/pos/member/item/add';
        $token = session()->get('token');
        $response = Http::post($url, [
            'token' => $token,
            'name' => $request->name,
            'email' => $request->emp_id,
            'shop_id' => $request->shop_id,
            'password' => bcrypt($request->input('password')),
            'status' => $request->status,
        ]);
        if ($response->status() == "200") {
            alert()->success('เพิ่มข้อมูลเรียบร้อย');
            return redirect('admin/member-manage');
        } else if ($response['message'] == "Pos Have Shop") {
            $request->flash();
            alert()->error('ชื่อเครื่องมีในร้านนี้แล้ว');
            return redirect('admin/pos-register')->with('shophavepos', 'ชื่อร้านค้านี้มีอยุ่แล้ว');
        } else if ($response['message'] == "Have Username") {
            $request->flash();
            alert()->error('Username นี้มีอยู่แล้ว');
            return redirect('admin/pos-register')->with('username', 'User นี้มีอยู่แล้ว');
        }
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/member/item/pass';
        $response = Http::post($url, [
            'token' => $token,
            'id' => $id,
            'password' => $request->password,
            'new_password' => $request->new_password,
        ]);
        if ($response->status() == 200) {
            alert()->success('เปลี่ยนรหัสผ่านเรียบร้อย');
            return redirect('admin/member-manage');
        } else {
            alert()->error('รหัสผ่านไม่ถูกต้อง');
            sleep(1);
            return back();
        }
    }
}