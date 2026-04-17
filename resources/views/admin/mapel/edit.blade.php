@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Mata Pelajaran</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Mapel</label>
                    <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Kode Mapel</label>
                    <input type="text" name="kode_mapel" value="{{ $mapel->kode_mapel }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Jam Pelajaran</label>
                    <input type="number" name="jam_pelajaran" value="{{ $mapel->jam_pelajaran }}" class="form-control">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection