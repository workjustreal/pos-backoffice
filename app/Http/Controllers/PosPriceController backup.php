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
        $product = Product::leftJoin('kacee_center.ex_product as p', 'products.barcode', '=', 'p.barcod')->get(['p.stkcod', 'products.id', 'products.barcode', 'p.names', 'products.price']);
        return view('pos.product-pos', compact('product'));
    }

    public function getedit(Request $request)
    {
        $product = Product::leftJoin('kacee_center.ex_product', 'products.barcode', '=', 'ex_product.barcod')
            ->whereIn('products.id', $request->selectitems)
            ->get(['ex_product.stkcod', 'products.barcode', 'ex_product.names', 'products.price', 'products.id']);
        return view('pos.product-pos-edit', compact('product'));
    }

    public function geteditone($id)
    {
        $product = Product::leftJoin('kacee_center.ex_product', 'products.barcode', '=', 'ex_product.barcod')
            ->where('id', '=', $id)
            ->get(['ex_product.stkcod', 'products.barcode', 'ex_product.names', 'products.price', 'products.id']);
        return view('pos.product-pos-editone')->with('product', $product);
    }

    public function update_price(Request $request)
    {
        $data = [];
        for ($i = 0; $i < count($request->id); $i++) {
            $data[] = [
                "id" => $request->id[$i],
                'price' => $request->price[$i],
                'user' => Auth::user()->emp_id,
                'updated_at' => now(),
            ];
        }
        Product::upsert($data, ['id', 'price', 'user', 'updated_at']);
        alert()->success('แก้ไขราคาเรียบร้อย');
        return redirect('pos/price');




        $data = [];
        for ($i = 0; $i < count($request->id); $i++) {
            $data[] = [
                "id" => $request->id[$i],
                'price' => $request->price[$i],
                'user' => Auth::user()->emp_id,
                'updated_at' => now(),
            ];
            // $log = new ProductLog();
            // $log->barcode = $request->barcode[$i];
            // $log->emp_id = Auth::user()->emp_id;
            // $log->price_before = $request->price_before[$i];
            // $log->price = $request->price[$i];
            // $log->save();
            Product::upsert($data, ['id', 'price', 'user', 'updated_at']);
            alert()->success('แก้ไขราคาเรียบร้อย');
            return redirect('pos/price');
        }
    }

    public function updateone(Request $request, $id)
    {
        $product = Product::where('id', '=', $id)->get();
        foreach ($product as $product) {
            $log = new ProductLog();
            $log->emp_id = Auth::user()->emp_id;
            $log->barcode = $product->barcode;
            $log->price_before = $product->price;
            $log->price_after = $request->price;
            $log->updated_at = now();
            $log->save();
        }
        Product::where('id', '=', $id)->update(['price' => $request->price, 'user' => Auth::user()->emp_id, 'updated_at' => now()]);
        alert()->success('แก้ไขราคาเรียบร้อย');
        return redirect('pos/price');
    }
}
