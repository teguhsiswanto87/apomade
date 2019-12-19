<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Http\Requests\CourierStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourierController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            $couriers = DB::table('couriers')->get();
            return view('courier', ['couriers' => $couriers]);
        }
    }

    public function insert()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login');
        } else {
            return view('courier_insert');
        }
    }

    public function courierPost(CourierStoreRequest $request)
    {

        $data = new Courier();
        $data->name = $request->name;
        $data->image_link = $request->image_link;
        $data->active = (($request->active) ? 'Y' : 'N');
        $data->save();

        return redirect('courier')->with('alert-success', $request->name . ' berhasil ditambahkan');

    }

    public function edit($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $courier = DB::table('couriers')->where('id', $id)->get();
            return view('courier_edit', ['couriers' => $courier]);
        }
    }

    public function courierUpdate(CourierStoreRequest $request)
    {

        $data = Courier::find($request->id);
        $data->name = $request->name;
        $data->image_link = $request->image_link;
        $data->active = (($request->active) ? 'Y' : 'N');
        $data->save();

        return redirect('courier')->with('alert-success', 'Data berhasil diperbarui');

    }

    public function courierDelete($id)
    {
        $data = DB::table('couriers')->where('id', $id);
        $data->delete();

        return redirect('courier')->with('alert-warning', 'Berhasil menghapus data');
    }


}
