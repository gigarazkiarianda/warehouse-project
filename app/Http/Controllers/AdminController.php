<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman utama admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index'); // Pastikan Anda memiliki view ini
    }

    /**
     * Menampilkan halaman dashboard admin.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Contoh data yang bisa ditampilkan di dashboard
        $data = [
            'usersCount' => \App\Models\User::count(),
            'productsCount' => \App\Models\Product::count(),
            'stockCount' => \App\Models\Stock::count(),
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Menampilkan halaman pengaturan admin.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        return view('admin.settings'); // Pastikan Anda memiliki view ini
    }
}
