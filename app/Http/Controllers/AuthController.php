<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;


class AuthController extends Controller
{

    public function showRegister()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        if ($request->input('role') === 'admin') {
            $admin = Admin::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);


            \Auth::login($admin);
        }
        else {
            $user= User::create([
                  'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
                 \Auth::login($user);
        }

        return redirect()->route('auth.showLogin');

    }
    public function showLogin()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:4'
        ]);
        if (
            \Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])
        ) {
            $request->session()->regenerate();
            return redirect()->route('orders.index');
        }
        return redirect()->back()->withErrors('Le mot de passe ou l\'email ne correspond pas');
    }

    public function logout(Request $request)
    {

        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

}
