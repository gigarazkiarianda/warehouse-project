<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::all();
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


}
