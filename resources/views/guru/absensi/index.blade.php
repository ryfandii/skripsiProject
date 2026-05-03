@extends('layouts.app')

@section('content')
<div class="container mt-4">

<h4 class="fw-bold mb-4">📊 Manajemen Absensi Guru</h4>

<div class="card shadow p-4 mb-4">

<form method="GET" action="{{ route('guru.absensi') }}">

<div class="row">

    <div class="col-md-6 mb-3">
        <label class="fw-bold">Kelas</label>
        <select name="kelas_id" class="form-control" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id }}" 
                    {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

   <div class="col-md-6 mb-3">
    <label class="fw-bold">Mapel</label>

   <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

    <input type="text" class="form-control"
       value="{{ $mapel->nama_mapel }}" readonly>
</div>

</div>

<button class="btn btn-primary w-100">
    ▶ Mulai Absensi
</button>

</form>

</div>

{{-- 🔥 TAMPIL FORM ABSENSI --}}
@if(isset($siswa))

<div class="card shadow p-4 mb-4">

<h5 class="fw-bold mb-3">
    📋 Absensi Kelas {{ $kelasAktif->nama_kelas }}
</h5>

<form method="POST" action="{{ route('guru.absensi.simpan') }}">
@csrf

<input type="hidden" name="kelas_id" value="{{ $kelasAktif->id }}">

<input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

<div class="mb-3">
    <label class="fw-bold">Mapel</label>
    <input type="text" class="form-control" 
          value="{{ $mapel->nama_mapel }}" readonly>
</div>

<div class="mb-3">
    <button type="button" class="btn btn-success btn-sm" onclick="setAll('hadir')">
        ✔ Semua Hadir
    </button>
</div>

<table class="table table-bordered">
<thead>
<tr>
    <th>Nama</th>
    <th>Status</th>
    <th>Keterangan</th>
</tr>
</thead>

<tbody>
@foreach($siswa as $s)
<tr>
    <td>{{ $s->nama }}</td>

    <td>
        <select name="absensi[{{ $s->id }}][status]" class="form-control status">
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="alpha">Alpha</option>
        </select>
    </td>

    <td>
        <input type="text" 
               name="absensi[{{ $s->id }}][keterangan]" 
               class="form-control"
               placeholder="Opsional...">
    </td>
</tr>
@endforeach
</tbody>
</table>

<button class="btn btn-primary w-100 mt-3">
    💾 Simpan Absensi
</button>

</form>

</div>

@endif

{{-- 🔥 DATA ABSENSI --}}
@if(isset($riwayat))

<div class="card shadow p-4">

<h5 class="fw-bold mb-3">📊 Riwayat Absensi</h5>

<table class="table table-bordered">
<thead>
<tr>
    <th>Nama</th>
    <th>Status</th>
    <th>Keterangan</th>
</tr>
</thead>

<tbody>
@forelse($riwayat as $r)
<tr>
    <td>{{ $r->siswa->nama }}</td>
    <td>{{ ucfirst($r->status) }}</td>
    <td>{{ $r->keterangan }}</td>
</tr>
@empty
<tr>
    <td colspan="3" class="text-center text-muted">Belum ada data</td>
</tr>
@endforelse
</tbody>
</table>

</div>

@endif

</div>

<script>
function setAll(status) {
    document.querySelectorAll('.status').forEach(el => {
        el.value = status;
    });
}
</script>

@endsection