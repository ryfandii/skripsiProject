@extends('layouts.app')

@section('content')

<style>
/* ===== GLOBAL ===== */
* {
    font-family: 'Poppins', sans-serif;
}

/* ===== PAGE HEADER ===== */
.page-title {
    font-weight: 600;
    letter-spacing: 0.3px;
    color: #1f2937;
    margin: 0;
}

/* ===== CARD ===== */
.card {
    border: none !important;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    overflow: hidden;
}

/* ===== TABLE ===== */
.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.table thead {
    background: linear-gradient(to right, #f1f3f6, #e7ebf0);
}

.table thead th {
    border: none !important;
    padding: 15px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #5b6472;
    vertical-align: middle;
    white-space: nowrap;
}

.table tbody tr {
    background: #ffffff;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.table tbody tr:nth-child(even) {
    background: #fafbfc;
}

.table tbody tr:hover {
    background: #f3f6fa;
}

.table tbody td {
    border-top: 1px solid #edf1f5 !important;
    border-left: none !important;
    border-right: none !important;
    border-bottom: none !important;
    padding: 15px 14px;
    font-size: 14px;
    color: #374151;
    vertical-align: middle;
}

/* ===== BADGE ===== */
.badge {
    font-size: 12px;
    font-weight: 600;
    padding: 7px 12px;
    border-radius: 999px;
    letter-spacing: 0.2px;
}

.badge-mapel {
    background: #eef4ff;
    color: #2f5ea8;
    border: 1px solid #dbe7ff;
}

.badge-status-active {
    background: #eaf8ef;
    color: #1f9d57;
    border: 1px solid #d5f0df;
}

.badge-status-inactive {
    background: #fdeeee;
    color: #d14343;
    border: 1px solid #f8d6d6;
}

/* ===== BUTTON ===== */
.btn {
    border-radius: 8px;
    font-weight: 500;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 13px;
}

.btn-action {
    min-width: 92px;
}

.btn-soft {
    background: #f8fafc;
    border: 1px solid #dbe2ea;
    color: #374151;
}

.btn-soft:hover {
    background: #eef2f6;
    border-color: #cfd8e3;
    color: #111827;
}

.btn-outline-warning:hover,
.btn-outline-success:hover {
    color: #fff;
}

/* ===== ALERT ===== */
.alert {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}

/* ===== EMPTY STATE ===== */
.empty-row td {
    padding: 28px 14px !important;
    color: #6b7280;
    font-size: 14px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .page-title {
        font-size: 22px;
    }

    .table thead th,
    .table tbody td {
        white-space: nowrap;
    }
}
</style>

<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title">Daftar Guru</h3>
        <a href="{{ route('admin.guru.create') }}" class="btn btn-primary px-4">
            Tambah Guru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Mapel</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($guru as $g)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>

                            <td class="fw-semibold text-start">
                                {{ $g->nama }}
                            </td>

                            <td>{{ $g->nip }}</td>

                            <td>
                                <span class="badge badge-mapel">
                                   {{ $g->mapel->nama_mapel ?? '-' }}
                                </span>
                            </td>

                            <td class="text-muted">
                                {{ $g->user->email ?? '-' }}
                            </td>

                            <td class="text-start text-muted">
                                {{ $g->alamat }}
                            </td>

                            <td>{{ $g->telepon }}</td>

                            <td>
                                @if($g->status == 'aktif')
                                    <span class="badge badge-status-active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge badge-status-inactive">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    <a href="{{ route('admin.guru.edit', $g->id) }}"
                                       class="btn btn-sm btn-soft btn-action">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.guru.destroy', $g->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-soft btn-action text-danger"
                                            onclick="return confirm('Yakin hapus data?')">
                                            Hapus
                                        </button>
                                    </form>

                                    @if($g->status == 'aktif')
                                        <a href="{{ route('admin.guru.nonaktif', $g->id) }}"
                                           class="btn btn-sm btn-outline-warning btn-action">
                                           Nonaktifkan
                                        </a>
                                    @else
                                        <a href="{{ route('admin.guru.aktifkan', $g->id) }}"
                                           class="btn btn-sm btn-outline-success btn-action">
                                           Aktifkan
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr class="empty-row">
                            <td colspan="9" class="text-center">
                                Belum ada data guru
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
@endsection