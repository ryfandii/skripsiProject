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
    --danger: #dc2626;
    --danger-light: #fef2f2;
    --danger-border: #fecaca;
    --warning: #d97706;
    --warning-light: #fffbeb;
    --warning-border: #fde68a;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --surface: #ffffff;
    --surface-secondary: #f8fafc;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus: 0 0 0 3px rgba(37,99,235,0.12);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
    --radius-xl: 18px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.guru-wrapper {
    padding: 0 4px;
    animation: fadeInUp 0.4s ease both;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ---- HEADER ---- */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
}

.page-header-left {}

.page-breadcrumb {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 4px;
    letter-spacing: 0.3px;
}

.page-breadcrumb span { color: var(--primary); font-weight: 500; }

.page-title {
    font-size: 26px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    letter-spacing: -0.4px;
}

.page-subtitle {
    font-size: 13.5px;
    color: var(--text-secondary);
    margin-top: 3px;
}

.btn-add-guru {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--primary);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 11px 22px;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.25);
}

.btn-add-guru:hover {
    background: #1d4ed8;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
    transform: translateY(-1px);
    color: #fff;
    text-decoration: none;
}

.btn-add-guru svg { width: 16px; height: 16px; }

/* ---- STATS ROW ---- */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow 0.2s;
}

.stat-card:hover { box-shadow: var(--shadow-md); }

.stat-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon.blue { background: var(--primary-light); }
.stat-icon.green { background: var(--success-light); }
.stat-icon.red { background: var(--danger-light); }

.stat-icon svg { width: 20px; height: 20px; }
.stat-icon.blue svg { color: var(--primary); }
.stat-icon.green svg { color: var(--success); }
.stat-icon.red svg { color: var(--danger); }

.stat-info {}
.stat-label { font-size: 12px; color: var(--text-muted); font-weight: 500; }
.stat-value { font-size: 22px; font-weight: 700; color: var(--text-primary); line-height: 1.1; margin-top: 2px; }

/* ---- ALERT ---- */
.alert-success-custom {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--success-light);
    border: 1px solid var(--success-border);
    border-radius: var(--radius-md);
    padding: 14px 18px;
    margin-bottom: 20px;
    font-size: 14px;
    color: var(--success);
    font-weight: 500;
}

.alert-success-custom svg { width: 18px; height: 18px; flex-shrink: 0; }
.alert-close { margin-left: auto; background: none; border: none; cursor: pointer; color: var(--success); padding: 0; opacity: 0.7; }
.alert-close:hover { opacity: 1; }

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
    padding: 18px 22px 16px;
    border-bottom: 1px solid var(--border);
    gap: 16px;
    flex-wrap: wrap;
}

.toolbar-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.toolbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.search-wrap svg {
    position: absolute;
    left: 11px;
    width: 15px;
    height: 15px;
    color: var(--text-muted);
    pointer-events: none;
}

.search-input {
    padding: 8px 12px 8px 34px;
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background: var(--surface-secondary);
    color: var(--text-primary);
    width: 210px;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
}

.search-input:focus {
    border-color: var(--primary);
    box-shadow: var(--shadow-focus);
    background: var(--surface);
}

.search-input::placeholder { color: var(--text-muted); }

/* ---- TABLE ---- */
.table-responsive { overflow-x: auto; }

table.guru-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 860px;
}

.guru-table thead tr {
    background: var(--surface-secondary);
    border-bottom: 1px solid var(--border);
}

.guru-table thead th {
    padding: 13px 16px;
    font-size: 11.5px;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.7px;
    white-space: nowrap;
    text-align: left;
}

.guru-table thead th:last-child { text-align: center; }

.guru-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}

.guru-table tbody tr:last-child { border-bottom: none; }
.guru-table tbody tr:hover { background: #f8faff; }

.guru-table tbody td {
    padding: 14px 16px;
    font-size: 13.5px;
    color: var(--text-primary);
    vertical-align: middle;
}

.cell-no {
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 500;
    width: 48px;
}

.cell-nama {
    font-weight: 600;
    color: var(--text-primary);
}

.cell-nip {
    font-size: 13px;
    color: var(--text-secondary);
    font-family: 'Plus Jakarta Sans', monospace;
    letter-spacing: 0.2px;
}

.cell-muted {
    color: var(--text-secondary);
    font-size: 13px;
}

.badge-mapel {
    display: inline-flex;
    align-items: center;
    background: var(--primary-light);
    color: var(--primary);
    border: 1px solid var(--primary-border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 11px;
}

.badge-aktif {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--success-light);
    color: var(--success);
    border: 1px solid var(--success-border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 11px;
}

.badge-aktif::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--success);
}

.badge-nonaktif {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--danger-light);
    color: var(--danger);
    border: 1px solid var(--danger-border);
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 11px;
}

.badge-nonaktif::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--danger);
}

/* ---- ACTION BUTTONS ---- */
.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 13px;
    font-size: 12.5px;
    font-weight: 500;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border-radius: var(--radius-sm);
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
}

.btn-action svg { width: 13px; height: 13px; }

.btn-edit {
    background: var(--surface-secondary);
    color: var(--text-secondary);
    border-color: var(--border);
}

.btn-edit:hover {
    background: #f1f5f9;
    color: var(--text-primary);
    border-color: var(--border-hover);
    text-decoration: none;
}

.btn-delete {
    background: var(--danger-light);
    color: var(--danger);
    border-color: var(--danger-border);
}

.btn-delete:hover {
    background: #fee2e2;
    color: #b91c1c;
    text-decoration: none;
}

.btn-nonaktif {
    background: var(--warning-light);
    color: var(--warning);
    border-color: var(--warning-border);
}

.btn-nonaktif:hover {
    background: #fef3c7;
    color: #b45309;
    text-decoration: none;
}

.btn-aktifkan {
    background: var(--success-light);
    color: var(--success);
    border-color: var(--success-border);
}

.btn-aktifkan:hover {
    background: #dcfce7;
    color: #15803d;
    text-decoration: none;
}

/* ---- EMPTY STATE ---- */
.empty-state {
    padding: 64px 24px;
    text-align: center;
}

.empty-icon {
    width: 60px;
    height: 60px;
    background: var(--surface-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
}

.empty-icon svg { width: 28px; height: 28px; color: var(--text-muted); }

.empty-title {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 6px;
}

.empty-desc {
    font-size: 13.5px;
    color: var(--text-muted);
}

/* ---- TABLE FOOTER ---- */
.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 22px;
    border-top: 1px solid var(--border);
    background: var(--surface-secondary);
    font-size: 13px;
    color: var(--text-muted);
    flex-wrap: wrap;
    gap: 8px;
}
</style>

<div class="container-fluid px-4 py-2 guru-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-breadcrumb">Manajemen &rsaquo; <span>Guru</span></div>
            <h3 class="page-title">Data Guru</h3>
            <p class="page-subtitle">Kelola seluruh data guru aktif dan nonaktif</p>
        </div>
        <a href="{{ route('admin.guru.create') }}" class="btn-add-guru">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Guru
        </a>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m4 5.87a4 4 0 110-8 4 4 0 010 8zm6-12a4 4 0 10-8 0 4 4 0 008 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Guru</div>
                <div class="stat-value">{{ $guru->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Guru Aktif</div>
                <div class="stat-value">{{ $guru->where('status','aktif')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Nonaktif</div>
                <div class="stat-value">{{ $guru->where('status','nonaktif')->count() }}</div>
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert-success-custom" id="alertSuccess">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ session('success') }}</span>
        <button class="alert-close" onclick="document.getElementById('alertSuccess').remove()">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="table-card">
        <div class="table-toolbar">
            <span class="toolbar-label">Daftar Guru <span style="font-weight:400;color:var(--text-muted);font-size:13px;">({{ $guru->count() }} data)</span></span>
            <div class="toolbar-right">
                <div class="search-wrap">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                    </svg>
                    <input type="text" class="search-input" placeholder="Cari nama, NIP..." id="searchInput" oninput="filterTable()">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="guru-table" id="guruTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="guruTableBody">
                    @forelse($guru as $g)
                    <tr>
                        <td class="cell-no">{{ $loop->iteration }}</td>
                        <td>
                            <div class="cell-nama">{{ $g->nama }}</div>
                            @if($g->alamat)
                            <div class="cell-muted" style="font-size:12px;margin-top:2px;">{{ Str::limit($g->alamat, 40) }}</div>
                            @endif
                        </td>
                        <td class="cell-nip">{{ $g->nip ?: '—' }}</td>
                        <td>
                            <span class="badge-mapel">{{ $g->mapel->nama_mapel ?? '—' }}</span>
                        </td>
                        <td class="cell-muted">{{ $g->user->email ?? '—' }}</td>
                        <td class="cell-muted">{{ $g->telepon ?: '—' }}</td>
                        <td>
                            @if($g->status == 'aktif')
                                <span class="badge-aktif">Aktif</span>
                            @else
                                <span class="badge-nonaktif">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.guru.edit', $g->id) }}" class="btn-action btn-edit">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a1 1 0 00-1-1h-4a1 1 0 00-1 1m6 0H7"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>

                                @if($g->status == 'aktif')
                                    <a href="{{ route('admin.guru.nonaktif', $g->id) }}" class="btn-action btn-nonaktif">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        Nonaktifkan
                                    </a>
                                @else
                                    <a href="{{ route('admin.guru.aktifkan', $g->id) }}" class="btn-action btn-aktifkan">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Aktifkan
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m4 5.87a4 4 0 110-8 4 4 0 010 8zm6-12a4 4 0 10-8 0 4 4 0 008 0z"/>
                                    </svg>
                                </div>
                                <div class="empty-title">Belum ada data guru</div>
                                <div class="empty-desc">Mulai tambahkan data guru menggunakan tombol di atas.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span id="footerCount">Menampilkan {{ $guru->count() }} data</span>
            <span>Sistem Manajemen Guru &bull; {{ now()->format('d M Y') }}</span>
        </div>
    </div>

</div>

<script>
function filterTable() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#guruTableBody tr');
    let visible = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const show = text.includes(q);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('footerCount').textContent = 'Menampilkan ' + visible + ' data';
}
</script>

@endsection