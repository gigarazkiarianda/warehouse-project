@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ $product->nama }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" class="form-control" step="0.01" value="{{ $product->harga }}" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" value="{{ $product->stok }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
