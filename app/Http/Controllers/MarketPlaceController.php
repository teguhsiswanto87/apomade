<?php

namespace App\Http\Controllers;

use App\MarketPlace;
use App\Http\Requests\MarketPlaceStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MarketPlaceController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            $marketplaces = DB::table('market_places')->get();
            return view('marketplace', ['marketplaces' => $marketplaces]);
        }
    }

    public function insert()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            return view('marketplace_insert');
        }
    }

    public function marketplacePost(MarketPlaceStoreRequest $request)
    {

        $data = new MarketPlace();
        $data->name = $request->name;
        $data->image_link = $request->image_link;
        $data->store_link = $request->store_link;
        $data->active = (($request->active) ? 'Y' : 'N');
        $data->save();

        return redirect('marketplace')->with('alert-success', $request->name . ' berhasil ditambahkan');

    }

    public function edit($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $marketplace = DB::table('market_places')->where('id', $id)->get();
            return view('marketplace_edit', ['marketplaces' => $marketplace]);
        }
    }

    public function marketplaceUpdate(MarketPlaceStoreRequest $request)
    {

        $data = MarketPlace::find($request->id);
        $data->name = $request->name;
        $data->image_link = $request->image_link;
        $data->store_link = $request->store_link;
        $data->active = (($request->active) ? 'Y' : 'N');
        $data->save();

        return redirect('marketplace')->with('alert-success', 'Data berhasil diperbarui');

    }

    public function marketplaceDelete($id)
    {
        $data = DB::table('market_places')->where('id', $id);
        $data->delete();

        return redirect('marketplace')->with('alert-warning', 'Berhasil menghapus data');
    }

}
