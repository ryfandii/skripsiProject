@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-primary">Tambah Siswa</h2>

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

            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>
                </div>

                <hr>

                <h5 class="text-primary">Akun Login</h5>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                {{-- 🔥 INFO PASSWORD --}}
                <div class="alert alert-info">
                    Password default: <strong>12345678</strong><br>
                    Siswa wajib mengganti password saat login pertama.
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
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