@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Kumpulkan Tugas</h4>

    <form action="{{ route('siswa.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Upload Jawaban</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-success">Upload</button>

    </form>

</div>
@endsection