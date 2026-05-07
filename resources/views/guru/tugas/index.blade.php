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

/* RATA-RATA SECTION */
.btn-hitung-rata {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: var(--radius-md); border: none;
    background: var(--success); color: #fff;
    font-size: 13.5px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .18s;
    box-shadow: 0 2px 8px rgba(22,163,74,.25);
    margin-top: 24px;
}
.btn-hitung-rata:hover { background: #15803d; transform: translateY(-1px); }
.btn-hitung-rata svg { width: 15px; height: 15px; }

.rata-section { margin-top: 20px; animation: fadeUp 0.3s ease both; }

.rata-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-xl); box-shadow: var(--shadow-md); overflow: hidden;
}
.rata-card-toolbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px; border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
}
.rata-toolbar-left { display: flex; align-items: center; gap: 10px; }
.rata-toolbar-icon {
    width: 34px; height: 34px; border-radius: 9px;
    background: var(--success); color: #fff;
    display: flex; align-items: center; justify-content: center;
}
.rata-toolbar-icon svg { width: 16px; height: 16px; }
.rata-toolbar-title { font-size: 13.5px; font-weight: 700; color: #166534; margin: 0; }
.rata-toolbar-sub { font-size: 11.5px; color: #15803d; margin: 2px 0 0; }

table.rata-table { width: 100%; border-collapse: collapse; min-width: 600px; }
.rata-table thead tr {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-bottom: 2px solid #bbf7d0;
}
.rata-table thead th {
    padding: 12px 16px; font-size: 11px; font-weight: 700;
    color: #166534; text-transform: uppercase; letter-spacing: .7px;
    white-space: nowrap;
}
.rata-table thead th.center { text-align: center; }
.rata-table tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
.rata-table tbody tr:last-child { border-bottom: none; }
.rata-table tbody tr:hover { background: #f0fdf4; }
.rata-table tbody td { padding: 14px 16px; font-size: 13.5px; color: var(--text-primary); vertical-align: middle; }
.rata-table tbody td.center { text-align: center; }

.rata-avatar-row { display: flex; align-items: center; gap: 10px; }
.rata-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--success-light); border: 2px solid #bbf7d0;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: var(--success); flex-shrink: 0;
}
.rata-nama { font-weight: 700; color: var(--text-primary); font-size: 13.5px; }

.chip-nilai {
    display: inline-flex; padding: 5px 16px;
    border-radius: 999px; font-size: 14px; font-weight: 800;
}
.chip-nilai.a { background: #dcfce7; color: #166534; }
.chip-nilai.b { background: var(--primary-light); color: var(--primary); }
.chip-nilai.c { background: var(--warning-light); color: var(--warning); }
.chip-nilai.d { background: var(--danger-light); color: var(--danger); }

.chip-predikat {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 999px; font-size: 11.5px; font-weight: 700;
}
.chip-predikat.a { background: #dcfce7; color: #166534; }
.chip-predikat.b { background: var(--primary-light); color: var(--primary); }
.chip-predikat.c { background: var(--warning-light); color: var(--warning); }
.chip-predikat.d { background: var(--danger-light); color: var(--danger); }

.rata-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 22px; border-top: 1px solid var(--border);
    background: var(--surface-secondary); font-size: 13px; color: var(--text-muted);
}
.rata-footer-nilai { font-size: 16px; font-weight: 800; color: var(--text-primary); }
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

    {{-- TOMBOL HITUNG --}}
<div style="text-align:right">
    <button class="btn-hitung-rata" onclick="tampilRataRata()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        Hitung Rata-Rata Nilai Siswa
    </button>
</div>

{{-- TABEL RATA-RATA --}}
<div id="rata-section" class="rata-section" style="display:none">
    <div class="rata-card">
        <div class="rata-card-toolbar">
            <div class="rata-toolbar-left">
                <div class="rata-toolbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="rata-toolbar-title">Rekap Rata-Rata Nilai per Siswa</p>
                    <p class="rata-toolbar-sub">Dihitung dari semua tugas yang sudah dinilai guru</p>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="rata-table">
                <thead>
                    <tr>
                        <th style="width:36px">#</th>
                        <th>Nama Siswa</th>
                        <th class="center">Jumlah Tugas Dinilai</th>
                        <th class="center">Rata-Rata Nilai</th>
                        <th class="center">Predikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapNilai as $i => $r)
                    <tr>
                        <td style="color:var(--text-muted);font-size:12px">{{ $i + 1 }}</td>
                        <td>
                            <div class="rata-avatar-row">
                                <div class="rata-avatar">{{ $r['inisial'] }}</div>
                                <span class="rata-nama">{{ $r['nama'] }}</span>
                            </div>
                        </td>
                        <td class="center" style="color:var(--text-secondary)">
                            {{ $r['jumlah_tugas'] }} tugas
                        </td>
                        <td class="center">
                            @php
                                $n = $r['rata_rata'];
                                $cls = $n >= 88 ? 'a' : ($n >= 75 ? 'b' : ($n >= 60 ? 'c' : 'd'));
                            @endphp
                            <span class="chip-nilai {{ $cls }}">{{ $n }}</span>
                        </td>
                        <td class="center">
                            @php
                                $predikat = $n >= 88 ? 'A — Sangat Baik'
                                    : ($n >= 75 ? 'B — Baik'
                                    : ($n >= 60 ? 'C — Cukup' : 'D — Kurang'));
                            @endphp
                            <span class="chip-predikat {{ $cls }}">{{ $predikat }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);font-size:13px">
                            Belum ada siswa yang mendapatkan nilai
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($rekapNilai->count())
        <div class="rata-footer">
            <span>{{ $rekapNilai->count() }} siswa terhitung</span>
            <div style="display:flex;align-items:center;gap:8px">
                <span>Rata-rata kelas:</span>
                <span class="rata-footer-nilai">
                    {{ round($rekapNilai->avg('rata_rata'), 1) }} / 100
                </span>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function tampilRataRata() {
    const sec = document.getElementById('rata-section');
    sec.style.display = 'block';
    sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>

</div>
@endsection