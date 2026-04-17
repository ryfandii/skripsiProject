@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-warning">Edit Kelas</h2>

    <div class="card shadow-lg border-0">
        <div class="card-body">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control"
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control"
                        value="{{ old('jurusan', $kelas->jurusan) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">
                        Kembali
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