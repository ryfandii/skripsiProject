@extends('layouts.app')

@section('content')

<h2>Hasil Ujian</h2>

<div class="card p-4">
    <h3>Nilai: {{ $nilai }}</h3>
    <p>Benar: {{ $benar }} / {{ $total }}</p>

    <a href="{{ route('siswa.dashboard') }}" class="btn btn-primary">
        Kembali ke Dashboard
    </a>
</div>

@endsection