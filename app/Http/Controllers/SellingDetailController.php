<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellingDetailStoreRequest;
use App\Product;
use App\SellingDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Array_;

class SellingDetailController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $selling_details = DB::table('selling_details')->get();
            return view('sellingdetail', ['sellingdetails' => $selling_details]);
        }
    }

    public function insertsPost(SellingDetailStoreRequest $request)
    {
        $number_of_products = count($request->products_id);
        if ($number_of_products > 0) {
            $filterQty = array_filter($request->qty, "strlen");
            $filteredQty = array_splice($filterQty, 0);
            foreach ($request->products_id as $item => $value) {
                $singleRowProduct = DB::table('products')->where('id', $value)->first();

                $data = [
                    'sellings_id' => $request->sellings_id[$item],
                    'products_id' => $request->products_id[$item],
                    'capital' => $singleRowProduct->capital,
                    'selling_price' => $singleRowProduct->selling_price,
                    'qty' => $filteredQty[$item]
                ];


                //insert to selling_details
                DB::table('selling_details')->insert($data);
                //decrease stock products by qty
                DB::table('products')
                    ->where('id', $value)
                    ->decrement('stock', $filteredQty[$item]);

            }

        }
        return redirect()->action(
            'SellingController@edit', ['id' => $request->id]
        )->with('alert-success', $number_of_products . ' Jenis Produk berhasil ditambahkan');
    }

    public function sellingDetailDelete($sellings_id, $products_id)
    {
        //find data
        $data = DB::table('selling_details')
            ->where([
                ['sellings_id', '=', $sellings_id],
                ['products_id', '=', $products_id]
            ]);
        $singleRowData = $data->get()->first();
        //delete
        $data->delete();
        //increase QTY of product
        DB::table('products')->where('id', $products_id)->increment('stock', $singleRowData->qty);

        return redirect()->action(
            'SellingController@edit', ['id' => $sellings_id]
        )->with('alert-warning', 'Produk berhasil dihapus');
    }

    public function increaseProductQty(Request $request)
    {
        //find
        $data = DB::table('selling_details')
            ->where([
                ['sellings_id', '=', $request->sellings_id],
                ['products_id', '=', $request->products_id]
            ]);
        //update increase qty
        $data->increment('qty', $request->qty);

        //decrease product qty from products
        $product = DB::table('products')->where('id', $request->products_id);
        $product_data = $product->get()->first(); //get product data first
        $product->decrement('stock', $request->qty);

        return redirect()->action(
            'SellingController@edit', ['id' => $request->sellings_id]
        )->with('alert-success', $request->qty . ' `' . $product_data->name . '` ditambahkan');
    }

    public function decreaseProductQty(Request $request)
    {
        //find
        $data = DB::table('selling_details')
            ->where([
                ['sellings_id', '=', $request->sellings_id],
                ['products_id', '=', $request->products_id]
            ]);
        //update decrease qty
        $data->decrement('qty', $request->qty);

        //increase product qty from products
        $product = DB::table('products')->where('id', $request->products_id);
        $product_data = $product->get()->first(); //get product data first
        $product->increment('stock', $request->qty);

        return redirect()->action(
            'SellingController@edit', ['id' => $request->sellings_id]
        )->with('alert-warning', $request->qty . ' `' . $product_data->name . '` dikurangi');
    }

}
