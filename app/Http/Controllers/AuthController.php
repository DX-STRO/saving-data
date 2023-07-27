<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');    
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => "required|email:dns|",
            'password' => "required|min:5|max:255",
        ], [
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
            'password.min' => 'Password Minimal :min Karakter',
            'password.max' => 'Password Maksimal :max Karakter',
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/');
        }

        Session::flash('statusFail', 'failed');
            Session::flash('message', 'Email Atau Password Salah!');
    
            return redirect('/login');  

        // $credentials['password'] = Hash::check($credentials['password']);
 
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
 
        //     return redirect()->intended('/');
        // }

    
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => "required|max:255",
            'email' => "required|email:dns|unique:users",
            'password' => "required|min:5|max:255",
            ], [
            'name.required' => 'Nama Wajib Di Isi',
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
            'email.unique' => 'Email Sudah Tersedia',
            'name.max' => 'Name Maksimal :max Karakter',
            'email.max' => 'Email Maksimal :max Karakter',
            'password.max' => 'Password Maksimal :max Karakter',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
    
        $user = new User();
        $user->name = $request->input('name');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
    
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Register! Mohon Login');
    
        return redirect('/login');
    }
}