<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        Log::info('Attempting to login with credentials: ', $credentials);

        // Mencoba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('Login successful for user ID: ' . $user->id . ' with role: ' . $user->role);

            // Arahkan pengguna berdasarkan peran mereka
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('dashboard');
            }

            // Jika tidak ada peran yang sesuai, arahkan ke dashboard default
            return redirect()->route('dashboard');
        }

        // Jika login gagal
        Log::warning('Login failed for credentials: ', $credentials);

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput(); // Mengembalikan input untuk mempermudah pengisian ulang formulir
    }

    // Menampilkan formulir registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani registrasi
    public function register(Request $request)
{
    // Validasi data input tanpa password_confirmation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role' => 'required|string|in:admin,user',
    ]);

    // Simpan ke database
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
    ]);

    // Redirect setelah registrasi berhasil
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    // Menangani logout
    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect()->route('login'); // Redirect ke halaman login
    }
}
