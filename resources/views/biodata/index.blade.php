@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Biodata</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($biodatas->isEmpty())
        <div class="alert alert-info">
            Belum ada biodata yang tersedia.
        </div>
    @else
        <div class="row">
            @foreach($biodatas as $biodata)
                <div class="col-12 mb-4">
                    <div class="card mx-auto" style="max-width: 100%; width: 100%; border: 1px solid #ddd;">
                        <div class="card-body text-center">
                            <!-- Foto Profil -->
                            <img src="{{ Storage::url($biodata->foto) }}" alt="Foto Profil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ddd;">

                            <!-- Informasi Biodata -->
                            <h5 class="card-title mt-3">{{ $biodata->nama_lengkap }}</h5>
                            <p class="card-text">
                                <strong>Tempat Lahir:</strong> {{ $biodata->tempat_lahir }}<br>
                                <strong>Tanggal Lahir:</strong> {{ $biodata->tanggal_lahir->format('d-m-Y') }}<br>
                                <strong>Nomor HP:</strong> {{ $biodata->nomor_hp }}
                            </p>

                            <!-- Tombol Edit -->
                            <a href="{{ route('biodata.edit', $biodata) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
