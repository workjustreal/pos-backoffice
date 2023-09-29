<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\ExProduct;
use Illuminate\Support\Facades\DB;
use Auth;

class PosPriceController extends Controller
{
    public function index()
    {
        $product = Product::leftJoin('kacee_center.ex_product as p', 'products.barcode', '=', 'p.barcod')->orderBy('id')->get(['products.barcode', 'p.stkcod', 'products.id',  'p.names', 'products.price']);
        return view('pos.product-pos', compact('product'));
    }

    public function getedit(Request $request)
    {
        $product = Product::leftJoin('kacee_center.ex_product', 'products.barcode', '=', 'ex_product.barcod')
            ->whereIn('products.id', $request->selectitems)->orderBy('id')
            ->get(['ex_product.stkcod', 'ex_product.sellpr1', 'products.barcode', 'ex_product.names', 'products.price', 'products.id']);
        $data = [];
        foreach ($product as $item) {
            $data[] = $item->barcode;
        }
        $log = ProductLog::leftJoin('kacee_center.employee as e', 'product_log.emp_id', '=', 'e.emp_id')
            ->whereIn('barcode', $data)
            ->orderBy('updated_at', 'desc')
            ->get(['e.name', 'e.surname', 'e.nickname', 'product_log.barcode', 'product_log.price', 'product_log.price_before', 'product_log.updated_at']);

        // โชว์ LOG ล่าสุด ตัวเดียว
        // $log = [];
        // foreach ($result as $val) {
        //     $index = array_search($val->barcode, array_column($log, 'barcode'));
        //     if ($index === false) {
        //         $log[] = ['barcode' => $val->barcode, 'name' => $val->name, 'surname' => $val->surname, 'nickname' => $val->nickname, 'price' => $val->price, 'price_before' => $val->price_before, 'updated_at' => $val->updated_at];
        //     }
        // }
        return view('pos.product-pos-edit', compact('product', 'log'));
    }

    public function geteditone($id)
    {
        $product = Product::leftJoin('kacee_center.ex_product', 'products.barcode', '=', 'ex_product.barcod')
            ->where('id', '=', $id)
            ->get(['ex_product.stkcod', 'products.barcode', 'ex_product.names', 'ex_product.sellpr1', 'products.price', 'products.id']);

        $log = ProductLog::leftJoin('kacee_center.employee as e', 'product_log.emp_id', '=', 'e.emp_id')
            ->where('product_log.barcode', '=', $product[0]->barcode)->orderBy('id', 'desc')
            ->get(['e.name', 'e.surname', 'e.nickname', 'product_log.barcode', 'product_log.price', 'product_log.price_before', 'product_log.updated_at']);
        return view('pos.product-pos-editone')->with('product', $product)->with('log', $log);
    }

    public function update_price(Request $request)
    {
        $product = Product::whereIn('id', $request->id)->get();
        $data = [];
        for ($i = 0; $i < count($request->id); $i++) {
            $data[] = [
                "id" => $request->id[$i],
                'price' => $request->price[$i],
                'user' => Auth::user()->emp_id,
                'updated_at' => now(),
            ];
            if ($product[$i]->price != $request->price[$i]) {
                $log = new ProductLog();
                $log->barcode = $request->barcode[$i];
                $log->emp_id = Auth::user()->emp_id;
                $log->price_before = $product[$i]->price;
                $log->price = $request->price[$i];
                $log->save();
            }
        }
        Product::upsert($data, ['id', 'price', 'user', 'updated_at']);
        alert()->success(
            'แก้ไขราคาเรียบร้อย'
        );
        return redirect('pos/price');
    }

    public function updateone(Request $request, $id)
    {
        $product = Product::where('id', '=', $id)->get();
        foreach ($product as $product) {
            if ($request->price != $product->price) {
                $log = new ProductLog();
                $log->emp_id = Auth::user()->emp_id;
                $log->barcode = $product->barcode;
                $log->price_before = $product->price;
                $log->price = $request->price;
                $log->updated_at = now();
                $log->save();
                Product::where('id', '=', $id)->update(['price' => $request->price, 'user' => Auth::user()->emp_id, 'updated_at' => now()]);
                alert()->success('แก้ไขราคาเรียบร้อย');
                return redirect('pos/price');
            } else {
                alert()->warning('คุณยังไม่ได้แก้ไขราคา!');
                return back();
            }
        }
    }
}
