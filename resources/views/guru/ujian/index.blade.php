@extends('layouts.app')
@section('content')
<a href="{{ route('guru.ujian.create') }}">+ Buat Ujian</a>
<ul>
@foreach($data as $u)
    <li>
        {{ $u->judul }}
        <a href="{{ route('guru.ujian.soal', $u->id) }}">Input Soal</a>
    </li>
@endforeach
</ul>
@endsection