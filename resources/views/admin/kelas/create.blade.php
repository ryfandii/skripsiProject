@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Kelas</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: X IPA 1">
                </div>

                <div class="form-group">
                    <label>Jurusan</label>
                    <select name="jurusan" class="form-control">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                    </select>
                </div>

                <button class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection