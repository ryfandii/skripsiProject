@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h4 class="fw-bold mb-1">Tambah Tugas</h4>
        <small class="text-muted">Isi data tugas yang akan diberikan kepada siswa</small>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Mata Pelajaran</label>

                        @if($mapel)
                            <input type="text" class="form-control"
                                value="{{ $mapel->nama_mapel }}"
                                readonly>

                            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                        @else
                            <input type="text" class="form-control"
                                value="Mapel belum diset di akun guru" readonly>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Upload File Tugas</label>
                        <input type="file" name="file" class="form-control"
                            accept=".pdf,.doc,.docx,.ppt,.pptx">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control" required>
                    </div>

                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Tugas
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection