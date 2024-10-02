<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua pengguna dengan relasi gudang, gunakan pagination
        $users = User::with('gudang')->paginate(10);

        // Kirim data pengguna ke view
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ambil semua gudang untuk digunakan dalam dropdown
        $gudangs = Gudang::all();
        return view('users.create', compact('gudangs'));
    }

    /**
     * Menyimpan pengguna baru ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'gudang_id' => 'required|exists:gudangs,id',
            'roles' => 'required|string',
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gudang_id' => $request->gudang_id,
            'roles' => $request->roles,
        ]);

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit pengguna.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        // Ambil semua gudang
        $gudangs = Gudang::all();
        return view('users.edit', compact('user', 'gudangs'));
    }

    /**
     * Memperbarui pengguna di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'gudang_id' => 'required|exists:gudangs,id',
            'roles' => 'required|string',
        ]);

        // Update data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gudang_id' => $request->gudang_id,
            'roles' => $request->roles,
        ]);

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Hapus pengguna
        $user->delete();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Menampilkan profil pengguna berdasarkan ID.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function profile($id)
    {
        // Ambil pengguna berdasarkan ID dan relasi biodata
        $user = User::with('biodata')->findOrFail($id);

        // Pastikan pengguna yang ditampilkan bukan yang sedang login
        if (Auth::id() === $user->id) {
            return redirect()->route('users.myProfile');
        }

        return view('users.profile', compact('user'));
    }

    /**
     * Menampilkan profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function myProfile()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $biodata = $user->biodata; // Ambil biodata pengguna yang sedang login

        return view('users.myProfile', compact('user', 'biodata'));
    }
}
