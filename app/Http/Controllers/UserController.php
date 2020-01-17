<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            return view('dashboard');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $data = User::where('username', $username)->first();
        if ($data) { //apakah email ada
            if (Hash::check($password, $data->password)) {
                Session::put('name', $data->name);
                Session::put('username', $data->username);
                Session::put('position', $data->position);
                Session::put('login', TRUE);
                return redirect('dashboard')->with('alert-success', 'Selamat datang ' . $data->name);
            } else {
                return redirect('login')->with('alert', 'Password atau username salah !');
            }
        } else {
            return redirect('login')->with('alert', 'Username Tidak terdaftar');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert', 'Kamu berhasil logout');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function registerPost(RegisterStoreRequest $request)
    {
        $data = new User();
        $data->name = $request->name;
//        $data->email = $request->email;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success', 'Kamu berhasil mendaftar, silakan login');

    }

    public function profile()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $user = DB::table('users')->where('username', Session::get('username'))->get()->first();
            return view('profile', ['user' => $user]);
        }
    }

    public function edit_profile()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            $user = DB::table('users')->where('username', Session::get('username'))->get()->first();
            return view('profile_edit', ['user' => $user]);
        }
    }

    //only update name & gender
    public function profileUpdate(UserStoreRequest $request)
    {
        $data = DB::table('users')->where([
            ['id', '=', $request->id],
            ['username', '=', $request->username]
        ]);
        $data->update([
            'name' => $request->name,
            'gender' => $request->gender
        ]);

        // update session data -> name
        $request->session()->put('name', $request->name);

        return redirect('profile')->with('alert-success', 'Profil berhasil diperbarui');

    }

    public function profileInsertEmail(Request $request){
        $data = DB::table('users')->where('username', Session::get('username'));
        $data->update(['email' => $request->email]);
        return redirect()->action('UserController@profile')
            ->with('alert-success','Berhasil menambahkan Email');
    }

    public function profileChangeEmail(Request $request){
        $data = DB::table('users')->where('username', Session::get('username'));
        $data->update(['email' => $request->email]);
        return redirect()->action('UserController@profile')
            ->with('alert-success','Email telah diperbarui');
    }

    public function profileDeleteEmail(){
        $data = DB::table('users')->where('username', Session::get('username'));
        $data->update(['email' => null]);
        return redirect()->action('UserController@profile')
            ->with('alert-warning','Berhasil menghapus email');
    }

}
