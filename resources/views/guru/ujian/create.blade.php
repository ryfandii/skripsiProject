@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4 text-primary">📝 Buat Ujian + Soal</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('guru.ujian.store') }}">
                @csrf

                {{-- ================= UJIAN ================= --}}
                <h5 class="text-primary mb-3">📘 Data Ujian</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Durasi (menit)</label>
                        <input type="number" name="durasi" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Mulai</label>
                        <input type="datetime-local" name="mulai" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Selesai</label>
                        <input type="datetime-local" name="selesai" class="form-control">
                    </div>
                </div>

                <hr>

                {{-- ================= SOAL ================= --}}
                <h5 class="text-success mb-3">🧠 Soal Ujian</h5>

                <div id="soal-container">

                    {{-- SOAL PERTAMA --}}
                    <div class="soal-item border p-3 mb-3 rounded">

                        <label>Pertanyaan</label>
                        <textarea name="soal[0][pertanyaan]" class="form-control" required></textarea>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <input name="soal[0][a]" class="form-control" placeholder="Pilihan A">
                            </div>
                            <div class="col-md-6">
                                <input name="soal[0][b]" class="form-control" placeholder="Pilihan B">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input name="soal[0][c]" class="form-control" placeholder="Pilihan C">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input name="soal[0][d]" class="form-control" placeholder="Pilihan D">
                            </div>
                        </div>

                        <select name="soal[0][jawaban]" class="form-control mt-2">
                            <option value="a">Jawaban A</option>
                            <option value="b">Jawaban B</option>
                            <option value="c">Jawaban C</option>
                            <option value="d">Jawaban D</option>
                        </select>

                    </div>

                </div>

                <button type="button" class="btn btn-info mb-3" onclick="tambahSoal()">+ Tambah Soal</button>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.ujian.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button class="btn btn-success">
                        💾 Simpan Ujian + Soal
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
let index = 1;

function tambahSoal() {
    let html = `
    <div class="soal-item border p-3 mb-3 rounded">
        <label>Pertanyaan</label>
        <textarea name="soal[${index}][pertanyaan]" class="form-control"></textarea>

        <input name="soal[${index}][a]" class="form-control mt-2" placeholder="A">
        <input name="soal[${index}][b]" class="form-control mt-2" placeholder="B">
        <input name="soal[${index}][c]" class="form-control mt-2" placeholder="C">
        <input name="soal[${index}][d]" class="form-control mt-2" placeholder="D">

        <select name="soal[${index}][jawaban]" class="form-control mt-2">
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select>
    </div>
    `;

    document.getElementById('soal-container').insertAdjacentHTML('beforeend', html);
    index++;
}
</script>

@endsection