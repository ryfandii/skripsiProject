@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Input Nilai Siswa</h1>

    <div class="card shadow">
        <div class="card-body">

            <!-- PILIH KELAS -->
            <div class="mb-3">
                <label>Kelas</label>
                <select id="kelas" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 🔥 MAPEL OTOMATIS -->
            <div class="mb-3">
                <label>Mata Pelajaran</label>
                <input type="text" class="form-control" value="{{ $mapel->nama_mapel }}" readonly>
            </div>

            <form action="{{ route('guru.nilai.storeBatch') }}" method="POST">
                @csrf

                <!-- 🔥 kirim mapel otomatis -->
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Siswa</th>
                            <th width="200">Nilai</th>
                        </tr>
                    </thead>
                    <tbody id="data-siswa">
                        <tr>
                            <td colspan="3" class="text-center">Pilih kelas terlebih dahulu</td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-success mt-2">
                    Simpan Nilai
                </button>
            </form>

        </div>
    </div>

</div>

<script>
document.getElementById('kelas').addEventListener('change', function() {

    let kelas_id = this.value;

    if (!kelas_id) {
        document.getElementById('data-siswa').innerHTML =
            `<tr><td colspan="3" class="text-center">Pilih kelas terlebih dahulu</td></tr>`;
        return;
    }

    fetch('/guru/get-siswa/' + kelas_id)
        .then(res => res.json())
        .then(data => {

            let html = '';
            let no = 1;

            if (data.length === 0) {
                html = `<tr><td colspan="3" class="text-center">Tidak ada siswa</td></tr>`;
            } else {
                data.forEach(siswa => {
                    html += `
                        <tr>
                            <td>${no++}</td>
                            <td>${siswa.nama}</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="nilai[${siswa.id}]" 
                                    class="form-control"
                                    min="0" 
                                    max="100"
                                    required
                                >
                            </td>
                        </tr>
                    `;
                });
            }

            document.getElementById('data-siswa').innerHTML = html;

        });
});
</script>

@endsection