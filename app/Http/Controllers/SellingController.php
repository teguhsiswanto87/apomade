<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellingController
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $sellings = DB::table('sellings')->get();
            return view('selling', ['sellings' => $sellings]);
        }
    }

    public function insert()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $products = DB::table('products')->get();
            return view('selling_insert', ['products' => $products]);
        }

    }

}
