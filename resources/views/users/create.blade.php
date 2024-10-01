@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Tambah Pengguna Baru</h1>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection

@section('styles')
<style>
    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }
    }
</style>
@endsection
