@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --warning:#d97706; --warning-light:#fffbeb; --warning-border:#fde68a;
    --danger:#dc2626; --danger-light:#fef2f2; --danger-border:#fecaca;
    --info:#0284c7; --info-light:#f0f9ff; --info-border:#bae6fd;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --radius-sm:6px; --radius-md:10px; --radius-lg:14px; --radius-xl:18px;
}
* { font-family:'Plus Jakarta Sans',sans-serif; box-sizing:border-box; }
.page-wrapper { animation:fadeUp 0.4s ease both; }
@keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }

/* HEADER */
.page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; gap:16px; flex-wrap:wrap; }
.page-header-left { display:flex; align-items:center; gap:14px; }
.page-icon { width:50px; height:50px; border-radius:var(--radius-lg); background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.page-icon svg { width:24px; height:24px; color:var(--primary); }
.page-title { font-size:22px; font-weight:700; color:var(--text-primary); margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle { font-size:13px; color:var(--text-secondary); margin:0; }

.btn-add { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--primary); color:#fff; border:none; border-radius:var(--radius-md); text-decoration:none; cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(37,99,235,0.25); }
.btn-add:hover { background:var(--primary-dark); color:#fff; text-decoration:none; transform:translateY(-1px); }
.btn-add svg { width:15px; height:15px; }

/* CARD */
.section-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; }
.card-toolbar { display:flex; align-items:center; justify-content:space-between; padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); }
.toolbar-title { font-size:13.5px; font-weight:600; color:var(--text-primary); }
.toolbar-badge { background:var(--primary-light); color:var(--primary); border:1px solid var(--primary-border); border-radius:999px; font-size:11.5px; font-weight:600; padding:2px 10px; margin-left:8px; }

/* TABLE */
.table-responsive { overflow-x:auto; }
table.tugas-table { width:100%; border-collapse:collapse; min-width:780px; }
.tugas-table thead tr { background:var(--surface-secondary); border-bottom:1px solid var(--border); }
.tugas-table thead th { padding:12px 16px; font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.7px; text-align:left; white-space:nowrap; }
.tugas-table thead th.center { text-align:center; }
.tugas-table tbody tr { border-bottom:1px solid var(--border); transition:background 0.15s; }
.tugas-table tbody tr:last-child { border-bottom:none; }
.tugas-table tbody tr:hover { background:#f8faff; }
.tugas-table tbody td { padding:15px 16px; font-size:13.5px; color:var(--text-primary); vertical-align:middle; }
.tugas-table tbody td.center { text-align:center; }

.judul-cell { font-weight:600; color:var(--text-primary); }

.badge-kelas { background:var(--primary-light); color:var(--primary); border:1px solid var(--primary-border); border-radius:999px; font-size:11.5px; font-weight:600; padding:3px 11px; display:inline-flex; }
.badge-mapel { background:var(--surface-secondary); color:var(--text-secondary); border:1px solid var(--border); border-radius:999px; font-size:11.5px; font-weight:600; padding:3px 11px; display:inline-flex; }

.badge-kumpul { background:var(--primary-light); color:var(--primary); border:1px solid var(--primary-border); border-radius:var(--radius-sm); font-size:12px; font-weight:700; padding:3px 10px; display:inline-flex; align-items:center; }
.badge-aktif { background:var(--success-light); color:var(--success); border:1px solid var(--success-border); border-radius:999px; font-size:12px; font-weight:600; padding:4px 10px; display:inline-flex; align-items:center; gap:4px; }
.badge-aktif::before { content:''; width:6px; height:6px; border-radius:50%; background:var(--success); }
.badge-lewat { background:var(--danger-light); color:var(--danger); border:1px solid var(--danger-border); border-radius:999px; font-size:12px; font-weight:600; padding:4px 10px; display:inline-flex; align-items:center; gap:4px; }
.badge-lewat::before { content:''; width:6px; height:6px; border-radius:50%; background:var(--danger); }

.deadline-text { font-size:12.5px; color:var(--text-secondary); white-space:nowrap; }

/* ACTION GROUP */
.action-group { display:flex; align-items:center; justify-content:center; gap:5px; flex-wrap:wrap; }
.btn-act { display:inline-flex; align-items:center; gap:4px; padding:5px 11px; font-size:12px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; border-radius:var(--radius-sm); text-decoration:none; border:1px solid transparent; cursor:pointer; transition:all 0.15s; white-space:nowrap; }
.btn-act svg { width:12px; height:12px; }
.btn-pengumpulan { background:var(--primary-light); color:var(--primary); border-color:var(--primary-border); }
.btn-pengumpulan:hover { background:#dbeafe; color:var(--primary); text-decoration:none; }
.btn-detail { background:var(--info-light); color:var(--info); border-color:var(--info-border); }
.btn-detail:hover { background:#e0f2fe; color:var(--info); text-decoration:none; }
.btn-edit-act { background:var(--warning-light); color:var(--warning); border-color:var(--warning-border); }
.btn-edit-act:hover { background:#fef3c7; color:var(--warning); text-decoration:none; }

/* EMPTY */
.empty-state { padding:64px 24px; text-align:center; }
.empty-icon { width:60px; height:60px; background:var(--surface-secondary); border-radius:50%; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; margin:0 auto 14px; }
.empty-icon svg { width:26px; height:26px; color:var(--text-muted); }
.empty-title { font-size:15px; font-weight:600; color:var(--text-primary); margin-bottom:4px; }
.empty-desc { font-size:13px; color:var(--text-muted); margin-bottom:20px; }
.btn-empty { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--primary); color:#fff; border:none; border-radius:var(--radius-md); text-decoration:none; }
.btn-empty:hover { background:var(--primary-dark); color:#fff; text-decoration:none; }

.table-footer { display:flex; align-items:center; justify-content:space-between; padding:13px 22px; border-top:1px solid var(--border); background:var(--surface-secondary); font-size:12.5px; color:var(--text-muted); }

/* ===== FILTER RATA-RATA ===== */
.filter-section { margin-top:24px; }
.filter-card {
    background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden;
}
.filter-card-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:16px 22px; border-bottom:1px solid var(--border);
    background:var(--surface-secondary); flex-wrap:wrap; gap:12px;
}
.filter-header-left { display:flex; align-items:center; gap:12px; }
.filter-header-icon {
    width:38px; height:38px; border-radius:var(--radius-md);
    background:var(--primary-light); border:1px solid var(--primary-border);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.filter-header-icon svg { width:18px; height:18px; color:var(--primary); }
.filter-header-title { font-size:14px; font-weight:700; color:var(--text-primary); margin:0; }
.filter-header-sub { font-size:12px; color:var(--text-secondary); margin:2px 0 0; }

.btn-hitung-rata2 {
    display:inline-flex; align-items:center; gap:7px;
    padding:10px 20px; border-radius:var(--radius-md); border:none;
    background:var(--success); color:#fff;
    font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif;
    cursor:pointer; transition:all .18s; box-shadow:0 2px 8px rgba(22,163,74,.22);
}
.btn-hitung-rata2:hover { background:#15803d; transform:translateY(-1px); }
.btn-hitung-rata2 svg { width:15px; height:15px; }

.filter-body { padding:18px 22px; }
.filter-select-all-row {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:14px; flex-wrap:wrap; gap:8px;
}
.filter-select-all-row span { font-size:13px; color:var(--text-secondary); font-weight:500; }
.filter-quick-links { display:flex; gap:14px; }
.filter-quick-link {
    font-size:12.5px; color:var(--primary); cursor:pointer;
    background:none; border:none; font-family:'Plus Jakarta Sans',sans-serif;
    padding:0; font-weight:600;
}
.filter-quick-link:hover { text-decoration:underline; }

.kelas-group { margin-bottom:12px; border:1px solid var(--border); border-radius:var(--radius-lg); overflow:hidden; }
.kelas-group:last-child { margin-bottom:0; }
.kelas-group-header {
    display:flex; align-items:center; gap:10px; padding:10px 16px;
    background:var(--surface-secondary); border-bottom:1px solid var(--border);
    cursor:pointer; user-select:none;
}
.kelas-group-header:hover { background:#f1f5f9; }
.kelas-group-header input[type=checkbox] {
    width:16px; height:16px; accent-color:var(--primary); cursor:pointer; flex-shrink:0;
}
.kelas-label-name { font-size:13.5px; font-weight:700; color:var(--text-primary); flex:1; }
.kelas-count-badge {
    background:var(--primary-light); color:var(--primary);
    border:1px solid var(--primary-border); border-radius:999px;
    font-size:11.5px; font-weight:600; padding:2px 9px;
}
.kelas-avg-preview {
    font-size:12px; color:var(--text-muted); font-weight:500;
}
.kelas-toggle-btn {
    width:24px; height:24px; border:none; background:none;
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    color:var(--text-muted); font-size:12px; border-radius:4px;
    transition:background 0.15s; flex-shrink:0;
}
.kelas-toggle-btn:hover { background:var(--border); }

.siswa-list-wrapper { padding:0; }
.siswa-item {
    display:flex; align-items:center; gap:10px;
    padding:10px 16px; border-bottom:1px solid var(--border); cursor:pointer;
    transition:background 0.12s; user-select:none;
}
.siswa-item:last-child { border-bottom:none; }
.siswa-item:hover { background:#f8faff; }
.siswa-item input[type=checkbox] {
    width:15px; height:15px; accent-color:var(--primary); cursor:pointer; flex-shrink:0;
}
.siswa-avatar {
    width:32px; height:32px; border-radius:50%;
    background:var(--primary-light); border:1.5px solid var(--primary-border);
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:800; color:var(--primary); flex-shrink:0;
}
.siswa-nama-text { font-size:13px; font-weight:600; color:var(--text-primary); flex:1; }
.siswa-tugas-text { font-size:12px; color:var(--text-muted); margin-right:4px; }
.chip-nilai-sm {
    display:inline-flex; padding:3px 10px; border-radius:999px;
    font-size:11.5px; font-weight:700;
}
.chip-a { background:#dcfce7; color:#166534; }
.chip-b { background:var(--primary-light); color:var(--primary); }
.chip-c { background:var(--warning-light); color:var(--warning); }
.chip-d { background:var(--danger-light); color:var(--danger); }

/* ===== RESULT TABLE ===== */
.rata-result-section { margin-top:20px; animation:fadeUp 0.3s ease both; }
.rata-result-card {
    background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden;
}
.rata-result-header {
    padding:16px 22px; border-bottom:1px solid var(--border);
    background:linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    display:flex; align-items:center; gap:10px;
}
.rata-result-icon {
    width:34px; height:34px; border-radius:9px;
    background:var(--success); color:#fff;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.rata-result-icon svg { width:16px; height:16px; }
.rata-result-title { font-size:13.5px; font-weight:700; color:#166534; margin:0; }
.rata-result-sub { font-size:11.5px; color:#15803d; margin:2px 0 0; }

.kelas-result-block { border-bottom:1px solid var(--border); }
.kelas-result-block:last-of-type { border-bottom:none; }
.kelas-result-header {
    padding:10px 20px; background:var(--surface-secondary);
    display:flex; align-items:center; justify-content:space-between;
    border-bottom:1px solid var(--border);
}
.kelas-result-name {
    font-size:11px; font-weight:700; color:var(--text-muted);
    text-transform:uppercase; letter-spacing:0.6px;
}
.kelas-result-avg {
    display:inline-flex; align-items:center; gap:7px;
    font-size:12.5px; font-weight:700;
}

table.rata-result-table { width:100%; border-collapse:collapse; min-width:560px; }
.rata-result-table thead tr { background:linear-gradient(135deg, #f0fdf4, #dcfce7); border-bottom:2px solid #bbf7d0; }
.rata-result-table thead th {
    padding:11px 16px; font-size:11px; font-weight:700;
    color:#166534; text-transform:uppercase; letter-spacing:.6px; white-space:nowrap;
}
.rata-result-table thead th.c { text-align:center; }
.rata-result-table tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
.rata-result-table tbody tr:last-child { border-bottom:none; }
.rata-result-table tbody tr:hover { background:#f0fdf4; }
.rata-result-table tbody td { padding:13px 16px; font-size:13.5px; color:var(--text-primary); vertical-align:middle; }
.rata-result-table tbody td.c { text-align:center; }

.rata-avatar-row { display:flex; align-items:center; gap:10px; }
.rata-avatar {
    width:34px; height:34px; border-radius:50%;
    background:var(--success-light); border:1.5px solid var(--success-border);
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:800; color:var(--success); flex-shrink:0;
}
.chip-nilai-lg {
    display:inline-flex; padding:5px 16px; border-radius:999px;
    font-size:14px; font-weight:800;
}
.chip-predikat {
    display:inline-flex; padding:4px 11px; border-radius:999px;
    font-size:11.5px; font-weight:700;
}

.rata-result-footer {
    display:flex; align-items:center; justify-content:space-between;
    padding:13px 22px; border-top:1px solid var(--border);
    background:var(--surface-secondary); font-size:13px; color:var(--text-muted);
}
.rata-result-footer-val { font-size:16px; font-weight:800; color:var(--text-primary); }
.rata-empty { padding:40px 24px; text-align:center; font-size:13px; color:var(--text-muted); }

/* ===== TOMBOL MASUKKAN KE MENU NILAI (baru) ===== */
.btn-masuk-nilai {
    display:inline-flex; align-items:center; gap:5px;
    padding:5px 12px; font-size:11.5px; font-weight:700;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--primary-light); color:var(--primary);
    border:1px solid var(--primary-border);
    border-radius:6px; cursor:pointer; transition:all .15s;
    white-space:nowrap;
}
.btn-masuk-nilai:hover { background:#dbeafe; transform:translateY(-1px); }
</style>

<div class="container-fluid px-4 py-2 page-wrapper">

    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h4 class="page-title">Manajemen Tugas</h4>
                <p class="page-subtitle">Kelola dan pantau tugas yang diberikan kepada siswa</p>
            </div>
        </div>
        <a href="{{ route('guru.tugas.create') }}" class="btn-add">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Tugas
        </a>
    </div>

    {{-- TABEL DAFTAR TUGAS --}}
    <div class="section-card">
        <div class="card-toolbar">
            <span class="toolbar-title">Daftar Tugas<span class="toolbar-badge">{{ $tugas->count() }} tugas</span></span>
        </div>
        <div class="table-responsive">
            <table class="tugas-table">
                <thead>
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th class="center">Pengumpulan</th>
                        <th class="center">Status</th>
                        <th class="center">File</th>
                        <th>Deadline</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tugas as $t)
                    <tr>
                        <td><span class="judul-cell">{{ $t->judul }}</span></td>
                        <td><span class="badge-kelas">{{ $t->kelas->nama_kelas ?? '—' }}</span></td>
                        <td><span class="badge-mapel">{{ $t->mapel->nama_mapel ?? '—' }}</span></td>
                        <td class="center">
                            <span class="badge-kumpul">{{ $t->pengumpulan_count }} / {{ $t->total_siswa }}</span>
                        </td>
                        <td class="center">
                            @if(now()->gt($t->deadline))
                                <span class="badge-lewat">Lewat</span>
                            @else
                                <span class="badge-aktif">Aktif</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($t->file)
                                <a href="{{ route('guru.tugas.download', $t->id) }}" class="btn-act btn-detail">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Unduh
                                </a>
                            @else
                                <span style="font-size:12px;color:var(--text-muted);">—</span>
                            @endif
                        </td>
                        <td><span class="deadline-text">{{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}</span></td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('guru.tugas.pengumpulan', $t->id) }}" class="btn-act btn-pengumpulan">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Kumpulan
                                </a>
                                <a href="{{ route('guru.tugas.show', $t->id) }}" class="btn-act btn-detail">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Detail
                                </a>
                                <a href="{{ route('guru.tugas.edit', $t->id) }}" class="btn-act btn-edit-act">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/></svg>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <div class="empty-title">Belum ada tugas</div>
                                <div class="empty-desc">Buat tugas pertama untuk mulai memantau pengumpulan siswa.</div>
                                <a href="{{ route('guru.tugas.create') }}" class="btn-empty">Buat Tugas Pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tugas->count())
        <div class="table-footer">
            <span>{{ $tugas->count() }} tugas ditemukan</span>
            <span>{{ now()->format('d M Y') }}</span>
        </div>
        @endif
    </div>

    {{-- ===== FILTER RATA-RATA PER KELAS & SISWA ===== --}}
    <div class="filter-section">
        <div class="filter-card">
            <div class="filter-card-header">
                <div class="filter-header-left">
                    <div class="filter-header-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="filter-header-title">Filter Perhitungan Rata-Rata Nilai</p>
                        <p class="filter-header-sub">Pilih kelas dan siswa yang ingin dihitung rata-rata nilainya</p>
                    </div>
                </div>
                <button class="btn-hitung-rata2" onclick="hitungRataRata()">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Hitung Rata-Rata
                </button>
            </div>
            <div class="filter-body">
                <div class="filter-select-all-row">
                    <span>Centang siswa yang ingin dihitung:</span>
                    <div class="filter-quick-links">
                        <button class="filter-quick-link" onclick="selectAllSiswa(true)">Pilih Semua</button>
                        <button class="filter-quick-link" onclick="selectAllSiswa(false)">Hapus Semua</button>
                    </div>
                </div>
                <div id="filter-kelas-list">
                    {{-- Dibangun oleh JS dari data PHP --}}
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL HASIL RATA-RATA --}}
    <div id="rata-result-section" class="rata-result-section" style="display:none"></div>

</div>

{{-- DATA REKAP DARI PHP → JS --}}
<script>
const REKAP_DATA  = @json($rekapPerKelas);
const CSRF_TOKEN  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function getChipClass(n) {
    if (n >= 88) return 'a';
    if (n >= 75) return 'b';
    if (n >= 60) return 'c';
    return 'd';
}
function getPredikat(n) {
    if (n >= 88) return 'A — Sangat Baik';
    if (n >= 75) return 'B — Baik';
    if (n >= 60) return 'C — Cukup';
    return 'D — Kurang';
}

function buildFilter() {
    const container = document.getElementById('filter-kelas-list');
    if (!container) return;

    const entries = Object.entries(REKAP_DATA);
    if (entries.length === 0) {
        container.innerHTML = '<p style="text-align:center;padding:24px;font-size:13px;color:var(--text-muted)">Belum ada siswa yang mendapatkan nilai.</p>';
        return;
    }

    entries.forEach(([kelas, siswaList]) => {
        if (!siswaList || siswaList.length === 0) return;

        const avgKelas = siswaList.length
            ? Math.round(siswaList.reduce((s, x) => s + parseFloat(x.rata_rata), 0) / siswaList.length)
            : 0;

        const grp = document.createElement('div');
        grp.className = 'kelas-group';
        grp.dataset.kelas = kelas;

        const header = document.createElement('div');
        header.className = 'kelas-group-header';

        const cbKelas = document.createElement('input');
        cbKelas.type = 'checkbox';
        cbKelas.checked = true;
        cbKelas.className = 'cb-kelas';
        cbKelas.dataset.kelas = kelas;
        cbKelas.addEventListener('change', (e) => {
            grp.querySelectorAll('.cb-siswa').forEach(cb => { cb.checked = e.target.checked; });
        });

        const labelName = document.createElement('span');
        labelName.className = 'kelas-label-name';
        labelName.textContent = kelas;

        const badge = document.createElement('span');
        badge.className = 'kelas-count-badge';
        badge.textContent = siswaList.length + ' siswa';

        const avgPreview = document.createElement('span');
        avgPreview.className = 'kelas-avg-preview';
        avgPreview.textContent = 'Rata kelas: ' + avgKelas;

        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'kelas-toggle-btn';
        toggleBtn.innerHTML = '▲';
        toggleBtn.title = 'Tampilkan/sembunyikan';

        header.append(cbKelas, labelName, badge, avgPreview, toggleBtn);

        const listWrap = document.createElement('div');
        listWrap.className = 'siswa-list-wrapper';

        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const hidden = listWrap.style.display === 'none';
            listWrap.style.display = hidden ? 'block' : 'none';
            toggleBtn.innerHTML = hidden ? '▲' : '▼';
        });

        header.addEventListener('click', (e) => {
            if (e.target === cbKelas || e.target === toggleBtn) return;
            toggleBtn.click();
        });

        siswaList.forEach(s => {
            const cls = getChipClass(parseFloat(s.rata_rata));
            const item = document.createElement('label');
            item.className = 'siswa-item';
            item.style.cursor = 'pointer';

            const cbSiswa = document.createElement('input');
            cbSiswa.type = 'checkbox';
            cbSiswa.checked = true;
            cbSiswa.className = 'cb-siswa';
            cbSiswa.dataset.siswaId = s.id;
            cbSiswa.dataset.kelas = kelas;
            cbSiswa.addEventListener('change', () => {
                const all = [...grp.querySelectorAll('.cb-siswa')];
                const cbK = grp.querySelector('.cb-kelas');
                const allChecked = all.every(cb => cb.checked);
                const someChecked = all.some(cb => cb.checked);
                cbK.checked = allChecked;
                cbK.indeterminate = !allChecked && someChecked;
            });

            const avatar = document.createElement('div');
            avatar.className = 'siswa-avatar';
            avatar.textContent = s.inisial;

            const nama = document.createElement('span');
            nama.className = 'siswa-nama-text';
            nama.textContent = s.nama;

            const tugasInfo = document.createElement('span');
            tugasInfo.className = 'siswa-tugas-text';
            tugasInfo.textContent = s.jumlah_tugas + ' tugas';

            const chip = document.createElement('span');
            chip.className = 'chip-nilai-sm chip-' + cls;
            chip.textContent = parseFloat(s.rata_rata).toFixed(1);

            // ── TOMBOL MASUKKAN KE MENU NILAI (baru) ──────────────
            const formMasuk = document.createElement('form');
            formMasuk.action  = '/guru/nilai/masukkan-tugas';
            formMasuk.method  = 'POST';
            formMasuk.style.cssText = 'display:inline-flex;flex-shrink:0;';
            formMasuk.innerHTML = `
                <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                <input type="hidden" name="siswa_id" value="${s.id}">
                <input type="hidden" name="nilai_tugas" value="${parseFloat(s.rata_rata).toFixed(2)}">
                <button type="submit" class="btn-masuk-nilai"
                    onclick="event.stopPropagation(); return confirm('Masukkan nilai tugas ${s.nama.replace(/'/g,"\\'")} (${parseFloat(s.rata_rata).toFixed(1)}) ke Menu Nilai?')">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="width:11px;height:11px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10"/>
                    </svg>
                    → Menu Nilai
                </button>
            `;

            item.append(cbSiswa, avatar, nama, tugasInfo, chip, formMasuk);
            listWrap.appendChild(item);
        });

        grp.appendChild(header);
        grp.appendChild(listWrap);
        container.appendChild(grp);
    });
}

function selectAllSiswa(val) {
    document.querySelectorAll('.cb-siswa, .cb-kelas').forEach(cb => {
        cb.checked = val;
        cb.indeterminate = false;
    });
}

function hitungRataRata() {
    const selected = {};
    document.querySelectorAll('.cb-siswa:checked').forEach(cb => {
        const kelas = cb.dataset.kelas;
        const id    = parseInt(cb.dataset.siswaId);
        if (!selected[kelas]) selected[kelas] = [];
        selected[kelas].push(id);
    });

    const sec = document.getElementById('rata-result-section');

    if (Object.keys(selected).length === 0) {
        sec.innerHTML = '<div class="rata-result-card"><div class="rata-empty">Pilih minimal satu siswa terlebih dahulu.</div></div>';
        sec.style.display = 'block';
        sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
        return;
    }

    let html = '<div class="rata-result-card">';
    html += `<div class="rata-result-header">
        <div class="rata-result-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <div>
            <p class="rata-result-title">Rekap Rata-Rata Nilai per Siswa</p>
            <p class="rata-result-sub">Dihitung dari semua tugas yang sudah dinilai, dikelompokkan per kelas</p>
        </div>
    </div>`;

    const allAvgs  = [];
    let totalSiswa = 0;
    let totalKelas = 0;

    Object.entries(REKAP_DATA).forEach(([kelas, siswaList]) => {
        const selectedIds = selected[kelas] || [];
        const filtered    = siswaList
            .filter(s => selectedIds.includes(parseInt(s.id)))
            .sort((a, b) => parseFloat(b.rata_rata) - parseFloat(a.rata_rata));

        if (filtered.length === 0) return;

        totalKelas++;
        totalSiswa += filtered.length;

        const kelasAvgArr = filtered.map(s => parseFloat(s.rata_rata));
        const kelasAvg    = Math.round(kelasAvgArr.reduce((a, b) => a + b, 0) / kelasAvgArr.length);
        allAvgs.push(...kelasAvgArr);

        const cls = getChipClass(kelasAvg);

        html += `<div class="kelas-result-block">
            <div class="kelas-result-header">
                <span class="kelas-result-name">${kelas} &nbsp;·&nbsp; ${filtered.length} siswa</span>
                <span class="kelas-result-avg">
                    Rata-rata kelas:&nbsp;
                    <span class="chip-nilai-sm chip-${cls}" style="font-size:13px">${kelasAvg}</span>
                </span>
            </div>
            <div class="table-responsive">
            <table class="rata-result-table">
                <thead>
                    <tr>
                        <th style="width:32px">#</th>
                        <th>Nama Siswa</th>
                        <th class="c">Tugas Dinilai</th>
                        <th class="c">Rata-Rata Nilai</th>
                        <th class="c">Predikat</th>
                        <th class="c">Aksi</th>
                    </tr>
                </thead>
                <tbody>`;

        filtered.forEach((s, i) => {
            const rataS = Math.round(parseFloat(s.rata_rata) * 10) / 10;
            const clsS  = getChipClass(rataS);
            html += `<tr>
                <td style="font-size:12px;color:var(--text-muted)">${i + 1}</td>
                <td>
                    <div class="rata-avatar-row">
                        <div class="rata-avatar">${s.inisial}</div>
                        <span style="font-weight:600">${s.nama}</span>
                    </div>  
                </td>
                <td class="c" style="color:var(--text-secondary)">${s.jumlah_tugas} tugas</td>
                <td class="c"><span class="chip-nilai-lg chip-${clsS}">${rataS}</span></td>
                <td class="c"><span class="chip-predikat chip-${clsS}">${getPredikat(rataS)}</span></td>
                <td class="c">
                    <form action="/guru/nilai/masukkan-tugas" method="POST" style="display:inline;">
                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                        <input type="hidden" name="siswa_id" value="${s.id}">
                        <input type="hidden" name="nilai_tugas" value="${rataS}">
                        <button type="submit" class="btn-masuk-nilai"
                            onclick="return confirm('Masukkan nilai tugas ${s.nama.replace(/'/g,"\\'")} (${rataS}) ke Menu Nilai?')">
                            → Menu Nilai
                        </button>
                    </form>
                </td>
            </tr>`;
        });

        html += `</tbody></table></div></div>`;
    });

    const totalAvg = allAvgs.length
        ? (Math.round(allAvgs.reduce((a, b) => a + b, 0) / allAvgs.length * 10) / 10)
        : 0;

    html += `<div class="rata-result-footer">
        <span>${totalSiswa} siswa dari ${totalKelas} kelas</span>
        <div style="display:flex;align-items:center;gap:10px">
            <span>Rata-rata keseluruhan:</span>
            <span class="rata-result-footer-val">${totalAvg} / 100</span>
        </div>
    </div>`;

    html += '</div>';

    sec.innerHTML  = html;
    sec.style.display = 'block';
    sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

document.addEventListener('DOMContentLoaded', buildFilter);
</script>

@endsection