@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary: #2563eb;
    --primary-light: #eff6ff;
    --primary-border: #bfdbfe;
    --success: #16a34a;
    --success-light: #f0fdf4;
    --success-border: #bbf7d0;
    --info: #0284c7;
    --info-light: #f0f9ff;
    --info-border: #bae6fd;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --surface: #ffffff;
    --surface-secondary: #f8fafc;
    --border: #e2e8f0;
    --shadow-md: 0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --radius-md: 10px;
    --radius-lg: 14px;
    --radius-xl: 18px;
}

* {
    box-sizing: border-box;
}

body,
button,
input,
select,
textarea {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.jadwal-wrapper {
    width: 100%;
    max-width: 100%;
    animation: fadeInUp 0.4s ease both;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.container-fluid {
    width: 100%;
    max-width: 100%;
}

.table-card {
    width: 100%;
}

.table-responsive {
    width: 100%;
}

/* ---- HEADER ---- */
.page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 28px;
}

.page-icon {
    width: 52px;
    height: 52px;
    border-radius: var(--radius-lg);
    background: var(--primary-light);
    border: 1px solid var(--primary-border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.page-icon svg { width: 24px; height: 24px; color: var(--primary); }

.page-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 3px 0;
    letter-spacing: -0.3px;
}

.page-subtitle {
    font-size: 13.5px;
    color: var(--text-secondary);
    margin: 0;
}

/* ---- STATS ROW ---- */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon.blue  { background: var(--primary-light); }
.stat-icon.green { background: var(--success-light); }
.stat-icon.teal  { background: var(--info-light); }
.stat-icon svg { width: 18px; height: 18px; }
.stat-icon.blue  svg { color: var(--primary); }
.stat-icon.green svg { color: var(--success); }
.stat-icon.teal  svg { color: var(--info); }

.stat-label { font-size: 12px; color: var(--text-muted); font-weight: 500; }
.stat-value { font-size: 20px; font-weight: 700; color: var(--text-primary); line-height: 1.1; margin-top: 1px; }

/* ---- TABLE CARD ---- */
.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.table-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 22px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-secondary);
    gap: 12px;
    flex-wrap: wrap;
}

.toolbar-title {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.toolbar-badge {
    background: var(--primary-light);
    color: var(--primary);
    border: 1px solid var(--primary-border);
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 600;
    padding: 2px 10px;
}

.search-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.search-wrap svg {
    position: absolute;
    left: 10px;
    width: 14px;
    height: 14px;
    color: var(--text-muted);
    pointer-events: none;
}

.search-input {
    padding: 7px 12px 7px 32px;
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background: var(--surface);
    color: var(--text-primary);
    width: 200px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.search-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}

.search-input::placeholder { color: var(--text-muted); }

/* ---- TABLE ---- */
.table-responsive { overflow-x: auto; }

table.jadwal-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 540px;
}

.jadwal-table thead tr {
    background: var(--surface-secondary);
    border-bottom: 1px solid var(--border);
}

.jadwal-table thead th {
    padding: 12px 18px;
    font-size: 11px;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.7px;
    text-align: left;
    white-space: nowrap;
}

.jadwal-table thead th.center { text-align: center; }

.jadwal-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}

.jadwal-table tbody tr:last-child { border-bottom: none; }
.jadwal-table tbody tr:hover { background: #f8faff; }

.jadwal-table tbody td {
    padding: 15px 18px;
    font-size: 13.5px;
    color: var(--text-primary);
    vertical-align: middle;
}

.jadwal-table tbody td.center { text-align: center; }

/* KELAS CELL */
.kelas-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: var(--text-primary);
}

.kelas-dot {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--primary-light);
    border: 1px solid var(--primary-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: var(--primary);
    flex-shrink: 0;
}

/* MAPEL CELL */
.mapel-text {
    font-size: 13.5px;
    color: var(--text-secondary);
    font-weight: 500;
}

/* HARI BADGE */
.badge-hari {
    display: inline-flex;
    align-items: center;
    background: var(--info-light);
    color: var(--info);
    border: 1px solid var(--info-border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 14px;
    letter-spacing: 0.2px;
}

/* JAM BADGE */
.badge-jam {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--success-light);
    color: var(--success);
    border: 1px solid var(--success-border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 14px;
    white-space: nowrap;
}

.badge-jam svg { width: 13px; height: 13px; }

/* EMPTY STATE */
.empty-state {
    padding: 72px 24px;
    text-align: center;
}

.empty-icon {
    width: 64px;
    height: 64px;
    background: var(--surface-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    border: 1px solid var(--border);
}

.empty-icon svg { width: 28px; height: 28px; color: var(--text-muted); }
.empty-title  { font-size: 15px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
.empty-desc   { font-size: 13.5px; color: var(--text-muted); }

/* FOOTER */
.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 13px 22px;
    border-top: 1px solid var(--border);
    background: var(--surface-secondary);
    font-size: 12.5px;
    color: var(--text-muted);
    flex-wrap: wrap;
    gap: 6px;
}

@media (max-width: 600px) {
    .stats-row { grid-template-columns: 1fr 1fr; }
    .page-title { font-size: 18px; }
    .search-input { width: 160px; }
}
</style>

<div class="container-fluid px-4 py-4">
<div class="jadwal-wrapper">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <h1 class="page-title">Jadwal Mengajar</h1>
            <p class="page-subtitle">Daftar jadwal kelas dan mata pelajaran yang diampu</p>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <div class="stat-label">Total Jadwal</div>
                <div class="stat-value">{{ $jadwal->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <div class="stat-label">Kelas Diampu</div>
                <div class="stat-value">{{ $jadwal->unique(fn($j) => $j->kelas->nama_kelas)->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon teal">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <div class="stat-label">Hari Aktif</div>
                <div class="stat-value">{{ $jadwal->unique('hari')->count() }}</div>
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="table-card">

        <div class="table-toolbar">
            <div class="toolbar-title">
                Daftar Jadwal
                <span class="toolbar-badge">{{ $jadwal->count() }} sesi</span>
            </div>
            <div class="search-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                </svg>
                <input type="text" class="search-input" placeholder="Cari kelas, hari..." id="searchInput" oninput="filterJadwal()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="jadwal-table" id="jadwalTable">
                <thead>
                    <tr>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th class="center">Hari</th>
                        <th class="center">Jam Mengajar</th>
                    </tr>
                </thead>
                <tbody id="jadwalBody">
                    @forelse($jadwal as $j)
                    <tr>
                        <td>
                            <div class="kelas-pill">
                                <div class="kelas-dot">
                                    {{ strtoupper(substr($j->kelas->nama_kelas, 0, 2)) }}
                                </div>
                                {{ $j->kelas->nama_kelas }}
                            </div>
                        </td>
                        <td>
                            <span class="mapel-text">{{ $j->mapel->nama_mapel }}</span>
                        </td>
                        <td class="center">
                            <span class="badge-hari">{{ $j->hari }}</span>
                        </td>
                        <td class="center">
                            <span class="badge-jam">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $j->jam_mulai }} – {{ $j->jam_selesai }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="empty-title">Belum ada jadwal tersedia</div>
                                <div class="empty-desc">Jadwal mengajar akan muncul di sini setelah ditambahkan oleh admin.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span id="footerCount">Menampilkan {{ $jadwal->count() }} jadwal</span>
            <span>{{ now()->format('l, d F Y') }}</span>
        </div>

    </div>

</div>
</div>

<script>
function filterJadwal() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#jadwalBody tr');
    let count = 0;
    rows.forEach(row => {
        const show = row.textContent.toLowerCase().includes(q);
        row.style.display = show ? '' : 'none';
        if (show) count++;
    });
    document.getElementById('footerCount').textContent = 'Menampilkan ' + count + ' jadwal';
}
</script>

@endsection