@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap');

:root {
    --ink:          #0c0f1a;
    --text-sec:     #475569;
    --text-muted:   #94a3b8;
    --surface:      #ffffff;
    --surface-2:    #f6f8fc;
    --surface-3:    #eef1f8;
    --border:       #e2e8f0;

    --blue:         #2563eb;
    --blue-dark:    #1d4ed8;
    --blue-soft:    #eff6ff;
    --blue-border:  #bfdbfe;

    --green:        #059669;
    --green-soft:   #ecfdf5;
    --green-border: #a7f3d0;

    --amber:        #d97706;
    --amber-soft:   #fffbeb;
    --amber-border: #fde68a;

    --red:          #dc2626;
    --red-soft:     #fef2f2;
    --red-border:   #fecaca;

    --slate:        #64748b;
    --slate-soft:   #f1f5f9;
    --slate-border: #cbd5e1;

    --r-md:  10px;  --r-lg: 16px;
    --r-xl:  22px;  --r-2xl: 28px;

    --shadow-sm:   0 1px 4px rgba(12,15,26,0.05);
    --shadow-card: 0 4px 20px rgba(12,15,26,0.07), 0 1px 4px rgba(12,15,26,0.04);
    --shadow-hover:0 10px 32px rgba(12,15,26,0.11), 0 2px 8px rgba(12,15,26,0.05);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.tugas-page {
    font-family: 'Sora', sans-serif;
    padding: 28px 28px 52px;
    background: var(--surface-2);
    min-height: 100vh;
}

/* ANIMATION */
.tugas-page > * { animation: rise 0.45s ease both; }
.tugas-page > *:nth-child(1) { animation-delay: 0s;    }
.tugas-page > *:nth-child(2) { animation-delay: 0.07s; }
.tugas-page > *:nth-child(3) { animation-delay: 0.13s; }
.tugas-page > *:nth-child(4) { animation-delay: 0.19s; }
@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── HERO ─────────────────────────────────────────── */
.page-hero {
    background: var(--ink);
    border-radius: var(--r-2xl);
    padding: 28px 32px;
    margin-bottom: 24px;
    display: flex; align-items: center;
    justify-content: space-between;
    gap: 20px; position: relative; overflow: hidden;
}
.page-hero::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 55% 90% at 100% 50%, rgba(37,99,235,0.22) 0%, transparent 65%),
        radial-gradient(ellipse 35% 60% at 0% 0%,   rgba(124,58,237,0.13) 0%, transparent 55%);
    pointer-events: none;
}
.hero-left { position: relative; z-index: 1; }
.hero-tag {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.13);
    border-radius: 999px; padding: 4px 14px;
    font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,0.6);
    letter-spacing: 0.6px; text-transform: uppercase; margin-bottom: 12px;
}
.hero-tag-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: #22c55e; box-shadow: 0 0 7px #22c55e;
}
.hero-title {
    font-size: 24px; font-weight: 800; color: #fff;
    letter-spacing: -0.4px; line-height: 1.2;
}
.hero-title em { font-style: normal; color: #93c5fd; }
.hero-sub { font-size: 13px; color: rgba(255,255,255,0.45); margin-top: 6px; }

.hero-right {
    position: relative; z-index: 1;
    display: flex; align-items: center; gap: 12px; flex-shrink: 0;
}
.hero-stat {
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.11);
    border-radius: var(--r-lg); padding: 14px 20px; text-align: center;
}
.hero-stat-val {
    font-size: 28px; font-weight: 800; color: #fff;
    letter-spacing: -1px; line-height: 1;
    font-family: 'JetBrains Mono', monospace;
}
.hero-stat-lbl {
    font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.42);
    text-transform: uppercase; letter-spacing: 0.7px; margin-top: 4px;
}

/* ── STATS ROW ────────────────────────────────────── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px; margin-bottom: 22px;
}
.s-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-xl); padding: 18px 16px;
    box-shadow: var(--shadow-card);
    position: relative; overflow: hidden;
    transition: box-shadow 0.2s, transform 0.2s;
}
.s-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-2px); }
.s-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: var(--r-xl) var(--r-xl) 0 0;
}
.s-card.blue::before   { background: linear-gradient(90deg,#2563eb,#60a5fa); }
.s-card.green::before  { background: linear-gradient(90deg,#059669,#34d399); }
.s-card.amber::before  { background: linear-gradient(90deg,#d97706,#fbbf24); }
.s-card.red::before    { background: linear-gradient(90deg,#dc2626,#f87171); }

.s-icon {
    width: 38px; height: 38px; border-radius: var(--r-md);
    display: flex; align-items: center; justify-content: center; margin-bottom: 12px;
}
.s-card.blue  .s-icon { background: var(--blue-soft);  border: 1px solid var(--blue-border);  }
.s-card.green .s-icon { background: var(--green-soft); border: 1px solid var(--green-border); }
.s-card.amber .s-icon { background: var(--amber-soft); border: 1px solid var(--amber-border); }
.s-card.red   .s-icon { background: var(--red-soft);   border: 1px solid var(--red-border);   }
.s-icon svg { width: 17px; height: 17px; }
.s-card.blue  .s-icon svg { color: var(--blue);  }
.s-card.green .s-icon svg { color: var(--green); }
.s-card.amber .s-icon svg { color: var(--amber); }
.s-card.red   .s-icon svg { color: var(--red);   }

.s-label { font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 4px; }
.s-value { font-size: 24px; font-weight: 800; color: var(--ink); letter-spacing: -0.5px; font-family: 'JetBrains Mono', monospace; line-height: 1; }
.s-sub   { font-size: 11.5px; color: var(--text-muted); margin-top: 4px; }

/* ── TABLE CARD ───────────────────────────────────── */
.table-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-xl); box-shadow: var(--shadow-card); overflow: hidden;
}
.table-toolbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px 14px; border-bottom: 1px solid var(--border);
    flex-wrap: wrap; gap: 12px;
}
.toolbar-title {
    font-size: 14px; font-weight: 700; color: var(--ink);
    display: flex; align-items: center; gap: 10px;
}
.toolbar-icon {
    width: 34px; height: 34px; border-radius: var(--r-md);
    background: var(--blue-soft); border: 1px solid var(--blue-border);
    display: flex; align-items: center; justify-content: center;
}
.toolbar-icon svg { width: 16px; height: 16px; color: var(--blue); }
.toolbar-badge {
    font-size: 11.5px; font-weight: 600;
    background: var(--surface-3); border: 1px solid var(--border);
    color: var(--text-muted); border-radius: 999px; padding: 2px 10px;
}

/* ── TABLE ────────────────────────────────────────── */
.table-responsive { overflow-x: auto; }
table.tugas-table { width: 100%; border-collapse: collapse; min-width: 720px; }
.tugas-table thead tr { background: var(--surface-2); border-bottom: 1px solid var(--border); }
.tugas-table thead th {
    padding: 12px 18px; font-size: 11px; font-weight: 700;
    color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px;
    text-align: left; white-space: nowrap;
}
.tugas-table thead th.center { text-align: center; }
.tugas-table tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
.tugas-table tbody tr:last-child { border-bottom: none; }
.tugas-table tbody tr:hover { background: #f8faff; }
.tugas-table tbody td { padding: 15px 18px; font-size: 13.5px; color: var(--ink); vertical-align: middle; }
.tugas-table tbody td.center { text-align: center; }

/* JUDUL CELL */
.judul-cell { font-weight: 700; color: var(--ink); line-height: 1.3; }
.mapel-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--blue-soft); border: 1px solid var(--blue-border);
    border-radius: 999px; padding: 3px 11px;
    font-size: 12px; font-weight: 600; color: var(--blue);
}

/* DEADLINE */
.deadline-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--amber-soft); border: 1px solid var(--amber-border);
    border-radius: var(--r-md); padding: 5px 12px;
    font-size: 12px; font-weight: 600; color: var(--amber);
    font-family: 'JetBrains Mono', monospace; white-space: nowrap;
}
.deadline-chip svg { width: 12px; height: 12px; }

/* WAKTU KUMPUL */
.kumpul-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--green-soft); border: 1px solid var(--green-border);
    border-radius: var(--r-md); padding: 5px 12px;
    font-size: 12px; font-weight: 600; color: var(--green);
    font-family: 'JetBrains Mono', monospace; white-space: nowrap;
}
.kumpul-chip svg { width: 12px; height: 12px; }
.dash-text { color: var(--text-muted); font-size: 13px; }

/* NILAI */
.nilai-chip {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 48px; padding: 4px 12px; border-radius: var(--r-md);
    font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 700;
    background: var(--green-soft); color: var(--green); border: 1px solid var(--green-border);
}

/* STATUS BADGES */
.badge-status {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 999px; font-size: 12px; font-weight: 700; padding: 4px 12px;
}
.badge-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
.badge-tepat  { background: var(--green-soft);  color: var(--green); border: 1px solid var(--green-border); }
.badge-tepat::before  { background: var(--green);  }
.badge-telat  { background: var(--amber-soft);  color: var(--amber); border: 1px solid var(--amber-border); }
.badge-telat::before  { background: var(--amber);  }
.badge-belum  { background: var(--red-soft);    color: var(--red);   border: 1px solid var(--red-border);   }
.badge-belum::before  { background: var(--red);    }
.badge-default{ background: var(--slate-soft);  color: var(--slate); border: 1px solid var(--slate-border); }
.badge-default::before{ background: var(--slate);  }

/* ACTION BUTTONS */
.action-group { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.btn-dl {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 13px; font-size: 12.5px; font-weight: 600;
    font-family: 'Sora', sans-serif;
    background: var(--green-soft); color: var(--green); border: 1px solid var(--green-border);
    border-radius: var(--r-md); text-decoration: none; transition: all 0.15s;
}
.btn-dl:hover { background: #d1fae5; color: var(--green); text-decoration: none; }
.btn-dl svg { width: 13px; height: 13px; }

.btn-kumpul {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 13px; font-size: 12.5px; font-weight: 600;
    font-family: 'Sora', sans-serif;
    background: var(--blue); color: #fff; border: none;
    border-radius: var(--r-md); text-decoration: none; transition: all 0.15s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.25);
}
.btn-kumpul:hover { background: var(--blue-dark); color: #fff; text-decoration: none; transform: translateY(-1px); }
.btn-kumpul svg { width: 13px; height: 13px; }

/* EMPTY */
.empty-state { padding: 64px 24px; text-align: center; }
.empty-icon {
    width: 60px; height: 60px; background: var(--surface-2); border: 1px solid var(--border);
    border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;
}
.empty-icon svg { width: 26px; height: 26px; color: var(--text-muted); }
.empty-title { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.empty-desc  { font-size: 13px; color: var(--text-muted); }

.table-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 24px; border-top: 1px solid var(--border);
    background: var(--surface-2); font-size: 12.5px; color: var(--text-muted);
    flex-wrap: wrap; gap: 6px;
}

/* ── MOBILE CARDS ─────────────────────────────────── */
.mobile-list { display: flex; flex-direction: column; gap: 14px; }
.m-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-xl); box-shadow: var(--shadow-sm);
    padding: 18px; position: relative; overflow: hidden;
    transition: box-shadow 0.2s, transform 0.2s;
}
.m-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-2px); }
.m-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0;
    width: 4px; border-radius: 4px 0 0 4px; background: var(--blue);
}
.m-card-head {
    display: flex; align-items: flex-start; justify-content: space-between;
    gap: 10px; margin-bottom: 10px;
}
.m-card-judul { font-size: 14px; font-weight: 700; color: var(--ink); line-height: 1.3; }
.m-card-meta  { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; }
.m-card-foot  { display: flex; flex-direction: column; gap: 8px; margin-top: 12px; }
.m-btn-full { width: 100%; justify-content: center; }

/* ── RESPONSIVE ───────────────────────────────────── */
@media (max-width: 1024px) { .stats-row { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 768px) {
    .tugas-page { padding: 16px 16px 48px; }
    .page-hero  { padding: 22px 20px; }
    .hero-title { font-size: 20px; }
    .hero-right { display: none; }
    .stats-row  { grid-template-columns: repeat(2,1fr); gap: 10px; }
}
</style>

<div class="tugas-page">

    {{-- HERO --}}
    <div class="page-hero">
        <div class="hero-left">
            <div class="hero-tag"><span class="hero-tag-dot"></span> Akademik Siswa</div>
            <h1 class="hero-title">Daftar <em>Tugas</em></h1>
            <p class="hero-sub">Pantau semua tugas, deadline, dan status pengumpulan kamu</p>
        </div>
        <div class="hero-right">
            @php
                $total    = $tugas->count();
                $sudah    = $tugas->whereNotNull('waktu_kumpul')->count();
                $belum    = $total - $sudah;
            @endphp
            <div class="hero-stat">
                <div class="hero-stat-val">{{ $total }}</div>
                <div class="hero-stat-lbl">Total Tugas</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-val">{{ $belum }}</div>
                <div class="hero-stat-lbl">Belum Kumpul</div>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    @php
        $sudahKumpul = $tugas->whereNotNull('waktu_kumpul')->count();
        $tepat       = $tugas->where('status','tepat')->count();
        $telat       = $tugas->where('status','telat')->count();
        $belumKumpul = $tugas->whereNull('waktu_kumpul')->count();
    @endphp
    <div class="stats-row">
        <div class="s-card blue">
            <div class="s-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="s-label">Total Tugas</div>
            <div class="s-value">{{ $tugas->count() }}</div>
            <div class="s-sub">semua tugas</div>
        </div>
        <div class="s-card green">
            <div class="s-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="s-label">Tepat Waktu</div>
            <div class="s-value">{{ $tepat }}</div>
            <div class="s-sub">dikumpulkan tepat</div>
        </div>
        <div class="s-card amber">
            <div class="s-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="s-label">Telat</div>
            <div class="s-value">{{ $telat }}</div>
            <div class="s-sub">melewati deadline</div>
        </div>
        <div class="s-card red">
            <div class="s-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="s-label">Belum Kumpul</div>
            <div class="s-value">{{ $belumKumpul }}</div>
            <div class="s-sub">perlu dikumpulkan</div>
        </div>
    </div>

    {{-- DESKTOP TABLE --}}
    <div class="table-card d-none d-md-block">
        <div class="table-toolbar">
            <div class="toolbar-title">
                <div class="toolbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                Daftar Tugas
                <span class="toolbar-badge">{{ $tugas->count() }} tugas</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="tugas-table">
                <thead>
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Mata Pelajaran</th>
                        <th>Deadline</th>
                        <th>Waktu Kumpul</th>
                        <th class="center">Nilai</th>
                        <th class="center">Status</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <!-- <tbody>
                    @forelse($tugas as $t)
                    <tr>
                        <td><span class="judul-cell">{{ $t->judul }}</span></td>

                        <td>
                            <span class="mapel-pill">{{ $t->mapel->nama_mapel ?? '—' }}</span>
                        </td>

                        <td>
                            <span class="deadline-chip">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}
                            </span>
                        </td>

                        <td>
                            @if($t->waktu_kumpul)
                                <span class="kumpul-chip">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($t->waktu_kumpul)->format('d M Y H:i') }}
                                </span>
                            @else
                                <span class="dash-text">—</span>
                            @endif
                        </td>

                        <td class="center">
                            @if($t->nilai)
                                <span class="nilai-chip">{{ $t->nilai }}</span>
                            @else
                                <span class="dash-text">—</span>
                            @endif
                        </td>

                        <td class="center">
                            @if($t->status == 'tepat')
                                <span class="badge-status badge-tepat">Tepat</span>
                            @elseif($t->status == 'telat')
                                <span class="badge-status badge-telat">Telat</span>
                            @elseif($t->status == 'lewat')
                                <span class="badge-status badge-belum">Belum</span>
                            @else
                                <span class="badge-status badge-default">Belum</span>
                            @endif
                        </td>

                        <td class="center">
                            <div class="action-group">
                                @if($t->file)
                                <a href="{{ route('guru.tugas.download', $t->id) }}" class="btn-dl">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Unduh
                                </a>
                                @endif
                                @if(!$t->waktu_kumpul && now()->lt($t->deadline))
                                <a href="{{ route('siswa.tugas.kumpul', $t->id) }}" class="btn-kumpul">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l4-4m0 0l4 4m-4-4v12"/>
                                    </svg>
                                    Kumpulkan
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div class="empty-title">Belum Ada Tugas</div>
                                <div class="empty-desc">Tugas yang diberikan guru akan muncul di sini.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody> -->
            </table>
        </div>

        @if($tugas->count() > 0)
        <div class="table-footer">
            <span>Menampilkan {{ $tugas->count() }} tugas</span>
            <span>{{ now()->format('d F Y') }}</span>
        </div>
        @endif
    </div>

    

@endsection