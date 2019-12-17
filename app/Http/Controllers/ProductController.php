<?php


namespace App\Http\Controllers;


use App\Http\Requests\ProductStoreRequest;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $products = DB::table('products')->get();
            return view('product', ['products' => $products]);
        }
    }

    public function insert()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            return view('product_insert');
        }
    }

    public function productPost(ProductStoreRequest $request)
    {

        $data = new Product();
        $data->name = $request->name;
        $data->stock = $request->stock;
        $data->capital = $request->capital;
        $data->selling_price = $request->selling_price;
        $data->gross_profit = $request->gross_profit;
        $data->save();

        return redirect('product')->with('alert-success', 'Berhasil menambahkan data');

    }


}
