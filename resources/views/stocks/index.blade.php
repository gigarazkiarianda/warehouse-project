@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Laporan Stok</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Gudang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->nama }}</td>
                    <td>{{ $stock->gudang->nama }}</td>
                    <td>{{ $stock->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
