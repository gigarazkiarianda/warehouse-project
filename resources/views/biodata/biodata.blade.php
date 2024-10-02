@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Biodata</h1>

    <div class="card">
        <div class="card-body">
            @if($biodata && $biodata->foto)
                <img src="{{ Storage::url($biodata->foto) }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px;">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px;">
            @endif

            <h5>{{ $biodata ? $biodata->nama_lengkap : 'Tidak tersedia' }}</h5>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tempat Lahir:</strong> {{ $biodata->tempat_lahir ?? 'Tidak tersedia' }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d-m-Y') : 'Tidak tersedia' }}</p>
            <p><strong>Nomor HP:</strong> {{ $biodata->nomor_hp ?? 'Tidak tersedia' }}</p>
        </div>
    </div>
</div>
@endsection
