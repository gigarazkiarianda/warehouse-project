<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Gudang;
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

        $products = Product::all();
        $gudangs = Gudang::all();

        return view('admin.index', compact('products', 'gudangs'));
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
            'gudangsCount' => \App\Models\Gudang::count(),

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
        return view('admin.settings');
    }
}
