@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Profil Saya</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    <!-- Display user photo -->
                    @if ($biodata && $biodata->foto)
                        <img src="{{ Storage::url($biodata->foto) }}" alt="{{ $user->name }}'s photo" class="img-fluid" style="max-width: 200px; border-radius: 10px;">
                    @else
                        <div class="placeholder" style="width: 200px; height: 200px; background-color: #f0f0f0; border-radius: 10px;"></div>
                        <p><strong>Foto:</strong> Tidak tersedia</p>
                    @endif
                </div>

                <div class="col-md-8">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Gudang:</strong> {{ optional($user->gudang)->nama }}</p>

                    <h6>Biodata:</h6>
                    <p><strong>Nama Lengkap:</strong> {{ $biodata->nama_lengkap ?? 'Tidak tersedia' }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $biodata->tempat_lahir ?? 'Tidak tersedia' }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d-m-Y') : 'Tidak tersedia' }}</p>
                    <p><strong>Nomor HP:</strong> {{ $biodata->nomor_hp ?? 'Tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
