@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Profil Pengguna</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    <!-- Display user photo -->
                    @if ($user->biodata && $user->biodata->foto)
                        <img src="{{ Storage::url($user->biodata->foto) }}" alt="{{ $user->name }}'s photo" class="img-fluid" style="max-width: 200px; border-radius: 10px;">
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
                    <p><strong>Nama Lengkap:</strong> {{ $user->biodata->nama_lengkap ?? 'Tidak tersedia' }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $user->biodata->tempat_lahir ?? 'Tidak tersedia' }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $user->biodata->tanggal_lahir ? \Carbon\Carbon::parse($user->biodata->tanggal_lahir)->format('d-m-Y') : 'Tidak tersedia' }}</p>
                    <p><strong>Nomor HP:</strong> {{ $user->biodata->nomor_hp ?? 'Tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
