@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="alert alert-success" role="alert">
        Selamat datang, {{ $user->name }}! Anda berhasil login ke sistem manajemen gudang.
    </div>
</div>
@endsection
