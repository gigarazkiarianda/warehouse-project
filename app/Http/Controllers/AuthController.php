<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Gudang;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Mencatat log upaya login
        Log::info('Mencoba login dengan kredensial: ', ['email' => $request->email]);

        // Upaya login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('Login berhasil untuk pengguna ID: ' . $user->id . ' dengan peran: ' . $user->roles);

            // Cek peran pengguna dan arahkan ke dashboard yang sesuai
            if ($user->roles === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->roles === 'user') {
                return redirect()->route('dashboard');
            }

            // Jika peran tidak terdefinisi, tetap arahkan ke dashboard umum
            return redirect()->route('dashboard');
        }

        // Jika login gagal, kembalikan pesan error
        Log::warning('Login gagal untuk email: ' . $request->email);

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    public function showRegisterForm()
    {
        // Menampilkan semua data gudang untuk dropdown saat registrasi
        $gudangs = Gudang::all();
        return view('auth.register', compact('gudangs'));
    }

    public function register(Request $request)
    {
        // Validasi input registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|string|in:admin,user',
            'gudang_id' => 'required|exists:gudangs,id',
        ]);

        // Buat user baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'roles' => $validated['roles'],
            'gudang_id' => $validated['gudang_id'],
        ]);

        // Arahkan ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        // Proses logout pengguna
        Auth::logout();
        return redirect()->route('login');
    }
}
