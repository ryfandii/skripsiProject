@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Nilai</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" class="form-control" value="{{ $nilai->siswa->nama }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Mata Pelajaran</label>
                    <input type="text" class="form-control" value="{{ $nilai->mapel->nama_mapel }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number" name="nilai" class="form-control"
                        value="{{ $nilai->nilai }}" min="0" max="100" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Update Nilai
                </button>

                <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection