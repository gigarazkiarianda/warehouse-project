@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $product->nama) }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" step="0.01" value="{{ old('harga', $product->harga) }}" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" value="{{ old('stok', $product->stok) }}" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $product->category) }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
