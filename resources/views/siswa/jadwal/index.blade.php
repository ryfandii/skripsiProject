@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap');

:root {
    --ink:         #0c0f1a;
    --text-sec:    #475569;
    --text-muted:  #94a3b8;
    --surface:     #ffffff;
    --surface-2:   #f6f8fc;
    --surface-3:   #eef1f8;
    --border:      #e2e8f0;

    --blue:        #2563eb;
    --blue-dark:   #1d4ed8;
    --blue-soft:   #eff6ff;
    --blue-border: #bfdbfe;

    --green:       #059669;
    --green-soft:  #ecfdf5;
    --green-border:#a7f3d0;

    --violet:      #7c3aed;
    --violet-soft: #f5f3ff;
    --violet-border:#ddd6fe;

    --amber:       #d97706;
    --amber-soft:  #fffbeb;
    --amber-border:#fde68a;

    --r-md:  10px;
    --r-lg:  16px;
    --r-xl:  22px;
    --r-2xl: 28px;

    --shadow-sm:   0 1px 4px rgba(12,15,26,0.05);
    --shadow-card: 0 4px 20px rgba(12,15,26,0.07), 0 1px 4px rgba(12,15,26,0.04);
    --shadow-hover:0 10px 32px rgba(12,15,26,0.11), 0 2px 8px rgba(12,15,26,0.05);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.jadwal-page {
    font-family: 'Sora', sans-serif;
    padding: 28px 28px 52px;
    background: var(--surface-2);
    min-height: 100vh;
}

/* ── PAGE HEADER ─────────────────────────────────── */
.page-hero {
    background: var(--ink);
    border-radius: var(--r-2xl);
    padding: 28px 32px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    position: relative;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 55% 90% at 100% 50%, rgba(37,99,235,0.20) 0%, transparent 65%),
        radial-gradient(ellipse 35% 60% at 0% 0%,   rgba(124,58,237,0.12) 0%, transparent 55%);
    pointer-events: none;
}

.hero-left { position: relative; z-index: 1; }

.hero-tag {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.13);
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 11.5px; font-weight: 600;
    color: rgba(255,255,255,0.65);
    letter-spacing: 0.6px; text-transform: uppercase;
    margin-bottom: 12px;
}

.hero-tag-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 7px #22c55e;
}

.hero-title {
    font-size: 24px; font-weight: 800;
    color: #fff; letter-spacing: -0.4px;
    line-height: 1.2;
}

.hero-title em { font-style: normal; color: #93c5fd; }

.hero-sub {
    font-size: 13px; color: rgba(255,255,255,0.48);
    margin-top: 6px;
}

.hero-right {
    position: relative; z-index: 1;
    display: flex; align-items: center; gap: 12px;
    flex-shrink: 0;
}

.hero-stat {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.11);
    border-radius: var(--r-lg);
    padding: 14px 20px;
    text-align: center;
    backdrop-filter: blur(6px);
}

.hero-stat-val {
    font-size: 28px; font-weight: 800; color: #fff;
    letter-spacing: -1px; line-height: 1;
    font-family: 'JetBrains Mono', monospace;
}

.hero-stat-lbl {
    font-size: 11px; font-weight: 600;
    color: rgba(255,255,255,0.45);
    text-transform: uppercase; letter-spacing: 0.7px;
    margin-top: 4px;
}

/* ── HARI FILTER TABS ────────────────────────────── */
.hari-tabs {
    display: flex; gap: 8px; flex-wrap: wrap;
    margin-bottom: 20px;
}

.hari-tab {
    padding: 7px 16px;
    font-size: 12.5px; font-weight: 600;
    font-family: 'Sora', sans-serif;
    border-radius: 999px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text-sec);
    cursor: pointer;
    transition: all 0.15s;
    user-select: none;
}

.hari-tab:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-soft); }
.hari-tab.active { background: var(--blue); color: #fff; border-color: var(--blue); box-shadow: 0 2px 10px rgba(37,99,235,0.3); }

/* ── EMPTY STATE ─────────────────────────────────── */
.empty-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    padding: 64px 24px;
    text-align: center;
    box-shadow: var(--shadow-card);
}

.empty-icon {
    width: 60px; height: 60px;
    background: var(--surface-2); border: 1px solid var(--border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
}

.empty-icon svg { width: 26px; height: 26px; color: var(--text-muted); }
.empty-title { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.empty-desc  { font-size: 13px; color: var(--text-muted); }

/* ── DESKTOP TABLE ───────────────────────────────── */
.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-card);
    overflow: hidden;
}

.table-toolbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px 14px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    flex-wrap: wrap; gap: 12px;
}

.toolbar-title {
    font-size: 14px; font-weight: 700; color: var(--ink);
    display: flex; align-items: center; gap: 10px;
}

.toolbar-icon {
    width: 34px; height: 34px;
    border-radius: var(--r-md);
    background: var(--blue-soft); border: 1px solid var(--blue-border);
    display: flex; align-items: center; justify-content: center;
}

.toolbar-icon svg { width: 16px; height: 16px; color: var(--blue); }

.toolbar-badge {
    font-size: 11.5px; font-weight: 600;
    background: var(--surface-3); border: 1px solid var(--border);
    color: var(--text-muted); border-radius: 999px;
    padding: 2px 10px;
}

.table-responsive { overflow-x: auto; }

table.jadwal-table {
    width: 100%; border-collapse: collapse;
    min-width: 580px;
}

.jadwal-table thead tr {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
}

.jadwal-table thead th {
    padding: 12px 18px;
    font-size: 11px; font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.8px;
    text-align: left; white-space: nowrap;
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
    font-size: 13.5px; color: var(--ink);
    vertical-align: middle;
}

.jadwal-table tbody td.center { text-align: center; }

/* NO CELL */
.cell-no {
    font-family: 'JetBrains Mono', monospace;
    font-size: 13px; color: var(--text-muted);
    font-weight: 500; width: 50px;
}

/* HARI BADGE */
@php
$hariColor = [
    'Senin'  => ['bg'=>'#eff6ff','color'=>'#2563eb','border'=>'#bfdbfe'],
    'Selasa' => ['bg'=>'#f5f3ff','color'=>'#7c3aed','border'=>'#ddd6fe'],
    'Rabu'   => ['bg'=>'#ecfdf5','color'=>'#059669','border'=>'#a7f3d0'],
    'Kamis'  => ['bg'=>'#fffbeb','color'=>'#d97706','border'=>'#fde68a'],
    'Jumat'  => ['bg'=>'#fef2f2','color'=>'#dc2626','border'=>'#fecaca'],
    'Sabtu'  => ['bg'=>'#fff7ed','color'=>'#ea580c','border'=>'#fed7aa'],
];
@endphp

.badge-hari {
    display: inline-flex; align-items: center;
    border-radius: 999px;
    font-size: 12px; font-weight: 700;
    padding: 4px 13px;
    white-space: nowrap;
}

/* MAPEL */
.mapel-cell {
    display: flex; align-items: center; gap: 10px;
}

.mapel-dot {
    width: 8px; height: 8px; border-radius: 50%;
    flex-shrink: 0;
    background: var(--blue);
}

.mapel-name {
    font-weight: 600; color: var(--ink);
}

/* GURU */
.guru-pill {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--surface-2); border: 1px solid var(--border);
    border-radius: 999px;
    padding: 5px 13px;
    font-size: 12.5px; color: var(--text-sec); font-weight: 500;
}

.guru-avatar {
    width: 22px; height: 22px; border-radius: 50%;
    background: var(--blue-soft); border: 1px solid var(--blue-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 9px; font-weight: 700; color: var(--blue);
    flex-shrink: 0;
}

/* JAM */
.jam-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--green-soft); border: 1px solid var(--green-border);
    border-radius: 999px;
    padding: 5px 13px;
    font-size: 12.5px; font-weight: 700; color: var(--green);
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

.jam-pill svg { width: 13px; height: 13px; }

/* TABLE FOOTER */
.table-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface-2);
    font-size: 12.5px; color: var(--text-muted);
    flex-wrap: wrap; gap: 6px;
}

/* ── MOBILE CARDS ─────────────────────────────────── */
.mobile-list { display: flex; flex-direction: column; gap: 12px; }

.m-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-sm);
    padding: 18px;
    position: relative;
    overflow: hidden;
    transition: box-shadow 0.2s, transform 0.2s;
}

.m-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.m-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: var(--blue);
    border-radius: 4px 0 0 4px;
}

.m-card-top {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 12px;
}

.m-card-mapel {
    font-size: 15px; font-weight: 700; color: var(--ink);
    line-height: 1.2;
}

.m-card-meta {
    display: flex; align-items: center; gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
}

/* ── ANIMATION ────────────────────────────────────── */
.jadwal-page > * { animation: rise 0.45s ease both; }
.jadwal-page > *:nth-child(1) { animation-delay: 0s;    }
.jadwal-page > *:nth-child(2) { animation-delay: 0.06s; }
.jadwal-page > *:nth-child(3) { animation-delay: 0.12s; }
.jadwal-page > *:nth-child(4) { animation-delay: 0.18s; }

@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0);    }
}

/* ── RESPONSIVE ───────────────────────────────────── */
@media (max-width: 768px) {
    .jadwal-page { padding: 16px 16px 48px; }
    .page-hero   { padding: 22px 20px; }
    .hero-title  { font-size: 20px; }
    .hero-right  { display: none; }
}
</style>

<div class="jadwal-page">

    {{-- ── HERO ──────────────────────────────────────── --}}
    <div class="page-hero">
        <div class="hero-left">
            <div class="hero-tag">
                <span class="hero-tag-dot"></span>
                Akademik Siswa
            </div>
            <h1 class="hero-title">Jadwal <em>Pelajaran</em></h1>
            <p class="hero-sub">Semua jadwal mata pelajaran kamu tersedia di sini</p>
        </div>
        <div class="hero-right">
            <div class="hero-stat">
                <div class="hero-stat-val">{{ $jadwal->count() }}</div>
                <div class="hero-stat-lbl">Total Sesi</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-val">{{ $jadwal->unique('hari')->count() }}</div>
                <div class="hero-stat-lbl">Hari Aktif</div>
            </div>
        </div>
    </div>

    {{-- ── HARI FILTER TABS ───────────────────────────── --}}
    @if(!$jadwal->isEmpty())
    <div class="hari-tabs">
        <div class="hari-tab active" onclick="filterHari('semua', this)">Semua</div>
        @foreach($jadwal->unique('hari') as $jh)
        <div class="hari-tab" onclick="filterHari('{{ $jh->hari }}', this)">{{ $jh->hari }}</div>
        @endforeach
    </div>
    @endif

    {{-- ── EMPTY STATE ────────────────────────────────── --}}
    @if($jadwal->isEmpty())
    <div class="empty-wrap">
        <div class="empty-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="empty-title">Jadwal Belum Tersedia</div>
        <div class="empty-desc">Hubungi wali kelas atau admin untuk informasi jadwal.</div>
    </div>
    @else

    {{-- ── DESKTOP TABLE ──────────────────────────────── --}}
    <div class="table-card d-none d-md-block" id="desktopTable">
        <div class="table-toolbar">
            <div class="toolbar-title">
                <div class="toolbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                Daftar Jadwal
                <span class="toolbar-badge">{{ $jadwal->count() }} sesi</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="jadwal-table" id="jadwalTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th class="center">Jam Mengajar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal as $j)
                    @php
                        $hc = $hariColor[$j->hari] ?? ['bg'=>'#f1f5f9','color'=>'#64748b','border'=>'#e2e8f0'];
                        $inisial = strtoupper(substr($j->guru->nama ?? 'G', 0, 2));
                    @endphp
                    <tr data-hari="{{ $j->hari }}">
                        <td class="cell-no">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge-hari"
                                style="background:{{ $hc['bg'] }};color:{{ $hc['color'] }};border:1px solid {{ $hc['border'] }};">
                                {{ $j->hari }}
                            </span>
                        </td>
                        <td>
                            <div class="mapel-cell">
                                <div class="mapel-dot" style="background:{{ $hc['color'] }};"></div>
                                <span class="mapel-name">{{ $j->mapel->nama_mapel ?? '—' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="guru-pill">
                                <div class="guru-avatar">{{ $inisial }}</div>
                                {{ $j->guru->nama ?? '—' }}
                            </div>
                        </td>
                        <td class="center">
                            <span class="jam-pill">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $j->jam_mulai }} – {{ $j->jam_selesai }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span id="footerCount">Menampilkan {{ $jadwal->count() }} jadwal</span>
            <span>{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    {{-- ── MOBILE CARDS ────────────────────────────────── --}}
    <div class="mobile-list d-block d-md-none" id="mobileList">
        @foreach($jadwal as $j)
        @php
            $hc = $hariColor[$j->hari] ?? ['bg'=>'#f1f5f9','color'=>'#64748b','border'=>'#e2e8f0'];
            $inisial = strtoupper(substr($j->guru->nama ?? 'G', 0, 2));
        @endphp
        <div class="m-card" data-hari="{{ $j->hari }}"
            style="--accent: {{ $hc['color'] }};">
            <style>.m-card[data-hari="{{ $j->hari }}"]:first-of-type::before { background: {{ $hc['color'] }}; }</style>

            <div class="m-card-top">
                <span class="badge-hari"
                    style="background:{{ $hc['bg'] }};color:{{ $hc['color'] }};border:1px solid {{ $hc['border'] }};">
                    {{ $j->hari }}
                </span>
                <span class="jam-pill" style="font-size:12px;padding:4px 11px;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $j->jam_mulai }} – {{ $j->jam_selesai }}
                </span>
            </div>

            <div class="m-card-mapel">{{ $j->mapel->nama_mapel ?? '—' }}</div>

            <div class="m-card-meta">
                <div class="guru-pill" style="font-size:12px;">
                    <div class="guru-avatar">{{ $inisial }}</div>
                    {{ $j->guru->nama ?? '—' }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endif {{-- end if not empty --}}

</div>

<script>
function filterHari(hari, el) {
    // update tab active
    document.querySelectorAll('.hari-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');

    // filter desktop rows
    document.querySelectorAll('#jadwalTable tbody tr').forEach(row => {
        row.style.display = (hari === 'semua' || row.dataset.hari === hari) ? '' : 'none';
    });

    // filter mobile cards
    document.querySelectorAll('#mobileList .m-card').forEach(card => {
        card.style.display = (hari === 'semua' || card.dataset.hari === hari) ? '' : 'none';
    });

    // update footer count
    const visible = [...document.querySelectorAll('#jadwalTable tbody tr')]
        .filter(r => r.style.display !== 'none').length;
    const el2 = document.getElementById('footerCount');
    if (el2) el2.textContent = 'Menampilkan ' + visible + ' jadwal';
}
</script>

@endsection