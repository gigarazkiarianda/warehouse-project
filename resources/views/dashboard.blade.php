@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="alert alert-success animated-message" role="alert">
        Selamat datang, {{ $user->name }}! Anda berhasil login ke sistem manajemen gudang.
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alert = document.querySelector('.animated-message');
        alert.classList.add('fade-in');
    });
</script>
@endsection
@endsection
