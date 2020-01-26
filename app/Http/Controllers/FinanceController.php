<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FinanceController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            $now = Carbon::now();
            // multiple row data
            $market_places_transaction_distinct = DB::table('sellings')
                ->join('market_places', 'sellings.market_places_id', '=', 'market_places.id')
                ->select('market_places.id as mp_id', 'market_places.name as mp_name')
                ->whereYear('purchase_date', $now->year)
                ->whereMonth('purchase_date', $now->month)
                ->distinct()
                ->get();

            $sellings = DB::table('sellings')
                ->whereYear('purchase_date', $now->year)
                ->whereMonth('purchase_date', $now->month)
                ->get();
//            $sellings2 = $sellings->where('market_places_id', 6)->pluck('id');

            $selling_details = DB::table('selling_details')
                ->join('sellings', 'sellings.id', '=', 'selling_details.sellings_id')
                ->select('sellings.*')
                ->addSelect(DB::raw('selling_details.selling_price*selling_details.qty as turnover'))
                ->addSelect(DB::raw('(selling_details.capital*selling_details.qty) as capital'))
                ->addSelect(DB::raw('(selling_details.selling_price*selling_details.qty)*(shipping_tax/100) as tax'))
//                ->whereIn('sellings.id', $sellings2)
                ->get();

            return view('pages.finance.finance',
                [
                    'market_places_transaction_distinct' => $market_places_transaction_distinct,
                    'sellings' => $sellings,
                    'selling_details' => $selling_details
                ]);


//            return $selling_details->where('market_places_id', 6);
//            return $hasil;
//            return count(($selling_details->sd_selling_price));

//            return $selling_details;

        }
    }

    public function mutation()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            return view('pages.finance.mutation');
        }
    }

    public function addBalance(Request $request)
    {
        return $request;
    }

    public function subtactBalance(Request $request)
    {
        return $request;
    }

}
