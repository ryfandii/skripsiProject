@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-warning">Edit Guru</h2>

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama" value="{{ $guru->nama }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">NIP</label>
                    <input type="text" name="nip" value="{{ $guru->nip }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mapel</label>
                    <input type="text" name="mapel" value="{{ $guru->mapel }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <input type="text" name="alamat" value="{{ $guru->alamat }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Telepon</label>
                    <input type="text" name="telepon" value="{{ $guru->telepon }}" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
