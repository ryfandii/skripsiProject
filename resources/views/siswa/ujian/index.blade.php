@extends('layouts.app')

@section('content')

<h2>Ujian Tersedia</h2>

@foreach($ujians as $u)
    <div class="card mb-2 p-3">
        <h5>{{ $u->judul }}</h5>
        <p>Durasi: {{ $u->durasi }} menit</p>

        <a href="{{ route('siswa.ujian.kerjakan', $u->id) }}" class="btn btn-primary">
            Kerjakan
        </a>
    </div>
@endforeach

@endsection