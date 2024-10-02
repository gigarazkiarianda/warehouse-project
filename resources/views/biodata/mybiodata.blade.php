@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Biodata Saya</h1>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card mx-auto" style="max-width: 100%; width: 100%; border: 1px solid #ddd;">
                <div class="card-body">
                    <!-- Foto Profil -->
                    <div class="text-center mb-3">
                        @if($biodata->foto)
                            <img src="{{ Storage::url($biodata->foto) }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ddd;">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ddd;">
                        @endif
                    </div>

                    <!-- Informasi Biodata -->
                    <h5 class="card-title mt-3">{{ $biodata->nama_lengkap }}</h5>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <strong>Tempat Lahir:</strong> {{ $biodata->tempat_lahir ?? 'Tidak tersedia' }}
                        </div>
                        <div class="col-12 mb-2">
                            <strong>Tanggal Lahir:</strong> {{ $biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d-m-Y') : 'Tidak tersedia' }}
                        </div>
                        <div class="col-12 mb-2">
                            <strong>Nomor HP:</strong> {{ $biodata->nomor_hp ?? 'Tidak tersedia' }}
                        </div>
                    </div>

                    <!-- Tombol Edit -->
                    <div class="text-end">
                        <a href="{{ route('biodata.edit', $biodata->id) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
