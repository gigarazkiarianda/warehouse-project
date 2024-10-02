@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pengguna</h1>

    <!-- Form untuk mengedit pengguna -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input untuk nama pengguna -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input untuk email pengguna -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown untuk gudang -->
        <div class="mb-3">
            <label for="gudang_id" class="form-label">Pilih Gudang</label>
            <select class="form-select @error('gudang_id') is-invalid @enderror" id="gudang_id" name="gudang_id" required>
                <option value="" disabled>Pilih Gudang</option>
                @foreach ($gudangs as $gudang)
                    <option value="{{ $gudang->id }}" {{ old('gudang_id', $user->gudang_id) == $gudang->id ? 'selected' : '' }}>
                        {{ $gudang->nama }}
                    </option>
                @endforeach
            </select>
            @error('gudang_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown untuk peran pengguna -->
        <div class="mb-3">
            <label for="roles" class="form-label">Pilih Peran</label>
            <select class="form-select @error('roles') is-invalid @enderror" id="roles" name="roles" required>
                <option value="" disabled>Pilih Peran</option>
                <option value="admin" {{ old('roles', $user->roles) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="karyawan" {{ old('roles', $user->roles) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="supervisor" {{ old('roles', $user->roles) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
            </select>
            @error('roles')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol untuk menyimpan perubahan -->
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
