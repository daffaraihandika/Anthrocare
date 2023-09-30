<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login.indexLogin');
    }

    public function login(Request $request){
        Session::flash('username', $request->username);
        
        $message = [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ];
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], $message);

        $info_login = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($info_login)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else{
            return back()->with('loginError', 'Username atau password salah!!');
        }
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
        // return "tess masuk logout";
    }
}
