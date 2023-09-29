<?php

namespace App\Http\Controllers;

use App\Exports\OrderCancelExport;
use App\Exports\OrderDetailExport;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Auth;

class OrderController extends Controller
{
    public function orderlist(Request $request)
    {
        $token = session()->get('token');
        $url_shop = '192.168.2.12:1144/api/pos/shop/permission';
        $url_pos = '192.168.2.12:1144/api/pos/member/permission';

        $shop_list = Http::get($url_shop, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $shop = $shop_list['data'];

        $pos_list = Http::get($url_pos, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $pos = $pos_list['data'];

        if (!$request->has("order_date")) {
            $date = date("Y-m-d");
        } else {
            $date = $request->order_date;
        }
        if(!$request->has('order_status')){
            $order_status = "9";
        }else{
            $order_status = $request->order_status;
        }

        $shop_select = $request->shop_select;
        $order_number = $request->order_number;
        $pos_name = $request->pos_name;

        $url_search = '192.168.2.12:1144/api/pos/order/item/search';
        $order = Http::post($url_search, [
            'token' => $token,
            'shop_select' => $shop_select,
            'order_number' => $order_number,
            'pos_name' => $pos_name,
            'order_date' => $date,
            'status' => $order_status,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $order = json_decode($order);
        $order = collect($order)->sortBy('updated_at')->reverse()->toArray();
        $order_count = count($order);
        $order_price = 0;
        foreach ($order as $data) {
            if ($data->status == '9') {
                $result = str_replace(',', '', $data->total_price);
                $order_price += $result;
            }
            if($data->status == '9'){
                $status = "สำเร็จ";
            }else{
                $status = "ยกเลิก";
            }
        }
        $total_price = $order_price;
        // dd($total_price);
        $request->flash();
        if ($request->action == "excel") {
            return Excel::download(new OrderExport($order, $status, $shop_select, $pos_name, $order_count, $date, $total_price), 'order-list' . now() . '.xlsx');
        } else if ($request->action == "pdf") {
            $qty = 0;
            $total_price = 0;
            $filename = 'Oder List' . date('Y-m-d') . '.pdf';
            foreach ($order as $item) {
                if (is_numeric($item->total_qty)) {
                    $qty += $item->total_qty;
                    $result = str_replace(',', '', $item->total_price);
                    $total_price += $result;
                }
            }
            $data = [
                'shop' => $request->shop_select,
                'pos_name' => $request->pos_name,
                'date' => $date,
                'order_count' => $order_count,
                'order' => $order,
                'qty' => $qty,
                'total_price' => $total_price,
            ];
            $html = view()->make('pdf.order-list', $data)->render();
            $pdf = new TCPDF;
            $pdf::SetTitle('Order List');
            $pdf::AddPage();
            $pdf::SetFont("freeserif", "", 12);
            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output($filename, 'D');
        }{
            return view('orders.order', compact('order', 'shop', 'date', 'order_count', 'total_price', 'pos','order_status'));
        }
    }

    public function orderdetail($status, $id)
    {
        $url = '192.168.2.12:1144/api/pos/order/detail/' . $id;
        $payment = '192.168.2.12:1144/api/pos/payment/trans/' . $id;
        $token = session()->get('token');
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $responsepayment = Http::get($payment, [
            'token' => $token,
        ]);
        $paymentstatus = $responsepayment->status();
        if ($paymentstatus != '200') {
            $responsepayment = "empty";
        }
        if ($response->status() == '200') {
            $data = $response['data'];
            if ($status == "1") {
                $bgstatus = "bg-warning";
                $textstatus = "กำลังดำเนินการ";
            } elseif ($status == "3") {
                $bgstatus = "bg-danger";
                $textstatus = "ยกเลิก";
            } elseif ($status == "9") {
                $bgstatus = "bg-success";
                $textstatus = "สำเร็จ";
            }
            return view('orders.order-detail', compact('bgstatus', 'textstatus', 'id'))->with('data', $data)->with('paymentstatus', $paymentstatus)->with('responsepayment', $responsepayment);
        } else {
            return back();
        }
    }

    public function order_detail_export($id, $order_number)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/detail/' . $id;
        $payment = '192.168.2.12:1144/api/pos/payment/trans/' . $id;
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $responsepayment = Http::get($payment, [
            'token' => $token,
        ]);
        $response = collect($response['data']['items']);
        if ($responsepayment->status() == '200') {
            $responsepayment = $responsepayment['data'];
            return Excel::download(new OrderDetailExport($response, $responsepayment, $order_number), 'Order-detail' . now() . '.xlsx');
        } else {
            return Excel::download(new OrderCancelExport($response, $order_number), 'Order-detail' . now() . '.xlsx');
        }
    }

    public function order_select(Request $request)
    {
        if ($request->ajax()) {

            $token = session()->get('token');
            $url_member = '192.168.2.12:1144/api/pos/member/permission';
            $url_shop = '192.168.2.12:1144/api/pos/shop/permission';

            $member_list = Http::get($url_member, [
                'token' => $token,
                'emp_id' => Auth::user()->emp_id,
            ]);
            $shop_list = Http::get($url_shop, [
                'token' => $token,
                'emp_id' => Auth::user()->emp_id,
            ]);
            $shop = $shop_list['data'];
            $member = $member_list['data'];
            $member = collect($member)->sortBy('shop_name')->toArray();

            $query = $request->get('query');
            $pos_name = $request->get('pos_nam');

            $output =
                '<option selected value="">ทั้งหมด</option>';
            foreach ($member as $member) {
                if (in_array($query, $member)) {
                    if ($member['shop_status'] == "1") {
                        $select = ($pos_name == $member['name']) ? 'selected' : '';
                        if ($query == '') {
                            $output .=
                                '<option value="' . $member['name'] . '" ' . $select . ' >' . $member['name'] . ' ( ' . $member['shop_name'] . ' )</option>';
                        } else {
                            $output .=
                                '<option value="' . $member['name'] . '" ' . $select . ' >' . $member['name'] . '</option>';
                        }
                    }
                }
            }
            $data = array(
                'pos' => $output,
            );
            echo json_encode($data);
        }
    }

    public function orderdetail_pdf($id, $order_number)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/detail/' . $id;
        $payment = '192.168.2.12:1144/api/pos/payment/trans/' . $id;
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $responsepayment = Http::get($payment, [
            'token' => $token,
        ]);
        if ($responsepayment->status() == '200') {
            $responsepayment = $responsepayment['data'];
        } else {
            $responsepayment = "empty";
        }
        $total_price = $response['data']['total_price'];
        $total_qty = $response['data']['total_qty'];

        $response = collect($response['data']['items']);

        $filename = 'OderDetail' . date('Y-m-d') . '.pdf';
        $data = [
            'order_number' => $order_number,
            'order' => $response,
            'payment' => $responsepayment,
            'total_price' => $total_price,
            'qty' => $total_qty,
        ];
        $html = view()->make('pdf.order-detail', $data)->render();
        $pdf = new TCPDF;
        $pdf::SetTitle('OrderDetil');
        $pdf::AddPage();
        $pdf::SetFont("freeserif", "", 12);
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'D');

        // return response()->download(public_path($filename));
    }

     public function pdfnobar($id, $order_number)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/detail/' . $id;
        $payment = '192.168.2.12:1144/api/pos/payment/trans/' . $id;
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $responsepayment = Http::get($payment, [
            'token' => $token,
        ]);
        if ($responsepayment->status() == '200') {
            $responsepayment = $responsepayment['data'];
        } else {
            $responsepayment = "empty";
        }
        $total_price = $response['data']['total_price'];
        $total_qty = $response['data']['total_qty'];

        $response = collect($response['data']['items']);

        $filename = 'OderDetail' . date('Y-m-d') . '.pdf';
        $data = [
            'order_number' => $order_number,
            'order' => $response,
            'payment' => $responsepayment,
            'total_price' => $total_price,
            'qty' => $total_qty,
        ];
        $html = view()->make('pdf.order-nobar', $data)->render();
        $pdf = new TCPDF;
        $pdf::SetTitle('OrderDetil');
        $pdf::AddPage();
        $pdf::SetFont("freeserif", "", 12);
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'D');

        // return response()->download(public_path($filename));
    }

    public function order_edit($id)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/edit/' . $id;;
        $response = Http::get($url, [
            'token' => $token,
        ]);
        $response = $response['data'];
        $result = [];
        foreach ($response['items'] as $item) {
            $index = array_search($item['sku'], array_column($result, 'sku'));
            if ($index !== false) {
                $result[$index]['qty'] += $item->qty;
                $result[$index]['total_price'] += $item->total_price;
            } else {
                $result[] = ['sku' => $item['sku'], 'barcode' => $item['barcode'], 'qty' => $item['qty'], 'name' => $item['names'], 'price' => $item['price'],'total_price' => $item['total_price']];
            }
        }
        return view('orders.order-edit')->with('result', $result)->with('response', $response);
    }

    public function order_update($id, Request $request)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/update';
        $response = Http::post($url, [
            'token' => $token,
            'id' => $id,
            'status' => $request->status,
        ]);
        if($response->status() == '200'){
            alert()->success('แก้ไขสถานะเรียบร้อย');
            return redirect('/admin/orderlist');
        }else{
            dd($response->status());
        }
    }
}