<?php

namespace App\Http\Controllers;

use App\Models\Detailorder;
use App\Models\Shop;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use DB;

class DashboardController extends Controller
{

    public function home(Request $request)
    {
        $url_auto = '192.168.2.12:1144/api/auth/token/auto';
        $response_auto = Http::get($url_auto, []);
        session()->put('token', $response_auto['data']['token']);

        $token = session()->get('token');
        $dash_shop = session()->get('dash_shop');
        $url = '192.168.2.12:1144/api/pos/order/list';
        $response = Http::get($url, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
            'shop_code' => ($dash_shop) ? $dash_shop : "",
        ]);
        if (!$dash_shop == "") {
            $data = $response['data'];
            session()->put('order_count', count($data['order']));
            $order_count = session()->get('order_count');
        } else {
            $data = $response['data'];
        }

        $url_shop = '192.168.2.12:1144/api/pos/shop/permission';
        $shop_list = Http::get($url_shop, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
            'shop_code' => ($dash_shop) ? $dash_shop : "",
        ]);
        if (!$dash_shop == "") {
            $shop = $shop_list['data']['shop_list'];
            session()->put('shop_count', $shop_list['data']['shop_count']);
            $shop_count = session()->get('shop_count');
        } else {
            $shop = $shop_list['data'];
            $shop_count = count($shop);
        }

        $url_member = '192.168.2.12:1144/api/pos/member/permission';
        $member_list = Http::get($url_member, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
            'shop_code' => ($dash_shop) ? $dash_shop : "",
        ]);
        session()->put('pos_count', count($member_list['data']));
        $pos_count = session()->get('pos_count');

        $url_sku = '192.168.2.12:1144/api/pos/order/item/search/sku';
        $sku_response = Http::post($url_sku, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $sku_response = json_decode($sku_response);
        $product_count = 0;
        foreach ($sku_response as $item) {
            if ($item->status == 9) {
                $product_count += $item->qty;
            }
        }

        $order_count = 0;
        $total_price = 0;
        $total_today = 0;
        $total_week = 0;
        $total_lastweek = 0;
        $total_month = 0;
        $total_lastmonth = 0;
        $daytwoweek = [];
        $target = 1000;
        $strweek = [];
        $strweek_2 = [];
        $total_qty = [];

        $startmonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endmounth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $startmonth_2 = Carbon::now()->subMonth(2)->startOfMonth()->format('Y-m-d');
        $endmounth_2 = Carbon::now()->subMonth(2)->endOfMonth()->format('Y-m-d');

        $startDate = Carbon::createFromFormat('Y-m-d', $startmonth);
        $endDate = Carbon::createFromFormat('Y-m-d', $endmounth);
        $dateRange = CarbonPeriod::create($startDate, $endDate);

        $startDate_2 = Carbon::createFromFormat('Y-m-d', $startmonth_2);
        $endDate_2 = Carbon::createFromFormat('Y-m-d', $endmounth_2);
        $dateRange_2 = CarbonPeriod::create($startDate_2, $endDate_2);
        $ranges = [];
        $ranges_2 = [];
        foreach ($dateRange as $date) {
            $ranges[] = $date->format('Y-m-d');
        }
        foreach ($dateRange_2 as $date_2) {
            $ranges_2[] = $date_2->format('Y-m-d');
        }
        for ($i = 0; $i < 7; $i++) {
            $strweek[] = Carbon::now()->subWeek()->startOfWeek()->addDays($i)->format('Y-m-d');
        }
        for ($y = 0; $y < 7; $y++) {
            $strweek_2[] = Carbon::now()->subWeek(2)->startOfWeek()->addDay($y)->format('Y-m-d');
        }
        for ($x = 0; $x <= 12; $x++) {
            $price_twoweek = 0;
            $qty = 0;
            if (!$dash_shop == "") {
                foreach ($data['order'] as $item) {
                    $date = substr($item['updated_at'], 0, 10);
                    if ($item['status'] == '9') {
                        // Carbon::now()->subWeek()->startOfWeek(12)->addDays($x)->format('Y-m-d')
                        if ($date == Carbon::now()->subDays(13)->addDays($x)->format('Y-m-d')) {
                            $price = str_replace(',', '', $item['total_price']);
                            $price_twoweek += $price;
                            $qty += $item['total_qty'];
                        }
                    }
                }
            } else {
                foreach ($data as $item) {
                    $date = substr($item['updated_at'], 0, 10);
                    if ($item['status'] == '9') {
                        if ($date == Carbon::now()->subDays(13)->addDays($x)->format('Y-m-d')) {
                            $price = str_replace(',', '', $item['total_price']);
                            $price_twoweek += $price;
                            $qty += $item['total_qty'];
                        }
                    }
                }
            }
            $daytwoweek[] = $price_twoweek;
            $total_qty[] = $qty;
        }
        // dd($data['order']);
        if (!$dash_shop == "") {
            foreach ($data['order'] as $item) {
                if ($item['status'] == 9) {
                    $date = substr($item['updated_at'], 0, 10);
                    $order_count++;
                    $price = str_replace(',', '', $item['total_price']);
                    $total_price += $price;
                    if (in_array($date, $ranges)) {
                        $price = str_replace(',', '', $item['total_price']);
                        $total_month += $price;
                    }
                    if (in_array($date, $ranges_2)) {
                        $price_2 = str_replace(',', '', $item['total_price']);
                        $total_lastmonth += $price;
                    }
                    if ($date == Carbon::now()->format('Y-m-d')) {
                        if ($item['status'] == '9') {
                            $price = str_replace(',', '', $item['total_price']);
                            $total_today += $price;
                        }
                    }
                    if (in_array($date, $strweek)) {
                        $price = str_replace(',', '', $item['total_price']);
                        $total_week += $price;
                    }
                    if (in_array($date, $strweek_2)) {
                        $price_2 = str_replace(',', '', $item['total_price']);
                        $total_lastweek += $price_2;
                    }
                }
            }
        } else {
            foreach ($data as $item) {
                if ($item['status'] == 9) {
                    $date = substr($item['updated_at'], 0, 10);
                    $order_count++;
                    $price = str_replace(',', '', $item['total_price']);
                    $total_price += $price;
                    if (in_array($date, $ranges)) {
                        $price = str_replace(',', '', $item['total_price']);
                        $total_month += $price;
                    }
                    if (in_array($date, $ranges_2)) {
                        $price_2 = str_replace(',', '', $item['total_price']);
                        $total_lastmonth += $price;
                    }
                    if ($date == Carbon::now()->format('Y-m-d')) {
                        if ($item['status'] == '9') {
                            $price = str_replace(',', '', $item['total_price']);
                            $total_today += $price;
                        }
                    }
                    if (in_array($date, $strweek)) {
                        $price = str_replace(',', '', $item['total_price']);
                        $total_week += $price;
                    }
                    if (in_array($date, $strweek_2)) {
                        $price_2 = str_replace(',', '', $item['total_price']);
                        $total_lastweek += $price_2;
                    }
                }
            }
        }
        $shopAr = [];
        $shop_sel = Shop::all();
        foreach ($shop_sel as $val) {
            if ($dash_shop == "") {
                $shopAr[] = $val->shop_code;
            } else {
                $shopAr[] = $dash_shop;
            }
        }

        // $best_st = $date_start . " 00:00:00";
        // $best_en = empty($date_end) ? $date_start . " 23:59:59" :  $date_end . " 23:59:59";

        if (!$request->session()->has('best_default')) {
            $date_start =  date("y-m-01") . " 00:00:00";
            $date_end = date('y-m-t') . " 23:59:59";
            $best_query = date('m') . '/' . date('Y');
        } else {
            $date_start = session()->get('best_st');
            $date_end = session()->get('best_en');
            $best_query = session()->get('best_default');
        }

        $bestsell = Detailorder::select('pos_order_detail.sku', 'pos_order_detail.name', 'pos_order_detail.updated_at', DB::raw('SUM(pos_order_detail.qty) As total_qty, SUM(pos_order_detail.total_price) As total_sumprice'))
            ->leftJoin('pos_order', 'pos_order_detail.order_id', '=', 'pos_order.id')
            ->leftJoin('users', 'pos_order.user_id', '=', 'users.id')
            ->leftJoin('pos_shop', 'users.shop_id', '=', 'pos_shop.id')
            ->whereIn('pos_shop.shop_code', $shopAr)
            ->whereBetween('pos_order_detail.updated_at', [$date_start, $date_end])
            ->groupBy('pos_order_detail.sku')->orderBy('total_qty', 'desc')->take(10)->get();
        // $pdlast = Detailorder::select('sku', 'name', 'qty')->orderBy('updated_at', 'desc')->take(5)->get();
        $pdlast = Detailorder::select('pos_order_detail.sku', 'pos_order_detail.name', 'pos_order_detail.qty')
            ->leftJoin('pos_order', 'pos_order_detail.order_id', '=', 'pos_order.id')
            ->leftJoin('users', 'pos_order.user_id', '=', 'users.id')
            ->leftJoin('pos_shop', 'users.shop_id', '=', 'pos_shop.id')
            ->whereIn('pos_shop.shop_code', $shopAr)
            ->orderBy('pos_order_detail.updated_at', 'desc')->take(10)->get();
        $percent = $total_today / $target * 100;
        $request->flash();
        return view('dashboard', compact('best_query', 'pdlast', 'bestsell', 'data', 'order_count', 'total_price', 'total_today', 'percent', 'total_week', 'total_lastweek', 'total_month', 'total_lastmonth', 'daytwoweek', 'total_qty', 'shop', 'pos_count', 'product_count', 'dash_shop', 'shop_count'));
    }


    public function selectShop(Request $request)
    {
        if ($request->ajax()) {
            if ($request->dash_shop != "") {
                session()->put('dash_shop', "");
                session()->put('dash_shop', "$request->dash_shop");
            } else {
                session()->put('dash_shop', "");
            }
        }
    }

    // เลือกวันที่สินค้าขายดี
    public function selectDate(Request $request)
    {
        // 2023-04-18
        if ($request->ajax()) {
            $date = explode("/", $request->best_date);
            $mm = $date[0];
            $yy = $date[1];

            $best_st = $yy . '-' . $mm . '-' . '01' . ' 00:00:00';
            $best_en = $yy . '-' . $mm . '-' . date('t') . ' 23:59:59';
            if ($request->best_date != "") {
                session()->put('best_st', "");
                session()->put('best_en', "");
                session()->put('best_default', "$request->best_date");
                session()->put('best_st', "$best_st");
                session()->put('best_en', "$best_en");
            } else {
                session()->put('best_st', "");
                session()->put('best_en', "");
            }
        }
    }
}
