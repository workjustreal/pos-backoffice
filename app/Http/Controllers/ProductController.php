<?php

namespace App\Http\Controllers;

use App\Exports\ProductDetailExport;
use App\Exports\ProductExport;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ProductController extends Controller
{

    public function product_list(Request $request)
    {
        $token = session()->get('token');
        $url_shop = '192.168.2.12:1144/api/pos/shop/permission';
        $shop = Http::get($url_shop, [
            'token' => $token,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $shop = $shop['data'];

        if (!$request->has("order_date")) {
            $date = date("Y-m-d");
        } else {
            $date = $request->order_date;
        }
        if (!$request->has("product_status")) {
            $status = "9";
        } else {
            $status = $request->product_status;
        }

        $url_sku = '192.168.2.12:1144/api/pos/order/item/search/sku';
        $response = Http::post($url_sku, [
            'token' => $token,
            'shop_select' => $request->shop_select,
            'sku_name' => $request->sku,
            'order_date' => $date,
            'pos_name' => $request->pos_name,
            'product_status' => $status,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $product = json_decode($response);
        $result = [];
        foreach ($product as $item) {
            $index = array_search($item->sku, array_column($result, 'sku'));
            if ($index !== false) {
                $result[$index]['qty'] += $item->qty;
                $price = str_replace(',', '', $item->total_price);
                $result[$index]['total_price'] += $price;
            } else {
                $result[] = ['sku' => $item->sku, 'barcode' => $item->barcode, 'qty' => $item->qty, 'name' => $item->name, 'price' => $item->price, 'status' => $item->status, 'total_price' => $item->total_price, 'created_at' => $item->created_at];
            }
        }
        $product_count = 0;
        $total_price = 0;
        foreach ($result as $item) {
            $product_count += $item['qty'];
            $price = str_replace(',', '', $item['total_price']);
            $total_price += $price;
        }
        $list_count = count($result);
        $export = json_decode(json_encode($result), false);
        $request->flash();
        if ($request->action == "excel") {
            return Excel::download(new ProductExport($export, $request->shop_select, $request->pos_name, $total_price, $list_count, $product_count), 'Product-list' . now() . '.xlsx');
        } else if ($request->action == "pdf") {
            $qty = 0;
            $total_price = 0;

            foreach ($export as $item) {
                $qty += $item->qty;
                $price = str_replace(',', '', $item->total_price);
                $total_price += $price;
            }

            $filename = 'ProductList' . date('Y-m-d') . '.pdf';
            $data = [
                'product' => $export,
                'shop_select' => $request->shop_select,
                'pos_name' => $request->pos_name,
                'order_date' => $date,
                'sku_name' => $request->sku,
                'qty' => $qty,
                'total_price' => $total_price,
                'list_count' => $list_count,
                'product_count' => $product_count
            ];
            $html = view()->make('pdf.product-list', $data)->render();
            $pdf = new TCPDF;
            $pdf::SetTitle('Product List');
            $pdf::AddPage();
            $pdf::SetFont("freeserif", "", 12);
            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output(public_path($filename), 'D');

            return response()->download(public_path($filename));
        } else if ($request->action == "pdf2") {
            $qty = 0;
            $total_price = 0;

            foreach ($export as $item) {
                $qty += $item->qty;
                $price = str_replace(',', '', $item->total_price);
                $total_price += $price;
            }

            $filename = 'ProductList' . date('Y-m-d') . '.pdf';
            $data = [
                'product' => $export,
                'shop_select' => $request->shop_select,
                'pos_name' => $request->pos_name,
                'order_date' => $date,
                'sku_name' => $request->sku,
                'qty' => $qty,
                'total_price' => $total_price,
                'list_count' => $list_count,
                'product_count' => $product_count
            ];
            $html = view()->make('pdf.product-list2', $data)->render();
            $pdf = new TCPDF;
            $pdf::SetTitle('Product List');
            $pdf::AddPage();
            $pdf::SetFont("freeserif", "", 12);
            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output(public_path($filename), 'D');

            return response()->download(public_path($filename));
        } else if ($request->action == "nobar") {
            $qty = 0;
            $total_price = 0;

            foreach ($export as $item) {
                $qty += $item->qty;
                $price = str_replace(',', '', $item->total_price);
                $total_price += $price;
            }

            $filename = 'ProductList' . date('Y-m-d') . '.pdf';
            $data = [
                'product' => $export,
                'shop_select' => $request->shop_select,
                'pos_name' => $request->pos_name,
                'order_date' => $date,
                'sku_name' => $request->sku,
                'qty' => $qty,
                'total_price' => $total_price,
                'list_count' => $list_count,
                'product_count' => $product_count
            ];
            $html = view()->make('pdf.product-nobar', $data)->render();
            $pdf = new TCPDF;
            $pdf::SetTitle('Product List');
            $pdf::AddPage();
            $pdf::SetFont("freeserif", "", 12);
            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output(public_path($filename), 'D');

            return response()->download(public_path($filename));
        } else {
            return view('products.product', compact('result', 'shop', 'date', 'list_count', 'product_count', 'total_price'));
        }
    }

    public function product_detail($sku, $product_name, $barcode, $status, $date)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/item/search/sku';
        $response = Http::post($url, [
            'token' => $token,
            'sku_name' => $sku,
            'order_date' => $date,
            'product_status' => $status,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $response = json_decode($response);
        return view('products.product-detail', compact('response', 'sku', 'product_name', 'barcode'));
    }

    public function product_detail_export($sku)
    {
        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/item/search/sku';
        $response = Http::post($url, [
            'token' => $token,
            'sku_name' => $sku,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $response = json_decode($response);
        foreach ($response as $status) {
            if ($status->status == "9") {
                $status = "สำเร็จ";
            } else {
                $status = "ยกเลิก";
            }
        }
        return Excel::download(new ProductDetailExport($response, $sku, $status), 'Product-Order-detail' . now() . '.xlsx');
    }

    public function product_detail_pdf($sku, $product_name, $barcode)
    {
        $qty = 0;
        $total_price = 0;

        $token = session()->get('token');
        $url = '192.168.2.12:1144/api/pos/order/item/search/sku';
        $response = Http::post($url, [
            'token' => $token,
            'sku_name' => $sku,
            'emp_id' => Auth::user()->emp_id,
        ]);
        $response = json_decode($response);

        foreach ($response as $item) {
            $qty += $item->qty;
            $price = str_replace(',', '', $item->total_price);
            $total_price += $price;
        }

        $filename = 'ProductDetail' . date('Y-m-d') . '.pdf';
        $data = [
            'product' => $response,
            'sku' => $sku,
            'name' => $product_name,
            'barcode' => $barcode,
            'qty' => $qty,
            'total_price' => $total_price,
        ];
        $html = view()->make('pdf.product-detail', $data)->render();
        $pdf = new TCPDF;
        $pdf::SetTitle('ProductDetail');
        $pdf::AddPage();
        $pdf::SetFont("freeserif", "", 12);
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'D');

        return response()->download(public_path($filename));
    }

    public function product_select(Request $request)
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
}
