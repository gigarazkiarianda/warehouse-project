<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Gudang;


class ProductController extends Controller
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

        // Kirim data ke view
        return view('products.index', compact('products', 'gudangs', 'selectedGudangId'));
    }

    public function create()
    {
        // Ambil semua gudang
        $gudangs = Gudang::all();

        // Tampilkan view dengan data gudang
        return view('products.create', compact('gudangs'));
    }

    public function store(Request $request)
{
    // Validasi input dari pengguna
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'gudang_id' => 'required|exists:gudangs,id', // Pastikan nama tabel yang benar
    ]);

    // Simpan produk baru
    Product::create($request->all());

    // Redirect ke halaman produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
}


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}

