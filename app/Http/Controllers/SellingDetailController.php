<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

}
