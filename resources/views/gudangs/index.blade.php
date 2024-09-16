@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Gudang</h1>

    <a href="{{ route('gudangs.create') }}" class="btn btn-primary mb-3">Tambah Gudang</a>

    @if ($gudangs->isEmpty())
        <div class="alert alert-info">Tidak ada gudang yang tersedia.</div>
    @else
        <ul class="list-group">
            @foreach ($gudangs as $gudang)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $gudang->nama }}</strong> - {{ $gudang->lokasi }}
                        <span class="text-muted">(Kapasitas: {{ $gudang->kapasitas }})</span>
                    </div>
                    <div>
                        <a href="{{ route('gudangs.edit', $gudang->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('gudangs.destroy', $gudang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gudang ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
