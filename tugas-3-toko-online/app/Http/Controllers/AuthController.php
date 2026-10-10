<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email|max:100',
            'username'     => 'required|string|unique:users,username|max:50',
            'password'     => 'required|string|min:6',
            'no_hp'        => 'nullable|string|max:15',
            'alamat'       => 'nullable|string',
        ]);

        $id_user = 'USR-' . substr(uniqid(), -11);

        $user = User::create([
            'id_user'      => $id_user,
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'username'     => $request->username,
            'password'     => $request->password,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $loginData = [
            $fieldType => $credentials['login'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
    return redirect()->route('dashboard')->with('success', 'Selamat datang!');
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Berhasil keluar.');
    }
}