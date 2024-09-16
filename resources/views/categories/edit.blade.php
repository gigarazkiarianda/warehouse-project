@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Kategori</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ url('categories/' . $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ url('categories') }}" class="btn btn-secondary ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
