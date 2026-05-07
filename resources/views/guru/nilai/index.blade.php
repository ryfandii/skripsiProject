@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --warning:#d97706; --warning-light:#fffbeb; --warning-border:#fde68a;
    --danger:#dc2626; --danger-light:#fef2f2; --danger-border:#fecaca;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus:0 0 0 3px rgba(37,99,235,0.12);
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

/* BUTTON ADD */
.btn-add {
    display:inline-flex; align-items:center; gap:7px; padding:10px 20px;
    font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--primary); color:#fff; border:none; border-radius:var(--radius-md);
    text-decoration:none; cursor:pointer; transition:all 0.15s;
    box-shadow:0 2px 8px rgba(37,99,235,0.25);
}
.btn-add:hover { background:var(--primary-dark); color:#fff; text-decoration:none; transform:translateY(-1px); }
.btn-add svg { width:15px; height:15px; }

/* FILTER BAR */
.filter-bar { display:flex; align-items:center; gap:12px; margin-bottom:0; }
.filter-select {
    padding:8px 34px 8px 12px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif;
    border:1px solid var(--border); border-radius:var(--radius-md);
    background:var(--surface); color:var(--text-primary); outline:none;
    appearance:none; cursor:pointer; width:200px;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 10px center; background-size:14px;
    transition:border-color 0.2s, box-shadow 0.2s;
}
.filter-select:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.filter-label { font-size:13px; font-weight:500; color:var(--text-secondary); }

/* CARD */
.section-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; }
.card-toolbar { display:flex; align-items:center; justify-content:space-between; padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); flex-wrap:wrap; gap:12px; }
.toolbar-title { font-size:13.5px; font-weight:600; color:var(--text-primary); }
.toolbar-badge { background:var(--primary-light); color:var(--primary); border:1px solid var(--primary-border); border-radius:999px; font-size:11.5px; font-weight:600; padding:2px 10px; margin-left:8px; }

/* TABLE */
.table-responsive { overflow-x:auto; }
table.nilai-table { width:100%; border-collapse:collapse; min-width:600px; }
.nilai-table thead tr { background:var(--surface-secondary); border-bottom:1px solid var(--border); }
.nilai-table thead th { padding:12px 16px; font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.7px; text-align:left; white-space:nowrap; }
.nilai-table tbody tr { border-bottom:1px solid var(--border); transition:background 0.15s; }
.nilai-table tbody tr:last-child { border-bottom:none; }
.nilai-table tbody tr:hover { background:#f8faff; }
.nilai-table tbody td { padding:14px 16px; font-size:13.5px; color:var(--text-primary); vertical-align:middle; }
.cell-no { font-size:13px; color:var(--text-muted); font-weight:500; }

/* NAME CELL */
.name-cell { display:flex; align-items:center; gap:10px; }
.name-avatar { width:34px; height:34px; border-radius:50%; background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:var(--primary); flex-shrink:0; }

/* NILAI BADGE */
.nilai-chip {
    display:inline-flex; align-items:center; justify-content:center;
    width:46px; height:28px; border-radius:var(--radius-sm);
    font-size:13px; font-weight:700;
}
.nilai-chip.tinggi { background:var(--success-light); color:var(--success); border:1px solid var(--success-border); }
.nilai-chip.sedang { background:var(--warning-light); color:var(--warning); border:1px solid var(--warning-border); }
.nilai-chip.rendah { background:var(--danger-light); color:var(--danger); border:1px solid var(--danger-border); }

.badge-kelas { background:var(--primary-light); color:var(--primary); border:1px solid var(--primary-border); border-radius:999px; font-size:11.5px; font-weight:600; padding:3px 11px; display:inline-flex; }
.badge-mapel { background:var(--surface-secondary); color:var(--text-secondary); border:1px solid var(--border); border-radius:999px; font-size:11.5px; font-weight:600; padding:3px 11px; display:inline-flex; }

.btn-edit-sm {
    display:inline-flex; align-items:center; gap:5px; padding:5px 12px;
    font-size:12.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--warning-light); color:var(--warning);
    border:1px solid var(--warning-border); border-radius:var(--radius-sm);
    text-decoration:none; transition:all 0.15s;
}
.btn-edit-sm:hover { background:#fef3c7; color:var(--warning); text-decoration:none; }
.btn-edit-sm svg { width:13px; height:13px; }

/* EMPTY */
.empty-state { padding:64px 24px; text-align:center; }
.empty-icon { width:60px; height:60px; background:var(--surface-secondary); border-radius:50%; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; margin:0 auto 14px; }
.empty-icon svg { width:26px; height:26px; color:var(--text-muted); }
.empty-title { font-size:15px; font-weight:600; color:var(--text-primary); margin-bottom:4px; }
.empty-desc { font-size:13px; color:var(--text-muted); }

/* TABLE FOOTER */
.table-footer { display:flex; align-items:center; justify-content:space-between; padding:13px 22px; border-top:1px solid var(--border); background:var(--surface-secondary); font-size:12.5px; color:var(--text-muted); flex-wrap:wrap; gap:6px; }
</style>

<div class="container-fluid px-4 py-2 page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h4 class="page-title">Data Nilai Siswa</h4>
                <p class="page-subtitle">Kelola dan pantau nilai akademik siswa</p>
            </div>
        </div>
        <a href="{{ route('guru.nilai.input') }}" class="btn-add">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Input Nilai
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="section-card">
        <div class="card-toolbar">
            <span class="toolbar-title">Daftar Nilai<span class="toolbar-badge">{{ $nilai->count() }} data</span></span>
            <form method="GET" action="{{ route('guru.nilai.index') }}" style="margin:0;">
                <div class="filter-bar">
                    <span class="filter-label">Filter:</span>
                    <select name="kelas_id" class="filter-select" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="nilai-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilai as $n)
                    <tr>
                        <td class="cell-no">{{ $loop->iteration }}</td>
                        <td>
                            <div class="name-cell">
                                <div class="name-avatar">{{ strtoupper(substr($n->siswa->nama ?? 'S', 0, 2)) }}</div>
                                <span style="font-weight:600;">{{ $n->siswa->nama ?? '—' }}</span>
                            </div>
                        </td>
                        <td><span class="badge-kelas">{{ $n->siswa->kelas->nama_kelas ?? '—' }}</span></td>
                        <td><span class="badge-mapel">{{ $n->mapel->nama_mapel ?? '—' }}</span></td>
                        <td>
                            <span class="nilai-chip {{ $n->nilai >= 80 ? 'tinggi' : ($n->nilai >= 60 ? 'sedang' : 'rendah') }}">
                                {{ $n->nilai }}
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <a href="{{ route('guru.nilai.edit', $n->id) }}" class="btn-edit-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/>
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="empty-title">Belum ada data nilai</div>
                                <div class="empty-desc">Mulai input nilai dengan klik tombol Input Nilai di atas.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span>Menampilkan {{ $nilai->count() }} data nilai</span>
            <span>{{ now()->format('d M Y') }}</span>
        </div>
    </div>

</div>
@endsection