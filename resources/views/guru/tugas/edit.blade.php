@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Edit Tugas</h4>

    <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- JUDUL --}}
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $tugas->judul }}" required>
        </div>

        {{-- KELAS --}}
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" 
                        {{ $tugas->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $tugas->deskripsi }}</textarea>
        </div>

        {{-- FILE LAMA --}}
        <div class="mb-3">
            <label>File Lama</label><br>

            @if($tugas->file)
                <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank">
                    Lihat / Download File
                </a>
            @else
                <span class="text-muted">Tidak ada file</span>
            @endif
        </div>

        {{-- GANTI FILE --}}
        <div class="mb-3">
            <label>Ganti File (opsional)</label>
            <input type="file" name="file" class="form-control"
                accept=".pdf,.doc,.docx,.ppt,.pptx">
        </div>

        {{-- DEADLINE (DATETIME) --}}
        <div class="mb-3">
            <label>Deadline</label>
            <input type="datetime-local" name="deadline"
value="{{ \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') }}">
        </div>

        {{-- BUTTON --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection