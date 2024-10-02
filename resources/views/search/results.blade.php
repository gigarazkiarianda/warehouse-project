@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Hasil Pencarian</h2>

    @if($products->isEmpty() && $gudangs->isEmpty() && $users->isEmpty())
        <p>Hasil pencarian tidak ditemukan.</p>
    @else
        <div class="row">
            <!-- Products Section -->
            @if($products->isNotEmpty())
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <h3 class="animate__animated animate__fadeIn">Produk</h3>
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li class="list-group-item animate__animated animate__fadeIn">
                                <a href="{{ route('products.index', $product->id) }}" class="text-decoration-none">
                                    <h5 class="mb-1">{{ $product->nama }}</h5>
                                </a>
                                <p class="mb-1">Harga: {{ $product->harga }}</p>
                                <p class="mb-1">Deskripsi: {{ $product->deskripsi }}</p>
                                <p class="mb-1">Stok: {{ $product->stok }}</p>
                                <p class="mb-1">Gudang: {{ optional($product->gudang)->warehouse_name }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Gudangs Section -->
            @if($gudangs->isNotEmpty())
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <h3 class="animate__animated animate__fadeIn">Gudang</h3>
                    <ul class="list-group">
                        @foreach($gudangs as $gudang)
                            <li class="list-group-item animate__animated animate__fadeIn">
                                <a href="{{ route('gudangs.index', $gudang->id) }}" class="text-decoration-none">
                                    <h5 class="mb-1">{{ $gudang->nama }}</h5>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Users Section -->
            @if($users->isNotEmpty())
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <h3 class="animate__animated animate__fadeIn">Pengguna</h3>
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item animate__animated animate__fadeIn">
                                <!-- Update the route to link to the biodata show page -->
                                <a href="{{ route('biodata.show', $user->biodata->id ?? null) }}" class="text-decoration-none">
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

@push('styles')
<!-- Import Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endpush
