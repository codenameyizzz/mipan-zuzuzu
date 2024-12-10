<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'alumni') {
                return redirect()->route('home');
            }
        }
        return view("auth.login");
    }
    
    public function postLogin(Request $request)
    {
        // Validasi data login
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Validasi tambahan untuk password
        $validator->after(function ($validator) use ($request) {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                $validator->errors()->add('password', 'Password salah.');
            }
        });

        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mencoba autentikasi
        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->has('remember'))
        ) {
            // Autentikasi berhasil, arahkan sesuai role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'alumni') {
                return redirect()->route('home');
            }
        }

        // Jika autentikasi gagal, kembali dengan error
        return redirect()
            ->back()
            ->withErrors(['email' => 'Kredensial tidak cocok dengan catatan kami.'])
            ->withInput();
    }

    /**
     * Handle logout request.
     */
    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman beranda setelah logout
        return redirect()->route('home');
    }

}
