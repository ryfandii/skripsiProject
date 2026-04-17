@extends('layouts.app')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Jadwal</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="form-control">
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 🔥 TAMBAHAN GURU -->
            <div class="form-group">
    <label>Guru</label>
    <select name="guru_id" class="form-control">
        @foreach($guru as $g)
            <option value="{{ $g->id }}">{{ $g->nama }}</option>
        @endforeach
    </select>
</div>

            <div class="form-group">
                <label>Hari</label>
                <select name="hari" class="form-control">
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control">
            </div>

            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control">
            </div>

            <button class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>

            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            </form>

        </div>
    </div>

</div>
@endsection