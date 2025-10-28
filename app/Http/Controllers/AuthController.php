<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user->name]);
            return redirect('/panel');
        }

        return back()->with('error', 'Sai email hoặc mật khẩu!');
    }

    public function panel()
{
    $user = session('user');
    if (!$user) {
        return redirect('/');
    }
    return view('panel', ['user' => $user]);
}


    public function logout()
    {
        session()->flush();
        return redirect('/')->with('message', 'Đã đăng xuất.');
    }
}
