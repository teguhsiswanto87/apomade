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
            $user = DB::table('users')->where('email', Session::get('email'))->get();
            return view('profile', ['user' => $user]);
        }
    }

    public function profileUpdate(UserStoreRequest $request)
    {
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->position = $request->position;
        $data->email = $request->email;
        $data->gender = $request->gender;
        $data->gender = $request->gender;
        $data->save();

        return redirect('profile')->with('alert-success', 'Profil berhasil diperbarui');

    }

}
