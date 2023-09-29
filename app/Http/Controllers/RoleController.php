<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $token  = session()->get('token');
        $url = "192.168.2.12:1144/api/pos/user/level";
        $response = Http::get($url, [
            'token' => $token,
        ]);
        return view('roles.level')->with('response', $response);
    }

    public function add_level(Request $request)
    {
        return view('roles.level-add');
    }


    public function createlevel(Request $request)
    {
        $token  = session()->get('token');
        $url = "192.168.2.12:1144/api/pos/user/level/item/add";
        Http::post($url, [
            'token' => $token,
            'name' => $request->lavel,
        ]);
        alert()->success('เพิ่มข้อมูลเรียบร้อย');
        return back();
    }

    public function create_role(Request $request)
    {
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/permission/item/add/role';
        $shop_req = ($request->shop) ? implode(",",$request->shop) : "";
        if($request->level == 10){
            $response = Http::post($url, [
                'token' => $token,
                'name' => $request->name,
                'emp_id' => $request->emp_id,
                'level' => $request->level,
                'shop' => $shop_req,
            ]);
            if($response->status() == 200){
                alert()->success('เพิ่มข้อมูลเรียบร้อย');
                return redirect('admin/user-role');
            }else{
                alert()->error('มีผู้ใช้งานนี้อยู่แล้ว');
                return redirect()->back();
            }
        }else{
            if($request->shop == ""){
                alert()->warning('กรุณาระบุร้านที่ดูแล');
                $request->flash();
                return back();
            }else{
                $response = Http::post($url, [
                    'token' => $token,
                    'name' => $request->name,
                    'emp_id' => $request->emp_id,
                    'level' => $request->level,
                    'shop' => $shop_req,
                ]);
                if($response->status() == 200){
                    alert()->success('เพิ่มข้อมูลเรียบร้อย');
                    return redirect('admin/user-role');
                }else{
                    alert()->error('มีผู้ใช้งานนี้อยู่แล้ว');
                    return redirect()->back();
                }
            }
        }
    }

    public function editlevel(Request $request, $id, $name)
    {
        return view('roles.level-edit', compact('id', 'name'));
    }

    public function updatelevel(Request $request)
    {
        $token  = session()->get('token');
        $url = "192.168.2.12:1144/api/pos/user/level/item/edit";
        Http::post($url, [
            'token' => $token,
            'id' => $request->id_level,
            'name' => $request->name_level,
        ]);
        alert()->success('เพิ่มข้อมูลเรียบร้อย');
        return redirect('admin/level');
    }

    public function dellevel($id)
    {
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/level/item/del';
        Http::post($url, [
            'token' => $token,
            'id' => $id,
        ]);
        return back();
    }

    public function user_role()
    {
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/permission/item/list';
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $response = $response['data'];
        $response = collect($response)->sortBy('level')->toArray();
        return view('roles.user-role', compact('response'));
    }

    public function user_role_add(Request $request)
    {
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/level';
        $url_shop = '192.168.2.12:1144/api/pos/shop';
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $shop = Http::get($url_shop, [
            'token' => $token,
        ]);
        $shop = $shop['data'];
        $response = $response['data'];
        return view('roles.user-role-add', compact('response','shop'));
    }

    public function user_role_edit($id)
    {
        $token  = session()->get('token');
        $url_shop = '192.168.2.12:1144/api/pos/shop';
        $level_url = '192.168.2.12:1144/api/pos/user/level';
        $role_url = '192.168.2.12:1144/api/pos/user/permission/item/getedit/role/' . $id;
        $shop = Http::get($url_shop, [
            'token' => $token,
        ]);
        $level_resp = Http::get($level_url, [
            'token' => $token,
        ]);
        $role_resp = Http::post($role_url, [
            'token' => $token,
        ]);
        $level_resp = $level_resp['data'];
        $role_resp = $role_resp['data'];
        $shop = $shop['data'];
        return view('roles.user-role-edit', compact('level_resp', 'role_resp', 'id','shop'));
    }

    public function user_role_update(Request $request, $id)
    {
        $emp_id = $request->emp_id;
        $name = $request->name;
        $level = $request->level;
        $shop_req = ($request->shop) ? implode(",",$request->shop) : "";
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/permission/item/edit/role/';
        Http::post($url, [
            'token' => $token,
            'id' => $id,
            'emp_id' => $emp_id,
            'name' => $name,
            'level' => $level,
            'shop' => $shop_req
        ]);
        alert()->success('อัพเดทข้อมูลเรียบร้อย');
        return redirect('admin/user-role');
    }

    public function user_role_delete($id)
    {
        $token  = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/user/permission/item/delete/role/' . $id;
        Http::get($url, [
            'token' => $token,
        ]);
        return redirect('admin/user-role');
    }

    public function search_emp(Request $request)
    {
        if ($request->ajax()) {
            $result = DB::connection("mysql2")->table('employee as e')->leftJoin('department as d', 'e.dept_id', '=', 'd.dept_id')
            ->where('e.emp_id', '<>', '')
            ->where(function ($query) use ($request) {
                if ($request->search != "") {
                    $query->orWhere('e.emp_id', 'like', '%'.trim(str_replace(' ', '%', $request->search)).'%');
                    $query->orWhere('e.name', 'like', '%'.trim(str_replace(' ', '%', $request->search)).'%');
                    $query->orWhere('e.surname', 'like', '%'.trim(str_replace(' ', '%', $request->search)).'%');

                    $exp = explode(' ', $request->search);
                    if (count($exp) == 2) {
                        $query->orWhere('e.name', 'like', '%'.trim(str_replace(' ', '%', $exp[0])).'%');
                        $query->orWhere('e.surname', 'like', '%'.trim(str_replace(' ', '%', $exp[1])).'%');
                    }
                }
            })->orderBy("e.emp_id", "asc")->get(['e.emp_id', 'e.title', 'e.name', 'e.surname', 'e.nickname', 'e.gender', 'e.image', 'e.position_id', 'e.dept_id', 'e.area_code', 'e.emp_type', 'e.emp_status', 'd.level', 'd.dept_name']);
            return response()->json($result);
        }
    }

    public function get_emp(Request $request)
    {
        if ($request->ajax()) {
            $result = DB::connection("mysql2")->table('employee as e')->leftJoin('department as d', 'e.dept_id', '=', 'd.dept_id')
            ->where('e.emp_id', '=', $request->search)
            ->orderBy("e.emp_id", "asc")->select(['e.emp_id', 'e.title', 'e.name', 'e.surname', 'e.nickname', 'e.gender', 'e.image', 'e.position_id', 'e.dept_id', 'e.area_code', 'e.emp_type', 'e.emp_status', 'd.level', 'd.dept_name'])->first();
            return response()->json($result);
        }
    }
}