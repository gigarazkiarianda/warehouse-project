@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Kategori</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ url('categories') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('categories') }}" class="btn btn-secondary ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
