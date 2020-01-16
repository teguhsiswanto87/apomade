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
            $products = DB::table('products')->where('active', 'Y')->get();
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
//        $data->gross_profit = $request->gross_profit;
        $data->save();

        return redirect('product')->with('alert-success', $data->name . ' berhasil ditambahkan');

    }

    public function edit($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $product = DB::table('products')->where('id', $id)->get();
            return view('product_edit', ['products' => $product]);
        }
    }

    public function productUpdate(ProductStoreRequest $request)
    {

        $data = Product::find($request->id);
        $data->name = $request->name;
        $data->stock = $request->stock;
        $data->capital = $request->capital;
        $data->selling_price = $request->selling_price;
//        $data->gross_profit = $request->gross_profit;
        $data->save();

        return redirect('product')->with('alert-success', 'Berhasil memperbarui data');

    }

    public function productDelete($id)
    {
        $data = DB::table('products')->where('id', $id);
        $data->delete();

        return redirect('product')->with('alert-warning', 'Berhasil menghapus data');
    }

    // MANIPULASI => HAPUS PRODUK, TAPI TAK MERUSAK PENJUALAN YG BERELASI DENGAN PRODUK INI
    public function productDeactivate($id)
    {
        $data = DB::table('products')->where('id', $id);
        $name = $data->pluck('name')->first();
        $data->update(['active' => 'N']);

        // KATA-KATA MUNAFIK
        return redirect('product')->with('alert-warning', $name . ' dihapus dari produk dijual');
    }

//    API

    public function showAllProducts()
    {
        return Product::all();
    }

    public function showOneProduct($id)
    {
        return Product::find($id);
    }

    public function create(ProductStoreRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response('Delete Successfully', 200);
    }
}
