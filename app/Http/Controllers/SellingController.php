<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellingStoreRequest;
use App\Selling;
use App\SellingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellingController
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $products_sold = DB::table('products')
                ->join('selling_details', 'selling_details.products_id', '=', 'products.id')
                ->join('sellings', 'sellings.id', '=', 'selling_details.sellings_id')
                ->select('products.*',
                    'sellings.id as s_id',
                    'selling_details.qty as sd_qty',
                    'selling_details.capital as sd_capital',
                    'selling_details.selling_price as sd_selling_price')
                ->addSelect(DB::raw('(selling_details.qty*selling_details.selling_price) as turnover'))
                ->get();

            $sellings = DB::table('sellings')
                ->join('market_places', 'sellings.market_places_id', '=', 'market_places.id')
                ->join('couriers', 'sellings.couriers_id', '=', 'couriers.id')
                ->select('sellings.*',
                    'market_places.name as mp_name',
                    'market_places.image_link as mp_image_link',
                    'couriers.name as c_name')
                ->orderBy('sellings.created_at', 'desc')
                ->get();
            return view('selling', ['sellings' => $sellings, 'products' => $products_sold]);
        }
    }

    public function index_table($marketplace)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $products_sold = DB::table('products')
                ->join('selling_details', 'selling_details.products_id', '=', 'products.id')
                ->join('sellings', 'sellings.id', '=', 'selling_details.sellings_id')
                ->select('products.*',
                    'sellings.id as s_id',
                    'selling_details.qty as sd_qty',
                    'selling_details.capital as sd_capital',
                    'selling_details.selling_price as sd_selling_price')
                ->addSelect(DB::raw('(selling_details.qty*selling_details.selling_price) as turnover'))
                ->addSelect(DB::raw('(selling_details.qty*selling_details.capital) as capitals'))
                ->get();

            $sellings = DB::table('sellings')
                ->join('market_places', 'sellings.market_places_id', '=', 'market_places.id')
                ->join('couriers', 'sellings.couriers_id', '=', 'couriers.id')
                ->select('sellings.*',
                    'market_places.name as mp_name',
                    'market_places.image_link as mp_image_link',
                    'couriers.name as c_name')
                ->orderBy('sellings.created_at', 'desc')
                ->get();

            return view('selling_table' . '_' . $marketplace, ['sellings' => $sellings, 'products' => $products_sold]);

        }
    }

    public function insert()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $products = DB::table('products')->where('stock', '>', 0)->get();
            $productsSoldOut = DB::table('products')->where('stock', '<=', 0)->get();
            $couriers = DB::table('couriers')->get()->where('active', 'Y');
            $market_places = DB::table('market_places')->get()->where('active', 'Y');
            return view('selling_insert',
                ['products' => $products,
                    'productsSoldOut' => $productsSoldOut,
                    'couriers' => $couriers,
                    'marketplaces' => $market_places]);
        }

    }

    // insert with detail products
    public function sellingPost(SellingStoreRequest $request)
    {
        $data = new Selling();
        $data->market_places_id = $request->market_places_id;
        $data->couriers_id = $request->couriers_id;
        $data->purchase_date = $request->purchase_date;
        $data->buyers_name = $request->buyers_name;
        $data->shipping_tax = $request->shipping_tax;
        $data->voucher_discount = $request->voucher_discount;
//        $data->turnover = $request->turnover;
//        $data->profit = $request->profit;
        $data->selling_status = $request->selling_status;
        $data->note = $request->note;
        $data->save();

        $lastId = $data->id;
        if (count($request->products_id) > 0) {
            $filterQty = array_filter($request->qty, "strlen");
            $filteredQty = array_splice($filterQty, 0);
            foreach ($request->products_id as $item => $value) {
                // direct put from products table / not from selling_insert form
                $singleRowProduct = DB::table('products')->where('id', $value)->first();
                $data2 = [
                    'sellings_id' => $lastId,
                    'products_id' => $request->products_id[$item],
                    'capital' => $singleRowProduct->capital,
                    'selling_price' => $singleRowProduct->selling_price,
                    'qty' => $filteredQty[$item]
                ];
                //insert to selling_details
                DB::table('selling_details')->insert($data2);
                //decrease stock products by qty
                DB::table('products')
                    ->where('id', $value)
                    ->update(['stock' => $singleRowProduct->stock - $filteredQty[$item]]);
            }
        }
        return redirect('selling')->with('alert-success', 'Data Penjualan berhasil ditambahkan');
//        return print_r($request->products_id);
//        return print_r();
    }

    // only testing
    public function sellingPostTest(Request $request)
    {
        if (count($request->products_id) > 0) {
            foreach ($request->products_id as $item => $value) {
                $data2 = array(
                    'sellings_id' => $request->sellings_id[$item],
                    'products_id' => $request->products_id[$item],
                    'capital' => $request->capital[$item],
                    'selling_price' => $request->selling_price[$item],
                    'qty' => $request->qty[$item]
                );
                DB::table('selling_details')->insert($data2);
            }
        }
        return redirect('selling')->with('alert-success', 'Data Penjualan berhasil ditambahakan');
    }

    public function detail($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $selling_details = DB::table('selling_details')
                ->join('products', 'selling_details.products_id', '=', 'products.id')
                ->join('sellings', 'selling_details.sellings_id', '=', 'sellings.id')
                ->select('selling_details.*',
                    'products.name as p_name',
                    'sellings.purchase_date',
                    'sellings.buyers_name',
                    'sellings.turnover',
                    'sellings.selling_status')
                ->where('selling_details.sellings_id', $id)
                ->get();
            return view('selling_detail', ['sellingdetails' => $selling_details]);
        }
    }

    public function edit($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $sellings = DB::table('sellings')->where('id', $id)->get()->first();
            $selling_details = DB::table('selling_details')
                ->join('products', 'selling_details.products_id', '=', 'products.id')
                ->select('selling_details.*', 'products.name as p_name', 'products.stock as p_stock')
                ->where('selling_details.sellings_id', $id)->get();
            $products = DB::table('products')
                ->where('stock', '>', 0)
                ->whereNotIn('id', $selling_details->pluck('products_id'))
                ->get();
            $productsSoldOut = DB::table('products')->where('stock', '<=', 0)->get();
            $couriers = DB::table('couriers')->where('active', 'Y')->get();
            $market_places = DB::table('market_places')->where('active', 'Y')->get();

            return view('selling_edit', ['sellings' => $sellings,
                'selling_details' => $selling_details,
                'products' => $products,
                'productsSoldOut' => $productsSoldOut,
                'couriers' => $couriers,
                'marketplaces' => $market_places
            ]);
        }

    }

    public function sellingUpdate(SellingStoreRequest $request)
    {
        $data = Selling::find($request->id);
        $data->market_places_id = $request->market_places_id;
        $data->couriers_id = $request->couriers_id;
        $data->purchase_date = $request->purchase_date;
        $data->buyers_name = $request->buyers_name;
        $data->shipping_tax = $request->shipping_tax;
        $data->voucher_discount = $request->voucher_discount;
        $data->selling_status = $request->selling_status;
        $data->note = $request->note;
        $data->save();

        return redirect()->action(
            'SellingController@edit', ['id' => $request->id]
        )->with('alert-success', 'Data Penjualan Berhasil Diperbarui');
    }

    public function sellingDelete($id)
    {
        $data = DB::table('selling_details')->where('sellings_id', $id);
        $data->delete();
        Selling::query('delete from sellings')->where('id', $id)->delete();

        return redirect('selling')->with('alert-warning', 'Berhasil menghapus data');
    }

    public function sellingChangeToDone($id, $info)
    {
        $data = DB::table('sellings')->where('id', $id);
        $data->update(['selling_status' => 'done']);

        return redirect('selling')->with('alert-success', 'Pesanan dari "' . $info . '" telah selesai');
    }

//    Purpose for testing everything in this model
    public function onlyTesting($sellings_id, $products_id)
    {
        //find data
        $data = DB::table('selling_details')
            ->where([
                ['sellings_id', '=', $sellings_id],
                ['products_id', '=', $products_id]
            ]);
        $qty = $data->get()->first();
        //delete
//        $data->delete();
        //increase QTY of product
//        DB::table('products')->where('id', $products_id)->increment($qty);

        return $qty->qty;
    }

}
