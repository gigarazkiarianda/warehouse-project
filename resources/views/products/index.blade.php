@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Daftar Produk</h1>

    <!-- Filter by Gudang -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="form-group mb-3">
            <label for="gudang">Pilih Gudang:</label>
            <select name="gudang_id" id="gudang" class="form-control">
                <option value="">Semua Gudang</option>
                @foreach ($gudangs as $gudang)
                    <option value="{{ $gudang->id }}" {{ $gudang->id == $selectedGudangId ? 'selected' : '' }}>
                        {{ $gudang->id }} - {{ $gudang->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Lokasi Gudang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->deskripsi }}</td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>{{ $product->gudang ? $product->gudang->nama : 'Tidak diketahui' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
