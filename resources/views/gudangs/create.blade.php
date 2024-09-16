@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Gudang</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('gudangs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas:</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('gudangs.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
