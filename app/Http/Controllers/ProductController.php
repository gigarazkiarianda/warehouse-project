<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Gudang;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $gudangs = Gudang::all();
        $selectedGudangId = $request->input('gudang_id');


        $products = Product::when($selectedGudangId, function ($query) use ($selectedGudangId) {
            return $query->where('gudang_id', $selectedGudangId);
        })->paginate(10);


        foreach ($products as $product) {
            if ($product->stok <= 0) {
                return redirect()->route('products.index')->with('error', "Produk '{$product->nama}' habis.");
            } elseif ($product->stok < 5) {
                session()->flash('warning', "Produk '{$product->nama}' hampir habis, hanya tersisa {$product->stok} unit.");
            }
        }

        return view('products.index', compact('products', 'gudangs', 'selectedGudangId'));
    }

    public function create()
    {
        $gudangs = Gudang::all();
        return view('products.create', compact('gudangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gudang_id' => 'required|exists:gudangs,id',
            'category' => 'nullable|string|max:255',
        ]);

        $product = Product::create($request->all());


        if ($product->stok <= 0) {
            return redirect()->route('products.index')->with('error', "Produk '{$product->nama}' habis.");
        } elseif ($product->stok < 5) {
            session()->flash('warning', "Produk '{$product->nama}' hampir habis, hanya tersisa {$product->stok} unit.");
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gudang_id' => 'required|exists:gudangs,id',
            'category' => 'nullable|string|max:255',
        ]);

        $product->update($request->all());


        if ($product->stok <= 0) {
            return redirect()->route('products.index')->with('error', "Produk '{$product->nama}' habis.");
        } elseif ($product->stok < 5) {
            session()->flash('warning', "Produk '{$product->nama}' hampir habis, hanya tersisa {$product->stok} unit.");
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function edit(Product $product)
    {
        $gudangs = Gudang::all();
        return view('products.edit', compact('product', 'gudangs'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }


    public function getUsedCapacityByGudang($gudangId)
    {
        return Product::where('gudang_id', $gudangId)->sum('stok');
    }
}
