<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gudang;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Import facade Auth

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua gudang
        $gudangs = Gudang::all();

        // Ambil ID gudang yang dipilih dari query parameter
        $selectedGudangId = $request->input('gudang_id');

        // Filter produk berdasarkan gudang_id jika ada, jika tidak ambil semua produk
        $products = $selectedGudangId
            ? Product::where('gudang_id', $selectedGudangId)->get()
            : Product::all();

        // Ambil data pengguna yang sedang login
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Kirim data ke view dashboard
        return view('dashboard', compact('products', 'gudangs', 'selectedGudangId', 'user'));
    }
}
