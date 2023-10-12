<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function getOrderList(Request $request)
    {
        $user = $request->username;
        $start = $request->start_date;
        $end = $request->end_date;
        $data = [];

        $user_order = DB::table('users')
            ->leftJoin('pos_shop', 'users.shop_id', '=', 'pos_shop.id')
            ->where('email', '=', $user)
            ->first(['users.id', 'users.name', 'pos_shop.shop_name']);

        if (!$user_order) {
            $data = [
                "success" => "false",
                "message" => "no have user"
            ];
            return response()->json($data);
        }

        $order = DB::table('pos_order')
            ->where('user_id', '=', $user_order->id)
            ->where('status', '=', '9');

        if ($start !== null && $end !== null) {
            $start = $start . " 00:00:00";
            $end = $end . " 23:59:59";
            $order = $order->whereBetween('pos_order.updated_at', [$start, $end]);
        } elseif ($start !== null && $end == null || $start == null && $end !== null) {
            $data = [
                "success" => "false",
                "message" => "กรอกข้อมูลให้ครบ"
            ];
            return response()->json($data);
        }

        $order = $order->get();

        $total_price = 0;
        foreach ($order as $val) {
            $total_price += (int)$val->total_price;
        }

        $data = [
            "success" => "true",
            "pos" => $user_order->name,
            "shop" => $user_order->shop_name,
            "order_count" => number_format(count($order)),
            "total_price" => number_format($total_price),
            "data" => $order,
        ];

        return response()->json($data);
    }
}
