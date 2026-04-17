@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3>Tambah Mata Pelajaran</h3>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.mapel.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Mapel</label>
            <input type="text" name="nama_mapel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Pelajaran</label>
            <input type="number" name="jam_pelajaran" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection