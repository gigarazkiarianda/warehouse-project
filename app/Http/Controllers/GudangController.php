<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Product;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    protected $productController;

    public function __construct(ProductController $productController)
    {
        $this->productController = $productController;
    }

    public function index()
    {
        $gudangs = Gudang::with('products')->paginate(10);
        return view('gudangs.index', compact('gudangs'));
    }

    public function create()
    {
        return view('gudangs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        Gudang::create($request->all());
        return redirect()->route('gudangs.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function edit(Gudang $gudang)
    {
        return view('gudangs.edit', compact('gudang'));
    }

    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $gudang->update($request->all());
        return redirect()->route('gudangs.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect()->route('gudangs.index')->with('success', 'Gudang berhasil dihapus.');
    }

    public function show($id)
    {
        $gudang = Gudang::findOrFail($id);
        $produk = Product::where('gudang_id', $id)->get();
        $totalUsedCapacity = $produk->sum('stok');
        $available_capacity = $gudang->kapasitas - $totalUsedCapacity;


        if ($totalUsedCapacity >= $gudang->kapasitas) {
            return redirect()->route('gudangs.index')->with('error', 'Kapasitas gudang sudah penuh.');
        } elseif ($available_capacity <= 10) {
            return redirect()->route('gudangs.index')->with('warning', 'Kapasitas gudang hampir penuh. Sisa kapasitas: ' . $available_capacity);
        }

        return view('gudangs.show', compact('gudang', 'produk', 'available_capacity'));
    }

    public function getUsedCapacityByGudang($gudang_id)
    {
        $products = Product::where('gudang_id', $gudang_id)->get();
        $usedCapacity = $products->sum('stok');
        return $usedCapacity;
    }
}
