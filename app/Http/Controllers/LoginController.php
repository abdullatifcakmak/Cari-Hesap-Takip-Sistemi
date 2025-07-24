<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Giriş işlemini gerçekleştir
    public function login(Request $request)
    {
        // Giriş bilgilerini doğrula
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Bilgiler doğruysa giriş yap
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // yönlendirme
        }

        // Bilgiler yanlışsa geri dön ve hata göster
        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler doğru değil.',
        ])->onlyInput('email');
    }
}
