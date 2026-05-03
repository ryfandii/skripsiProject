@extends('layouts.app')

@section('content')

<style>
/* ===== GLOBAL ===== */
* {
    font-family: 'Poppins', sans-serif;
}

/* ===== CARD ===== */
.card {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: none;
}

/* ===== HEADER ===== */
h3 {
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* ===== FILTER ===== */
.form-select {
    border-radius: 8px;
    padding: 6px 12px;
}

/* ===== TABLE ===== */
.table {
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
    border-radius: 10px;
}

/* HEADER GRADIENT */
.table thead {
    background: linear-gradient(to right, #eef1f5, #e6ebf1);
}

.table thead th {
    font-weight: 600;
    color: #555;
    border: none;
    padding: 14px;
}

/* BODY */
.table tbody tr {
    background: #ffffff;
    transition: 0.2s ease;
}

.table tbody tr:nth-child(even) {
    background: #f8fafc;
}

.table tbody tr:hover {
    background: #eef3f8;
}

.table td {
    padding: 14px;
    border: none;
    font-size: 14px;
}

/* ===== BADGE ===== */
.badge {
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 8px;
    font-weight: 500;
}

.badge.bg-success {
    background: #e6f7ee !important;
    color: #1f9d55;
}

.badge.bg-danger {
    background: #fdecea !important;
    color: #d93025;
}

.badge.bg-primary {
    background: #e8f0fe !important;
    color: #1a73e8;
}

.badge.bg-secondary {
    background: #f1f3f4 !important;
    color: #5f6368;
}

.badge.bg-info {
    background: #e3f2fd !important;
    color: #0b5ed7;
}

/* ===== BUTTON ===== */
.btn-sm {
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 6px;
}

.btn-danger {
    background: #d93025;
    border: none;
}

.btn-danger:hover {
    background: #b1271b;
}

td .btn {
    min-width: 80px;
}
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark">Data Siswa</h3>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
            Tambah Siswa
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="d-flex gap-2 align-items-center">

                <select name="kelas_id" class="form-select w-auto">
                    <option value="">Semua Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}"
                            {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary">Filter</button>

                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                    Reset
                </a>

            </form>
        </div>
    </div>

    {{-- BULK ACTION --}}
    <form action="{{ route('admin.siswa.bulkNonaktif') }}" method="POST">
        @csrf

        <button class="btn btn-danger mb-3"
            onclick="return confirm('Nonaktifkan siswa yang dipilih?')">
            Nonaktifkan Terpilih
        </button>

        {{-- TABLE --}}
        <div class="card">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table align-middle text-center">

                        <thead>
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="checkAll">
                                </th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Orang Tua</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($siswa as $item)
                            <tr>

                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                                </td>

                                <td>{{ $loop->iteration }}</td>

                                <td class="text-start">{{ $item->nama }}</td>

                                <td>
                                    @if($item->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">L</span>
                                    @else
                                        <span class="badge bg-secondary">P</span>
                                    @endif
                                </td>

                                <td>{{ $item->nis }}</td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>

                                <td class="text-start">{{ $item->nama_ortu }}</td>

                                <td>{{ $item->user->email ?? '-' }}</td>

                                <td class="text-start">{{ $item->alamat }}</td>

                                <td>{{ $item->telepon }}</td>

                                <td>
                                    @if($item->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.siswa.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        @if($item->status == 'aktif')
                                           <form action="{{ route('admin.siswa.nonaktif', $item->id) }}" method="POST" class="d-flex gap-1">
                                                @csrf

                                                <input type="text" name="alasan"
                                                    placeholder="Alasan..."
                                                    required
                                                    style="width:120px; font-size:12px;">

                                                <button class="btn btn-danger btn-sm">
                                                    Nonaktif
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('admin.siswa.aktifkan', $item->id) }}"
                                                class="btn btn-success btn-sm">
                                                Aktifkan
                                            </a>
                                        @endif

                                    </div>
                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="12" class="text-muted">
                                    Tidak ada data siswa
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </form>
</div>

{{-- CHECK ALL --}}
<script>
document.getElementById('checkAll').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>

@endsection