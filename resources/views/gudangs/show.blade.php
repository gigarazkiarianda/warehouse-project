@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Gudang</h1>

    {{-- Notifikasi --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{ $gudang->nama }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Lokasi:</strong> {{ $gudang->lokasi }}</p>
            <p><strong>Kapasitas Total:</strong> {{ $gudang->kapasitas }} unit</p>
            <p><strong>Kapasitas Digunakan:</strong> {{ $gudang->kapasitas - $available_capacity }} unit</p>
            <p><strong>Kapasitas Tersedia:</strong> {{ $available_capacity }} unit</p>
        </div>
    </div>

    <h2 class="mb-4">Daftar Produk di Lokasi Ini</h2>

    @if ($produk->isEmpty())
        <div class="alert alert-info">Tidak ada produk yang tersedia di lokasi ini.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Stok</th>
                        <th>Kapasitas yang Digunakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->stok }} unit</td> <!-- Misalnya setiap produk menggunakan 1 unit dari kapasitas -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('gudangs.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali ke Daftar Gudang</a>
</div>
@endsection
