@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-primary">Edit Siswa</h2>

    <div class="card shadow-lg border-0">
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

            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DATA SISWA --}}
                <h5 class="text-primary mb-3">Data Siswa</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" name="nama"
                            value="{{ old('nama', $siswa->nama) }}"
                            class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIS</label>
                        <input type="text" name="nis"
                            value="{{ old('nis', $siswa->nis) }}"
                            class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    {{-- NAMA ORANG TUA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Orang Tua</label>
                        <input type="text" name="nama_ortu"
                            value="{{ old('nama_ortu', $siswa->nama_ortu) }}"
                            class="form-control" required>
                    </div>
                </div>

                {{-- KELAS --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <input type="text" name="alamat"
                        value="{{ old('alamat', $siswa->alamat) }}"
                        class="form-control">
                </div>

                {{-- TELEPON --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Telepon</label>
                    <input type="text" name="telepon"
                        value="{{ old('telepon', $siswa->telepon) }}"
                        class="form-control">
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                        ⬅️ Batal
                    </a>

                    <button class="btn btn-success">
                        💾 Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection