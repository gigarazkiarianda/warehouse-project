@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Gudang</h1>

    {{-- Notifikasi --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <a href="{{ route('gudangs.create') }}" class="btn btn-primary mb-3">Tambah Gudang</a>

    @if ($gudangs->isEmpty())
        <div class="alert alert-info">Tidak ada gudang yang tersedia.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gudangs as $gudang)
                        <tr>
                            <td>
                                <a href="{{ route('gudangs.show', $gudang->id) }}" class="text-black no-underline hover:text-blue-500">{{ $gudang->nama }}</a>
                            </td>
                            <td>{{ $gudang->lokasi }}</td>
                            <td>{{ $gudang->kapasitas }} </td>
                            <td>
                                <a href="{{ route('gudangs.edit', $gudang->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                <form action="{{ route('gudangs.destroy', $gudang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gudang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tambahkan Pagination -->
        <div class="mt-4">
            {{ $gudangs->links() }}
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .text-black {
        color: black;
        text-decoration: none; /* Remove underline */
    }
    .text-black:hover {
        color: blue;
    }
</style>
@endsection
