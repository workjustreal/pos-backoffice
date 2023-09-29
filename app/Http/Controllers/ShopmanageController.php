<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class ShopmanageController extends Controller
{

    public function index()
    {
        $url = '192.168.2.12:1144/api/pos/shop';
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $data = $response['data'];
        $data = collect($data)->sortBy('shop_code')->toArray();
        return view('shop.shopmanages')->with('data', $data);
    }
    public function delete($id)
    {
        $url = '192.168.2.12:1144/api/pos/shop/item/del';
        $token = session()->get('token');
        Http::post($url, [
            'token' => $token,
            'id' => $id,
        ]);
        return redirect('admin/shop-manage');
    }
    public function shopcreate()
    {
        return view('shop.create-shop');
    }
    public function create(Request $request)
    {
        $url = '192.168.2.12:1144/api/pos/shop/item/add';
        $token = session()->get('token');
        $respons = Http::post($url, [
            'token' => $token,
            'shop_code' => $request->shop_code,
            'shop_name' => $request->name,
            'shop_detail' => $request->shop_detail,
            'shop_status' => $request->status,
        ]);
        if ($respons->status() == "200") {
            alert()->success('เพิ่มข้อมูลเรียบร้อย');
            return redirect('admin/shop-manage');
        } else if ($respons['message'] == "Have Name") {
            $request->flash();
            alert()->error('ชื่อร้านค้านี้มีอยุ่แล้ว');
            return redirect('admin/shop-create')->with('name', 'ชื่อร้านค้านี้มีอยุ่แล้ว');
        } else if ($respons['message'] == "Have Code") {
            $request->flash();
            alert()->error('รหัสร้านค้านี้มีอยุ่แล้ว');
            return redirect('admin/shop-create')->with('code', 'รหัสร้านค้านี้มีอยุ่แล้ว');
        }
    }
    public function edit($id)
    {
        $url = '192.168.2.12:1144/api/pos/shop/detail/' . $id;
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $data = $response['data'];

        // $shop = Shop::find($id);
        return view('shop.edit-shop')->with('id', $id)->with('data', $data);
    }

    public function updateshop(Request $request, $id)
    {
        $url = '192.168.2.12:1144/api/pos/shop/item/edit';
        $token = session()->get('token');
        Http::post($url, [
            'token' => $token,
            'id' => $id,
            'shop_code' => $request->code,
            'shop_name' => $request->name,
            'shop_status' => $request->status,
        ]);
        alert()->success('อัปเดตข้อมูลเรียบร้อย');
        return redirect('admin/shop-manage');
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect('admin/user-manage');
    }
}