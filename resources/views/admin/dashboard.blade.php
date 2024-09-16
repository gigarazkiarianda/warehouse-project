@extends('layouts.app')

@section('content')
    <h1>Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pengguna</h5>
                    <p class="card-text">{{ $usersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk</h5>
                    <p class="card-text">{{ $productsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Stok</h5>
                    <p class="card-text">{{ $stockCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
