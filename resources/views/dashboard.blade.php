@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <!-- Notifikasi berhasil login -->
    <div class="alert alert-success animated-message" role="alert">
        Selamat datang, {{ $user->name }}! Anda berhasil login ke sistem manajemen gudang.
    </div>

    <!-- Filter by Gudang -->
    <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="gudang">Pilih Gudang:</label>
            <select name="gudang_id" id="gudang" class="form-control">
                <option value="">Semua Gudang</option>
                @foreach($gudangs as $gudang)
                    <option value="{{ $gudang->id }}" {{ $selectedGudangId == $gudang->id ? 'selected' : '' }}>
                        {{ $gudang->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>

    <!-- Daftar Produk -->
    <h2 class="mb-4">Daftar Produk</h2>
    @if($products->isEmpty())
        <p>Tidak ada produk yang tersedia.</p>
    @else
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $product->gudang ? $product->gudang->nama : 'Tidak diketahui' }}</h6>
                    <p class="card-text">{{ $product->deskripsi }}</p>
                    <p class="card-text">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="card-text">Stok: {{ $product->stok }}</p>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alert = document.querySelector('.animated-message');

        if (alert) {
            alert.classList.add('fade-in');

            setTimeout(() => {
                alert.classList.remove('fade-in');
                alert.classList.add('fade-out');

                setTimeout(() => {
                    alert.remove();
                }, 1000);
            }, 5000);
        }


        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.classList.add('fade-in');
            card.style.animationDelay = `${index * 0.3}s`;
        });
    });
</script>
@endsection

@section('styles')
<style>

    .fade-in {
        animation: fadeIn 1s forwards;
    }


    .fade-out {
        animation: fadeOut 1s forwards;
    }


    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }


    .card {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
@endsection
