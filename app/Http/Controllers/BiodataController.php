<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Tambahkan baris ini untuk mengimpor Carbon

class BiodataController extends Controller
{
    public function index()
    {
        // Mengambil biodata untuk pengguna yang sedang login
        $biodatas = Biodata::where('user_id', auth()->id())->get();

        // Konversi tanggal lahir menjadi Carbon instance
        foreach ($biodatas as $biodata) {
            $biodata->tanggal_lahir = Carbon::parse($biodata->tanggal_lahir);
        }

        return view('biodata.index', compact('biodatas'));
    }

    public function create()
    {
        return view('biodata.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'nama_lengkap' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'nomor_hp' => 'required|string|max:20',
        'user_id' => 'required|exists:users,id',
    ]);

    $path = $request->file('foto')->store('public/fotos');

    Biodata::create([
        'foto' => $path,
        'nama_lengkap' => $request->nama_lengkap,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'nomor_hp' => $request->nomor_hp,
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('biodata.index')->with('success', 'Biodata berhasil ditambahkan.');
}

    public function edit(Biodata $biodata)
    {
        return view('biodata.edit', compact('biodata'));
    }

    public function update(Request $request, Biodata $biodata)
    {
        $request->validate([
            'foto' => 'sometimes|image|mimes:jpg,png,jpeg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:20',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete($biodata->foto);
            $path = $request->file('foto')->store('public/fotos');
            $biodata->foto = $path;
        }

        $biodata->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_hp' => $request->nomor_hp,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('biodata.update')->with('success', 'Biodata berhasil diperbarui.');
    }

    public function destroy(Biodata $biodata)
    {
        Storage::delete($biodata->foto);
        $biodata->delete();
        return redirect()->route('biodata.index')->with('success', 'Biodata berhasil dihapus.');
    }
}
