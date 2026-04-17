@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4 text-primary">Tambah Guru</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.guru.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>

                    {{-- MAPEL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-control" required>
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TELEPON --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                </div>

                <hr>

                <h5 class="text-primary">Akun Login</h5>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                {{-- INFO PASSWORD --}}
                <div class="alert alert-info">
                    Password default: <b>12345678</b><br>
                    Guru wajib mengganti password saat login pertama.
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button class="btn btn-success">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection