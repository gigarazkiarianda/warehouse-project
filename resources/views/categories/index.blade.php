@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Kategori</h1>

        <a href="{{ url('categories/create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($categories->isEmpty())
            <div class="alert alert-info">Tidak ada kategori yang tersedia.</div>
        @else
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <div>
                            <a href="{{ url('categories/' . $category->id . '/edit') }}" class="btn btn-warning btn-sm me-2">Edit</a>
                            <form action="{{ url('categories/' . $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
