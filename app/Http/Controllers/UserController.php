<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu Harus Login');
        } else {
            return view('index');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = User::where('email', $email)->first();
        if ($data) { //apakah email ada
            if (Hash::check($password, $data->password)) {
                Session::put('nama', $data->nama);
                Session::put('email', $data->email);
                Session::put('jabatan', $data->jabatan);
                Session::put('login', TRUE);
                return redirect('home');
            } else {
                return redirect('login')->with('alert', 'Password atau email salah !');
            }
        } else {
            return redirect('login')->with('alert','Email Tidak terdaftar');
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

    public function registerPost(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password'
        ]);

        $data = new User();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success', 'Kamu berhasil mendaftar');
    }

}
