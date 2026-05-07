@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary: #2563eb;
    --primary-light: #eff6ff;
    --primary-border: #bfdbfe;
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --success-light: #f0fdf4;
    --success-border: #bbf7d0;
    --warning: #d97706;
    --warning-light: #fffbeb;
    --warning-border: #fde68a;
    --danger: #dc2626;
    --danger-light: #fef2f2;
    --danger-border: #fecaca;
    --info: #0284c7;
    --info-light: #f0f9ff;
    --info-border: #bae6fd;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --surface: #ffffff;
    --surface-secondary: #f8fafc;
    --border: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus: 0 0 0 3px rgba(37,99,235,0.12);
    --radius-sm: 6px; --radius-md: 10px; --radius-lg: 14px; --radius-xl: 18px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.page-wrapper { animation: fadeUp 0.4s ease both; }
@keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }

/* HEADER */
.page-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
.page-icon { width:50px; height:50px; border-radius:var(--radius-lg); background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.page-icon svg { width:24px; height:24px; color:var(--primary); }
.page-title { font-size:22px; font-weight:700; color:var(--text-primary); margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle { font-size:13px; color:var(--text-secondary); margin:0; }

/* CARD */
.section-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; margin-bottom:22px; }
.card-head { padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); display:flex; align-items:center; gap:9px; }
.card-head-dot { width:8px; height:8px; border-radius:50%; }
.dot-blue { background:var(--primary); }
.dot-green { background:var(--success); }
.dot-orange { background:var(--warning); }
.card-head-label { font-size:12.5px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.7px; }
.card-head-label span { font-weight:600; color:var(--primary); text-transform:none; font-size:13px; }
.card-body-p { padding:24px 22px; }

/* FORM FILTER */
.filter-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:20px; }
.form-label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:6px; }
.form-control, .form-select {
    width:100%; padding:10px 14px; font-size:13.5px;
    font-family:'Plus Jakarta Sans',sans-serif; color:var(--text-primary);
    background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none;
    transition:border-color 0.2s, box-shadow 0.2s; appearance:none;
}
.form-control:focus, .form-select:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.form-control[readonly] { background:var(--surface-secondary); color:var(--text-secondary); }
.form-select {
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:38px; cursor:pointer;
}

.btn-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:8px; }

.btn-outline-primary {
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    padding:10px 20px; font-size:13.5px; font-weight:600;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--surface); color:var(--primary);
    border:1.5px solid var(--primary); border-radius:var(--radius-md);
    cursor:pointer; transition:all 0.15s; text-decoration:none;
}
.btn-outline-primary:hover { background:var(--primary-light); }
.btn-outline-primary svg { width:15px; height:15px; }

.btn-primary {
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    padding:10px 20px; font-size:13.5px; font-weight:600;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--primary); color:#fff;
    border:none; border-radius:var(--radius-md);
    cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(37,99,235,0.25);
}
.btn-primary:hover { background:var(--primary-dark); }
.btn-primary svg { width:15px; height:15px; }

/* TABLE */
.table-responsive { overflow-x:auto; }
table.styled-table { width:100%; border-collapse:collapse; min-width:500px; }
.styled-table thead tr { background:var(--surface-secondary); border-bottom:1px solid var(--border); }
.styled-table thead th { padding:12px 16px; font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.7px; text-align:left; white-space:nowrap; }
.styled-table tbody tr { border-bottom:1px solid var(--border); transition:background 0.15s; }
.styled-table tbody tr:last-child { border-bottom:none; }
.styled-table tbody tr:hover { background:#f8faff; }
.styled-table tbody td { padding:14px 16px; font-size:13.5px; color:var(--text-primary); vertical-align:middle; }

/* NAME CELL */
.name-cell { display:flex; align-items:center; gap:10px; }
.name-avatar { width:34px; height:34px; border-radius:50%; background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:var(--primary); flex-shrink:0; }

/* BADGES */
.badge { display:inline-flex; align-items:center; gap:5px; border-radius:999px; font-size:12px; font-weight:600; padding:4px 12px; }
.badge::before { content:''; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
.badge-hadir { background:var(--success-light); color:var(--success); border:1px solid var(--success-border); }
.badge-hadir::before { background:var(--success); }
.badge-izin { background:var(--warning-light); color:var(--warning); border:1px solid var(--warning-border); }
.badge-izin::before { background:var(--warning); }
.badge-sakit { background:var(--info-light); color:var(--info); border:1px solid var(--info-border); }
.badge-sakit::before { background:var(--info); }
.badge-alpha { background:var(--danger-light); color:var(--danger); border:1px solid var(--danger-border); }
.badge-alpha::before { background:var(--danger); }

.ket-text { font-size:13px; color:var(--text-secondary); }

/* ACTION BUTTONS */
.btn-edit-sm {
    display:inline-flex; align-items:center; gap:5px;
    padding:5px 12px; font-size:12.5px; font-weight:600;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--warning-light); color:var(--warning);
    border:1px solid var(--warning-border); border-radius:var(--radius-sm);
    cursor:pointer; transition:all 0.15s;
}
.btn-edit-sm:hover { background:#fef3c7; }
.btn-edit-sm svg { width:13px; height:13px; }

/* SEMUA HADIR BUTTON */
.btn-all-hadir {
    display:inline-flex; align-items:center; gap:6px;
    padding:7px 15px; font-size:12.5px; font-weight:600;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--success-light); color:var(--success);
    border:1px solid var(--success-border); border-radius:var(--radius-md);
    cursor:pointer; transition:all 0.15s;
}
.btn-all-hadir:hover { background:#dcfce7; }
.btn-all-hadir svg { width:14px; height:14px; }

.btn-save-absen {
    display:flex; align-items:center; justify-content:center; gap:8px;
    width:100%; padding:12px; font-size:14px; font-weight:700;
    font-family:'Plus Jakarta Sans',sans-serif;
    background:var(--success); color:#fff;
    border:none; border-radius:var(--radius-md);
    cursor:pointer; transition:all 0.15s;
    margin-top:20px; box-shadow:0 2px 8px rgba(22,163,74,0.3);
}
.btn-save-absen:hover { background:#15803d; }
.btn-save-absen svg { width:16px; height:16px; }

/* INPUT TABLE */
.styled-table select.status {
    padding:7px 10px; font-size:13px; border:1px solid var(--border);
    border-radius:var(--radius-sm); background:var(--surface);
    font-family:'Plus Jakarta Sans',sans-serif; outline:none;
    appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 8px center; background-size:14px;
    padding-right:30px; width:100%;
}
.styled-table input.form-control { padding:7px 10px; font-size:13px; }

/* TOOLBAR */
.input-toolbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
.input-toolbar-label { font-size:13px; color:var(--text-muted); }

/* ALERT */
.alert-warn {
    background:var(--warning-light); border:1px solid var(--warning-border);
    border-radius:var(--radius-md); padding:14px 18px; text-align:center;
    font-size:13.5px; color:var(--warning); font-weight:500;
}

/* EMPTY STATE */
.empty-state { padding:60px 24px; text-align:center; }
.empty-icon { width:60px; height:60px; background:var(--surface-secondary); border-radius:50%; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; margin:0 auto 14px; }
.empty-icon svg { width:26px; height:26px; color:var(--text-muted); }
.empty-title { font-size:15px; font-weight:600; color:var(--text-primary); margin-bottom:4px; }
.empty-desc { font-size:13px; color:var(--text-muted); }

/* ── CUSTOM MODAL (tanpa Bootstrap JS dependency) ── */
.sw-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(2px);
}
.sw-modal-overlay.active {
    display: flex;
    animation: overlayIn 0.2s ease;
}
@keyframes overlayIn { from { opacity:0; } to { opacity:1; } }

.sw-modal-box {
    background: var(--surface);
    border-radius: var(--radius-xl);
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 480px;
    overflow: hidden;
    animation: modalIn 0.25s ease;
}
@keyframes modalIn { from { opacity:0; transform:translateY(-16px) scale(0.97); } to { opacity:1; transform:translateY(0) scale(1); } }

.sw-modal-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-secondary);
}
.sw-modal-title {
    font-size: 15px; font-weight: 700; color: var(--text-primary); margin: 0;
    display: flex; align-items: center; gap: 8px;
}
.sw-modal-title svg { width:18px; height:18px; color:var(--warning); }
.sw-modal-close {
    width: 30px; height: 30px; border-radius: 50%;
    background: var(--border); border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-secondary); transition: all 0.15s;
}
.sw-modal-close:hover { background: var(--danger-light); color: var(--danger); }

.sw-modal-body { padding: 22px; }
.sw-modal-field { margin-bottom: 16px; }
.sw-modal-field:last-child { margin-bottom: 0; }
.sw-modal-label {
    display: block; font-size: 13px; font-weight: 600;
    color: var(--text-primary); margin-bottom: 6px;
}

.sw-modal-foot {
    display: flex; align-items: center; justify-content: flex-end; gap: 10px;
    padding: 16px 22px;
    border-top: 1px solid var(--border);
    background: var(--surface-secondary);
}
.btn-modal-cancel {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; font-size: 13.5px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--surface); color: var(--text-secondary);
    border: 1px solid var(--border); border-radius: var(--radius-md);
    cursor: pointer; transition: all 0.15s;
}
.btn-modal-cancel:hover { background: var(--surface-secondary); }
.btn-modal-save {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 22px; font-size: 13.5px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--primary); color: #fff;
    border: none; border-radius: var(--radius-md);
    cursor: pointer; transition: all 0.15s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.25);
}
.btn-modal-save:hover { background: var(--primary-dark); }

@media(max-width:768px) {
    .filter-grid { grid-template-columns:1fr; }
    .btn-row { grid-template-columns:1fr; }
}
</style>

<div class="container mt-4 page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
        </div>
        <div>
            <h4 class="page-title">Manajemen Absensi</h4>
            <p class="page-subtitle">Catat dan pantau kehadiran siswa per kelas dan mata pelajaran</p>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <div class="section-card">
        <div class="card-head">
            <div class="card-head-dot dot-blue"></div>
            <span class="card-head-label">Filter Absensi</span>
        </div>
        <div class="card-body-p">
            <form method="GET" action="{{ route('guru.absensi') }}">
                <div class="filter-grid">
                    <div>
                        <label class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-select" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                        <input type="text" class="form-control" value="{{ $mapel->nama_mapel }}" readonly>
                    </div>
                    <div>
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ request('tanggal') ?? date('Y-m-d') }}">
                    </div>
                </div>
                <div class="btn-row">
                    <button type="submit" name="aksi" value="lihat" class="btn-outline-primary">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Riwayat
                    </button>
                    <button type="submit" name="aksi" value="input" class="btn-primary">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Input Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== RIWAYAT ===== --}}
    @if(request('aksi') == 'lihat' && isset($riwayat))
    <div class="section-card">
        <div class="card-head">
            <div class="card-head-dot dot-orange"></div>
            <span class="card-head-label">Riwayat Absensi &mdash; <span>{{ request('tanggal') }}</span></span>
        </div>
        <div class="card-body-p" style="padding:0;">
            @if($riwayat && $riwayat->count())
            <div class="table-responsive">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $r)
                        <tr>
                            <td>
                                <div class="name-cell">
                                    <div class="name-avatar">{{ strtoupper(substr($r->siswa->nama,0,2)) }}</div>
                                    <span style="font-weight:600;">{{ $r->siswa->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge
                                    @if($r->status=='hadir') badge-hadir
                                    @elseif($r->status=='izin') badge-izin
                                    @elseif($r->status=='sakit') badge-sakit
                                    @else badge-alpha
                                    @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                            <td><span class="ket-text">{{ $r->keterangan ?? '—' }}</span></td>
                            <td style="text-align:center;">
                                {{-- Tombol edit → buka custom modal --}}
                                <button class="btn-edit-sm"
                                    onclick="openEditModal(
                                        {{ $r->id }},
                                        '{{ addslashes($r->siswa->nama) }}',
                                        '{{ $r->status }}',
                                        '{{ addslashes($r->keterangan ?? '') }}'
                                    )">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/>
                                    </svg>
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="card-body-p">
                <div class="alert-warn">Tidak ada data absensi pada tanggal ini.</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- ===== FORM INPUT ===== --}}
    @if(request('aksi') == 'input' && isset($siswa))
    <div class="section-card">
        <div class="card-head">
            <div class="card-head-dot dot-green"></div>
            <span class="card-head-label">Input Absensi &mdash; <span>{{ request('tanggal') }}</span></span>
        </div>
        <div class="card-body-p">
            <form method="POST" action="{{ route('guru.absensi.simpan') }}">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelasAktif->id }}">
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">

                <div class="input-toolbar">
                    <span class="input-toolbar-label">{{ $siswa->count() }} siswa ditemukan</span>
                    <button type="button" class="btn-all-hadir" onclick="setAll('hadir')">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Semua Hadir
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th style="width:180px;">Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $s)
                            <tr>
                                <td>
                                    <div class="name-cell">
                                        <div class="name-avatar">{{ strtoupper(substr($s->nama,0,2)) }}</div>
                                        <span style="font-weight:600;">{{ $s->nama }}</span>
                                    </div>
                                </td>
                                <td>
                                    <select name="absensi[{{ $s->id }}][status]" class="status">
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpha">Alpha</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="absensi[{{ $s->id }}][keterangan]" class="form-control" placeholder="Opsional...">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn-save-absen">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Absensi
                </button>
            </form>
        </div>
    </div>
    @endif

</div>

{{-- ══ CUSTOM MODAL EDIT (satu modal, diisi via JS) ══ --}}
<div class="sw-modal-overlay" id="editModalOverlay" onclick="closeEditModal(event)">
    <div class="sw-modal-box" onclick="event.stopPropagation()">
        <div class="sw-modal-head">
            <h5 class="sw-modal-title">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/>
                </svg>
                Edit Absensi Siswa
            </h5>
            <button class="sw-modal-close" onclick="closeEditModal()">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editAbsensiForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="sw-modal-body">
                <div class="sw-modal-field">
                    <label class="sw-modal-label">Nama Siswa</label>
                    <input type="text" id="modalNama" class="form-control" readonly>
                </div>
                <div class="sw-modal-field">
                    <label class="sw-modal-label">Status Kehadiran</label>
                    <select id="modalStatus" name="status" class="form-select">
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpha">Alpha</option>
                    </select>
                </div>
                <div class="sw-modal-field">
                    <label class="sw-modal-label">Keterangan <span style="font-weight:400;color:var(--text-muted);">(opsional)</span></label>
                    <input type="text" id="modalKeterangan" name="keterangan" class="form-control" placeholder="Tulis keterangan...">
                </div>
            </div>
            <div class="sw-modal-foot">
                <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-modal-save">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function setAll(status) {
    document.querySelectorAll('.status').forEach(el => { el.value = status; });
}

function openEditModal(id, nama, status, keterangan) {
    // Set action URL dinamis
    document.getElementById('editAbsensiForm').action = '/guru/absensi/update/' + id;

    // Isi field
    document.getElementById('modalNama').value        = nama;
    document.getElementById('modalStatus').value      = status;
    document.getElementById('modalKeterangan').value  = keterangan;

    // Tampilkan overlay
    document.getElementById('editModalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeEditModal(event) {
    // Kalau klik overlay (bukan modal box), tutup
    if (event && event.target !== document.getElementById('editModalOverlay')) return;
    document.getElementById('editModalOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

// Tutup dengan tombol ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('editModalOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }
});
</script>

@endsection