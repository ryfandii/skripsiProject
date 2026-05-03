@extends('layouts.app')
@section('content')

<h3>Input Soal: {{ $ujian->judul }}</h3>

@if(session('success')) <div>{{ session('success') }}</div> @endif
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif

<form method="POST" action="{{ route('guru.ujian.storeSoal', $ujian->id) }}">
@csrf

@for($i=0; $i<5; $i++)
    <p>Soal {{ $i+1 }}</p>

    <input type="text" name="soal[{{ $i }}][pertanyaan]" placeholder="Pertanyaan" required><br>

    <input type="text" name="soal[{{ $i }}][a]" placeholder="A" required><br>
    <input type="text" name="soal[{{ $i }}][b]" placeholder="B" required><br>
    <input type="text" name="soal[{{ $i }}][c]" placeholder="C" required><br>
    <input type="text" name="soal[{{ $i }}][d]" placeholder="D" required><br>

    <select name="soal[{{ $i }}][jawaban]" required>
        <option value="a">A</option>
        <option value="b">B</option>
        <option value="c">C</option>
        <option value="d">D</option>
    </select>
    <hr>
@endfor

<button>Simpan Soal</button>
</form>

@endsection