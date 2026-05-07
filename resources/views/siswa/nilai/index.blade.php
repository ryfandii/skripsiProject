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

    --violet:       #7c3aed;
    --violet-soft:  #f5f3ff;
    --violet-border:#ddd6fe;

    --red:          #dc2626;
    --red-soft:     #fef2f2;
    --red-border:   #fecaca;

    --r-md:  10px;
    --r-lg:  16px;
    --r-xl:  22px;
    --r-2xl: 28px;

    --shadow-card: 0 4px 20px rgba(12,15,26,0.07), 0 1px 4px rgba(12,15,26,0.04);
    --shadow-hover:0 10px 32px rgba(12,15,26,0.11), 0 2px 8px rgba(12,15,26,0.05);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.nilai-page {
    font-family: 'Sora', sans-serif;
    padding: 28px 28px 52px;
    background: var(--surface-2);
    min-height: 100vh;
}

/* ── ANIMATIONS ───────────────────────────────────── */
.nilai-page > * { animation: rise 0.45s ease both; }
.nilai-page > *:nth-child(1) { animation-delay: 0s; }
.nilai-page > *:nth-child(2) { animation-delay: 0.07s; }
.nilai-page > *:nth-child(3) { animation-delay: 0.14s; }
.nilai-page > *:nth-child(4) { animation-delay: 0.20s; }

@keyframes rise {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── HERO BANNER ──────────────────────────────────── */
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
        radial-gradient(ellipse 55% 90% at 100% 50%, rgba(37,99,235,0.22) 0%, transparent 65%),
        radial-gradient(ellipse 35% 60% at 0% 0%,   rgba(124,58,237,0.13) 0%, transparent 55%);
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
    color: rgba(255,255,255,0.6);
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
    color: #fff; letter-spacing: -0.4px; line-height: 1.2;
}

.hero-title em { font-style: normal; color: #93c5fd; }

.hero-sub {
    font-size: 13px; color: rgba(255,255,255,0.45);
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
}

.hero-stat-val {
    font-size: 28px; font-weight: 800; color: #fff;
    letter-spacing: -1px; line-height: 1;
    font-family: 'JetBrains Mono', monospace;
}

.hero-stat-lbl {
    font-size: 11px; font-weight: 600;
    color: rgba(255,255,255,0.42);
    text-transform: uppercase; letter-spacing: 0.7px;
    margin-top: 4px;
}

/* ── SUMMARY CARDS ────────────────────────────────── */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}

.sum-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    padding: 20px 18px;
    box-shadow: var(--shadow-card);
    position: relative;
    overflow: hidden;
    transition: box-shadow 0.2s, transform 0.2s;
}

.sum-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.sum-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: var(--r-xl) var(--r-xl) 0 0;
}

.sum-card.blue::before   { background: linear-gradient(90deg, var(--blue), #60a5fa); }
.sum-card.amber::before  { background: linear-gradient(90deg, var(--amber), #fbbf24); }
.sum-card.green::before  { background: linear-gradient(90deg, var(--green), #34d399); }
.sum-card.violet::before { background: linear-gradient(90deg, var(--violet), #a78bfa); }

.sum-icon {
    width: 40px; height: 40px;
    border-radius: var(--r-md);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 14px;
}

.sum-card.blue   .sum-icon { background: var(--blue-soft);   border: 1px solid var(--blue-border);   }
.sum-card.amber  .sum-icon { background: var(--amber-soft);  border: 1px solid var(--amber-border);  }
.sum-card.green  .sum-icon { background: var(--green-soft);  border: 1px solid var(--green-border);  }
.sum-card.violet .sum-icon { background: var(--violet-soft); border: 1px solid var(--violet-border); }

.sum-icon svg { width: 18px; height: 18px; }
.sum-card.blue   .sum-icon svg { color: var(--blue);   }
.sum-card.amber  .sum-icon svg { color: var(--amber);  }
.sum-card.green  .sum-icon svg { color: var(--green);  }
.sum-card.violet .sum-icon svg { color: var(--violet); }

.sum-label {
    font-size: 11px; font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.7px;
    margin-bottom: 4px;
}

.sum-value {
    font-size: 26px; font-weight: 800;
    color: var(--ink); letter-spacing: -0.8px;
    font-family: 'JetBrains Mono', monospace;
    line-height: 1;
}

.sum-sub {
    font-size: 11.5px; color: var(--text-muted);
    margin-top: 5px;
}

/* ── TABLE CARD ───────────────────────────────────── */
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

/* ── TABLE ────────────────────────────────────────── */
.table-responsive { overflow-x: auto; }

table.nilai-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 620px;
}

.nilai-table thead tr {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
}

.nilai-table thead th {
    padding: 12px 18px;
    font-size: 11px; font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.8px;
    text-align: left; white-space: nowrap;
}

.nilai-table thead th.center { text-align: center; }

.nilai-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}

.nilai-table tbody tr:last-child { border-bottom: none; }
.nilai-table tbody tr:hover { background: #f8faff; }

.nilai-table tbody td {
    padding: 15px 18px;
    font-size: 13.5px; color: var(--ink);
    vertical-align: middle;
}

.nilai-table tbody td.center { text-align: center; }

/* NO CELL */
.cell-no {
    font-family: 'JetBrains Mono', monospace;
    font-size: 12.5px; color: var(--text-muted);
    font-weight: 500; width: 50px;
}

/* MAPEL CELL */
.mapel-cell {
    display: flex; align-items: center; gap: 10px;
}

.mapel-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--blue); flex-shrink: 0;
}

.mapel-name {
    font-weight: 600; color: var(--ink);
}

/* NILAI CHIPS */
.chip {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 52px;
    padding: 5px 13px;
    border-radius: var(--r-md);
    font-family: 'JetBrains Mono', monospace;
    font-size: 13px; font-weight: 700;
}

.chip.tugas  { background: var(--blue-soft);   color: var(--blue);   border: 1px solid var(--blue-border);   }
.chip.uts    { background: var(--amber-soft);  color: var(--amber);  border: 1px solid var(--amber-border);  }
.chip.uas    { background: var(--green-soft);  color: var(--green);  border: 1px solid var(--green-border);  }

/* RATA CHIP — dynamic color */
.chip.rata-a { background: var(--green-soft);  color: var(--green);  border: 1px solid var(--green-border);  }
.chip.rata-b { background: var(--blue-soft);   color: var(--blue);   border: 1px solid var(--blue-border);   }
.chip.rata-c { background: var(--amber-soft);  color: var(--amber);  border: 1px solid var(--amber-border);  }
.chip.rata-d { background: var(--red-soft);    color: var(--red);    border: 1px solid var(--red-border);    }

/* PROGRESS BAR inline */
.rata-wrap {
    display: flex; align-items: center; gap: 10px;
}

.mini-bar {
    flex: 1; height: 6px;
    background: var(--surface-3);
    border-radius: 999px;
    overflow: hidden;
    min-width: 60px;
}

.mini-bar-fill {
    height: 100%; border-radius: 999px;
    transition: width 0.8s cubic-bezier(0.16,1,0.3,1);
}

/* EMPTY */
.empty-state {
    padding: 64px 24px; text-align: center;
}

.empty-icon {
    width: 60px; height: 60px;
    background: var(--surface-2); border: 1px solid var(--border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}

.empty-icon svg { width: 26px; height: 26px; color: var(--text-muted); }
.empty-title  { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.empty-desc   { font-size: 13px; color: var(--text-muted); }

/* TABLE FOOTER */
.table-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface-2);
    font-size: 12.5px; color: var(--text-muted);
    flex-wrap: wrap; gap: 6px;
}

/* ── RESPONSIVE ───────────────────────────────────── */
@media (max-width: 1024px) { .summary-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 768px)  {
    .nilai-page { padding: 16px 16px 48px; }
    .page-hero  { padding: 22px 20px; }
    .hero-title { font-size: 20px; }
    .hero-right { display: none; }
    .summary-grid { grid-template-columns: repeat(2,1fr); gap: 10px; }
}
@media (max-width: 420px) {
    .summary-grid { grid-template-columns: 1fr 1fr; }
}
</style>

<div class="nilai-page">

    {{-- ── HERO ──────────────────────────────────────── --}}
    <div class="page-hero">
        <div class="hero-left">
            <div class="hero-tag">
                <span class="hero-tag-dot"></span>
                Rekap Akademik
            </div>
            <h1 class="hero-title">Data <em>Nilai Siswa</em></h1>
            <p class="hero-sub">Ringkasan nilai tugas, UTS, UAS, dan rata-rata per mata pelajaran</p>
        </div>
        <div class="hero-right">
            <div class="hero-stat">
                <div class="hero-stat-val">{{ count($data) }}</div>
                <div class="hero-stat-lbl">Mata Pelajaran</div>
            </div>
            @php
                $avgAll = collect($data)->avg('rata');
            @endphp
            <div class="hero-stat">
                <div class="hero-stat-val">{{ $avgAll ? number_format($avgAll, 1) : '—' }}</div>
                <div class="hero-stat-lbl">Rata-rata</div>
            </div>
        </div>
    </div>

    {{-- ── SUMMARY CARDS ──────────────────────────────── --}}
    @php
        $avgTugas = collect($data)->whereNotNull('tugas')->avg('tugas');
        $avgUts   = collect($data)->whereNotNull('uts')->avg('uts');
        $avgUas   = collect($data)->whereNotNull('uas')->avg('uas');
        $avgRata  = collect($data)->whereNotNull('rata')->avg('rata');
    @endphp

    <div class="summary-grid">
        <div class="sum-card blue">
            <div class="sum-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="sum-label">Avg. Tugas</div>
            <div class="sum-value">{{ $avgTugas ? number_format($avgTugas,1) : '—' }}</div>
            <div class="sum-sub">rata-rata nilai tugas</div>
        </div>

        <div class="sum-card amber">
            <div class="sum-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="sum-label">Avg. UTS</div>
            <div class="sum-value">{{ $avgUts ? number_format($avgUts,1) : '—' }}</div>
            <div class="sum-sub">rata-rata nilai UTS</div>
        </div>

        <div class="sum-card green">
            <div class="sum-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <div class="sum-label">Avg. UAS</div>
            <div class="sum-value">{{ $avgUas ? number_format($avgUas,1) : '—' }}</div>
            <div class="sum-sub">rata-rata nilai UAS</div>
        </div>

        <div class="sum-card violet">
            <div class="sum-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="sum-label">Avg. Keseluruhan</div>
            <div class="sum-value">{{ $avgRata ? number_format($avgRata,1) : '—' }}</div>
            <div class="sum-sub">rata-rata semua mapel</div>
        </div>
    </div>

    {{-- ── TABLE ──────────────────────────────────────── --}}
    <div class="table-card">
        <div class="table-toolbar">
            <div class="toolbar-title">
                <div class="toolbar-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                Rekap Nilai Per Mapel
                <span class="toolbar-badge">{{ count($data) }} mapel</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="nilai-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th class="center">Tugas</th>
                        <th class="center">UTS</th>
                        <th class="center">UAS</th>
                        <th>Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    @php
                        $rata = $d['rata'] ?? null;
                        $rataClass = !$rata ? 'rata-b'
                            : ($rata >= 85 ? 'rata-a'
                            : ($rata >= 70 ? 'rata-b'
                            : ($rata >= 55 ? 'rata-c' : 'rata-d')));

                        $barColor = !$rata ? '#2563eb'
                            : ($rata >= 85 ? '#059669'
                            : ($rata >= 70 ? '#2563eb'
                            : ($rata >= 55 ? '#d97706' : '#dc2626')));

                        $pct = $rata ? min($rata, 100) : 0;
                    @endphp
                    <tr>
                        <td class="cell-no">{{ $loop->iteration }}</td>

                        <td>
                            <div class="mapel-cell">
                                <div class="mapel-dot" style="background:{{ $barColor }};"></div>
                                <span class="mapel-name">{{ $d['mapel'] ?? '—' }}</span>
                            </div>
                        </td>

                        <td class="center">
                            <span class="chip tugas">{{ $d['tugas'] ?? '—' }}</span>
                        </td>

                        <td class="center">
                            <span class="chip uts">{{ $d['uts'] ?? '—' }}</span>
                        </td>

                        <td class="center">
                            <span class="chip uas">{{ $d['uas'] ?? '—' }}</span>
                        </td>

                        <td>
                            <div class="rata-wrap">
                                <span class="chip {{ $rataClass }}">{{ $rata ?? '—' }}</span>
                                @if($rata)
                                <div class="mini-bar">
                                    <div class="mini-bar-fill"
                                         style="width:{{ $pct }}%; background:{{ $barColor }};"></div>
                                </div>
                                @endif
                            </div>
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
                                <div class="empty-title">Belum Ada Data Nilai</div>
                                <div class="empty-desc">Nilai akan muncul setelah guru menginput data penilaian.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($data) > 0)
        <div class="table-footer">
            <span>Menampilkan {{ count($data) }} mata pelajaran</span>
            <span>{{ now()->format('d F Y') }}</span>
        </div>
        @endif
    </div>

</div>

@endsection