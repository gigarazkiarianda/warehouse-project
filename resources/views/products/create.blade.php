@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Produk</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" step="0.01" required>
        </div>
        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" required>
        </div>
        <div class="form-group mb-4">
            <label for="gudang">Lokasi Gudang</label>
            <select id="gudang" name="gudang_id" class="form-control" required>
                <option value="">Pilih Gudang</option>
                @foreach ($gudangs as $gudang)
                    <option value="{{ $gudang->id }}">{{ $gudang->id }} - {{ $gudang->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
