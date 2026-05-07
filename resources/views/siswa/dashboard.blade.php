@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap');

:root {
    --ink:       #0c0f1a;
    --ink-2:     #1e2235;
    --ink-3:     #2d3452;
    --slate:     #64748b;
    --muted:     #94a3b8;
    --dim:       #cbd5e1;
    --surface:   #ffffff;
    --surface-2: #f6f8fc;
    --surface-3: #eef1f8;

    --blue:      #2563eb;
    --blue-2:    #1d4ed8;
    --blue-glow: rgba(37,99,235,0.18);
    --blue-soft: #eff6ff;
    --blue-border:#bfdbfe;

    --green:     #059669;
    --green-soft:#ecfdf5;
    --green-border:#a7f3d0;

    --amber:     #d97706;
    --amber-soft:#fffbeb;
    --amber-border:#fde68a;

    --red:       #dc2626;
    --red-soft:  #fef2f2;
    --red-border:#fecaca;

    --violet:    #7c3aed;
    --violet-soft:#f5f3ff;
    --violet-border:#ddd6fe;

    --r-sm:5px; --r-md:10px; --r-lg:16px; --r-xl:22px; --r-2xl:30px;
    --shadow-card: 0 2px 12px rgba(12,15,26,0.06), 0 1px 3px rgba(12,15,26,0.04);
    --shadow-hover: 0 8px 28px rgba(12,15,26,0.10), 0 2px 8px rgba(12,15,26,0.06);
    --shadow-blue:  0 4px 20px rgba(37,99,235,0.22);
}

*, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

body { background: var(--surface-2); }

.db { font-family:'Sora',sans-serif; padding: 28px 32px 48px; }

/* ─── HERO GREETING ─────────────────────────────────────── */
.greeting-band {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
    gap: 24px;
    background: var(--ink);
    border-radius: var(--r-2xl);
    padding: 32px 36px;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
}

.greeting-band::before {
    content:'';
    position:absolute; inset:0;
    background:
        radial-gradient(ellipse 60% 80% at 90% 50%, rgba(37,99,235,0.22) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 0%, rgba(124,58,237,0.14) 0%, transparent 60%);
    pointer-events:none;
}

.greeting-band::after {
    content:'';
    position:absolute;
    right:-60px; top:-60px;
    width:260px; height:260px;
    border-radius:50%;
    background: rgba(37,99,235,0.06);
    border: 1px solid rgba(255,255,255,0.05);
}

.greeting-text { position:relative; z-index:1; }

.greeting-tag {
    display:inline-flex; align-items:center; gap:7px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius:999px;
    padding:5px 14px;
    font-size:12px; font-weight:600; color:rgba(255,255,255,0.7);
    letter-spacing:0.5px;
    text-transform:uppercase;
    margin-bottom:14px;
}

.greeting-tag span {
    width:7px; height:7px; border-radius:50%;
    background:#22c55e;
    box-shadow:0 0 8px #22c55e;
    animation: pulse-dot 2s ease-in-out infinite;
}

@keyframes pulse-dot {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:0.6; transform:scale(0.8); }
}

.greeting-name {
    font-size:28px; font-weight:800; color:#fff;
    line-height:1.15; letter-spacing:-0.5px;
    margin-bottom:8px;
}

.greeting-name em { font-style:normal; color:#93c5fd; }

.greeting-sub {
    font-size:13.5px; color:rgba(255,255,255,0.5);
    font-weight:400; line-height:1.5;
}

.greeting-date-box {
    position:relative; z-index:1;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius:var(--r-lg);
    padding:18px 22px;
    text-align:center;
    backdrop-filter:blur(8px);
    flex-shrink:0;
}

.date-day {
    font-size:38px; font-weight:800; color:#fff;
    line-height:1; font-family:'Sora',sans-serif;
    letter-spacing:-1px;
}

.date-month {
    font-size:13px; font-weight:500; color:rgba(255,255,255,0.5);
    text-transform:uppercase; letter-spacing:1px;
    margin-top:4px;
}

.date-time {
    font-family:'JetBrains Mono',monospace;
    font-size:12px; font-weight:500;
    color:#93c5fd;
    margin-top:8px;
    background: rgba(37,99,235,0.2);
    border-radius:var(--r-sm);
    padding:3px 8px;
}

/* ─── STATS GRID ─────────────────────────────────────────── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--surface-3);
    border-radius: var(--r-xl);
    padding: 22px 20px;
    box-shadow: var(--shadow-card);
    transition: box-shadow 0.2s, transform 0.2s;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.stat-card::before {
    content:'';
    position:absolute; top:0; left:0; right:0;
    height:3px;
    border-radius:var(--r-xl) var(--r-xl) 0 0;
}

.stat-card.blue::before { background: linear-gradient(90deg, var(--blue), #60a5fa); }
.stat-card.green::before { background: linear-gradient(90deg, var(--green), #34d399); }
.stat-card.amber::before { background: linear-gradient(90deg, var(--amber), #fbbf24); }
.stat-card.violet::before { background: linear-gradient(90deg, var(--violet), #a78bfa); }

.stat-icon-wrap {
    width:44px; height:44px;
    border-radius:var(--r-md);
    display:flex; align-items:center; justify-content:center;
    margin-bottom:16px;
}

.stat-card.blue  .stat-icon-wrap { background:var(--blue-soft);   border:1px solid var(--blue-border);   }
.stat-card.green .stat-icon-wrap { background:var(--green-soft);  border:1px solid var(--green-border);  }
.stat-card.amber .stat-icon-wrap { background:var(--amber-soft);  border:1px solid var(--amber-border);  }
.stat-card.violet.stat-icon-wrap { background:var(--violet-soft); border:1px solid var(--violet-border); }
.stat-card.violet .stat-icon-wrap { background:var(--violet-soft); border:1px solid var(--violet-border); }

.stat-icon-wrap svg { width:20px; height:20px; }
.stat-card.blue  .stat-icon-wrap svg { color:var(--blue);   }
.stat-card.green .stat-icon-wrap svg { color:var(--green);  }
.stat-card.amber .stat-icon-wrap svg { color:var(--amber);  }
.stat-card.violet .stat-icon-wrap svg { color:var(--violet); }

.stat-label {
    font-size:11.5px; font-weight:600; color:var(--muted);
    text-transform:uppercase; letter-spacing:0.7px;
    margin-bottom:5px;
}

.stat-value {
    font-size:30px; font-weight:800; color:var(--ink);
    letter-spacing:-1px; line-height:1;
    font-family:'Sora',sans-serif;
}

.stat-value.mono {
    font-family:'JetBrains Mono',monospace;
    font-size:26px;
}

.stat-sub {
    font-size:12px; color:var(--muted);
    margin-top:6px;
}

/* ─── MAIN 2-COL ─────────────────────────────────────────── */
.main-cols {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

/* ─── SECTION CARD ───────────────────────────────────────── */
.section-card {
    background: var(--surface);
    border: 1px solid var(--surface-3);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.sc-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 22px 14px;
    border-bottom: 1px solid var(--surface-3);
}

.sc-head-left { display:flex; align-items:center; gap:10px; }

.sc-icon {
    width:36px; height:36px;
    border-radius:var(--r-md);
    display:flex; align-items:center; justify-content:center;
    flex-shrink:0;
}

.sc-icon.blue   { background:var(--blue-soft);   border:1px solid var(--blue-border);   }
.sc-icon.green  { background:var(--green-soft);  border:1px solid var(--green-border);  }
.sc-icon.amber  { background:var(--amber-soft);  border:1px solid var(--amber-border);  }
.sc-icon.violet { background:var(--violet-soft); border:1px solid var(--violet-border); }
.sc-icon svg { width:17px; height:17px; }
.sc-icon.blue   svg { color:var(--blue);   }
.sc-icon.green  svg { color:var(--green);  }
.sc-icon.amber  svg { color:var(--amber);  }
.sc-icon.violet svg { color:var(--violet); }

.sc-title {
    font-size:14px; font-weight:700; color:var(--ink);
    letter-spacing:-0.2px;
}

.sc-badge {
    font-size:11.5px; font-weight:600; color:var(--muted);
    background:var(--surface-3); border:1px solid var(--dim);
    border-radius:999px; padding:2px 10px;
}

/* ─── NILAI LIST ─────────────────────────────────────────── */
.nilai-list { padding: 6px 0; flex:1; }

.nilai-row {
    display: flex; align-items: center; gap:12px;
    padding: 13px 22px;
    border-bottom: 1px solid var(--surface-3);
    transition: background 0.15s;
}

.nilai-row:last-child { border-bottom:none; }
.nilai-row:hover { background: var(--surface-2); }

.nilai-mapel-dot {
    width:9px; height:9px; border-radius:50%; flex-shrink:0;
    background: var(--blue);
}

.nilai-mapel {
    flex: 1;
    font-size:13.5px; font-weight:600; color:var(--ink);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.nilai-chip {
    font-family:'JetBrains Mono',monospace;
    font-size:13px; font-weight:700;
    padding:3px 10px;
    border-radius:var(--r-sm);
    flex-shrink:0;
}

.nilai-chip.a { background:var(--green-soft);  color:var(--green); border:1px solid var(--green-border); }
.nilai-chip.b { background:var(--blue-soft);   color:var(--blue);  border:1px solid var(--blue-border);  }
.nilai-chip.c { background:var(--amber-soft);  color:var(--amber); border:1px solid var(--amber-border); }
.nilai-chip.d { background:var(--red-soft);    color:var(--red);   border:1px solid var(--red-border);   }

/* ─── ABSENSI LIST ───────────────────────────────────────── */
.absensi-list { padding: 6px 0; flex:1; }

.absensi-row {
    display: flex; align-items: center; gap:12px;
    padding: 13px 22px;
    border-bottom: 1px solid var(--surface-3);
    transition: background 0.15s;
}

.absensi-row:last-child { border-bottom:none; }
.absensi-row:hover { background: var(--surface-2); }

.ab-date-box {
    width:40px; height:40px;
    border-radius:var(--r-md);
    background:var(--surface-2);
    border:1px solid var(--surface-3);
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    flex-shrink:0;
}

.ab-date-d  { font-size:14px; font-weight:700; color:var(--ink); line-height:1; }
.ab-date-m  { font-size:9px; font-weight:600; color:var(--muted); text-transform:uppercase; letter-spacing:0.5px; margin-top:2px; }

.ab-info { flex:1; min-width:0; }
.ab-mapel { font-size:13px; font-weight:600; color:var(--ink); }
.ab-time  { font-size:11.5px; color:var(--muted); margin-top:2px; font-family:'JetBrains Mono',monospace; }

.ab-badge {
    font-size:11.5px; font-weight:700;
    padding:4px 11px; border-radius:999px;
    flex-shrink:0; display:inline-flex; align-items:center; gap:5px;
}

.ab-badge::before {
    content:''; width:6px; height:6px; border-radius:50%;
}

.ab-badge.hadir  { background:var(--green-soft);  color:var(--green); border:1px solid var(--green-border); }
.ab-badge.hadir::before  { background:var(--green); }
.ab-badge.izin   { background:var(--amber-soft);  color:var(--amber); border:1px solid var(--amber-border); }
.ab-badge.izin::before   { background:var(--amber); }
.ab-badge.sakit  { background:var(--blue-soft);   color:var(--blue);  border:1px solid var(--blue-border);  }
.ab-badge.sakit::before  { background:var(--blue); }
.ab-badge.alpha  { background:var(--red-soft);    color:var(--red);   border:1px solid var(--red-border);   }
.ab-badge.alpha::before  { background:var(--red); }

/* ─── EMPTY STATE ────────────────────────────────────────── */
.empty-state {
    padding:42px 24px; text-align:center;
}
.empty-icon {
    width:52px; height:52px;
    background:var(--surface-2); border:1px solid var(--surface-3);
    border-radius:50%; display:flex; align-items:center; justify-content:center;
    margin:0 auto 12px;
}
.empty-icon svg { width:23px; height:23px; color:var(--muted); }
.empty-text { font-size:13px; color:var(--muted); font-weight:500; }

/* ─── RATA NILAI PROGRESS ────────────────────────────────── */
.avg-band {
    background: var(--surface);
    border: 1px solid var(--surface-3);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-card);
    padding: 22px 24px;
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 24px;
}

.avg-circle {
    width:88px; height:88px;
    border-radius:50%; flex-shrink:0;
    background: conic-gradient(
        var(--blue) calc(var(--pct) * 1%),
        var(--surface-3) 0
    );
    display:flex; align-items:center; justify-content:center;
    position:relative;
}

.avg-circle::before {
    content:'';
    position:absolute;
    width:68px; height:68px;
    border-radius:50%;
    background: var(--surface);
}

.avg-circle-val {
    position:relative; z-index:1;
    font-size:20px; font-weight:800;
    color:var(--ink); font-family:'JetBrains Mono',monospace;
    letter-spacing:-0.5px;
}

.avg-info { flex:1; }
.avg-label { font-size:12px; font-weight:600; color:var(--muted); text-transform:uppercase; letter-spacing:0.7px; margin-bottom:6px; }
.avg-title { font-size:19px; font-weight:800; color:var(--ink); letter-spacing:-0.4px; margin-bottom:8px; }

.avg-bar-wrap { background:var(--surface-3); border-radius:999px; height:7px; overflow:hidden; }
.avg-bar {
    height:100%; border-radius:999px;
    background: linear-gradient(90deg, var(--blue), #60a5fa);
    width: calc(var(--pct) * 1%);
    transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.avg-foot { display:flex; align-items:center; justify-content:space-between; margin-top:6px; }
.avg-foot-text { font-size:12px; color:var(--muted); }
.avg-foot-pct  { font-size:12px; font-weight:700; color:var(--blue); font-family:'JetBrains Mono',monospace; }

/* ─── RESPONSIVE ─────────────────────────────────────────── */
@media(max-width:1024px) {
    .stats-grid { grid-template-columns:repeat(2,1fr); }
}

@media(max-width:768px) {
    .db { padding:16px 16px 40px; }
    .greeting-band { grid-template-columns:1fr; }
    .greeting-date-box { display:none; }
    .greeting-name { font-size:22px; }
    .stats-grid { grid-template-columns:repeat(2,1fr); }
    .main-cols { grid-template-columns:1fr; }
}

@media(max-width:480px) {
    .stats-grid { grid-template-columns:1fr 1fr; gap:10px; }
    .stat-value { font-size:24px; }
}

/* ─── ANIMATION ──────────────────────────────────────────── */
.db > * { animation: rise 0.5s ease both; }
.db > *:nth-child(1) { animation-delay:0s;    }
.db > *:nth-child(2) { animation-delay:0.07s; }
.db > *:nth-child(3) { animation-delay:0.14s; }
.db > *:nth-child(4) { animation-delay:0.20s; }

@keyframes rise {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0);    }
}

.stats-grid .stat-card { animation: rise 0.5s ease both; }
.stats-grid .stat-card:nth-child(1) { animation-delay:0.08s; }
.stats-grid .stat-card:nth-child(2) { animation-delay:0.14s; }
.stats-grid .stat-card:nth-child(3) { animation-delay:0.20s; }
.stats-grid .stat-card:nth-child(4) { animation-delay:0.26s; }
</style>

<div class="db">

    {{-- ── GREETING BAND ────────────────────────────── --}}
    <div class="greeting-band">
        <div class="greeting-text">
            <div class="greeting-tag">
                <span></span> Portal Akademik Siswa
            </div>
            <h1 class="greeting-name">
                Selamat datang,<br>
                <em>{{ auth()->user()->name ?? 'Siswa' }}</em>
            </h1>
            <p class="greeting-sub">Pantau nilai, absensi, dan progres belajarmu hari ini.</p>
        </div>
        <div class="greeting-date-box">
            <div class="date-day" id="clockDay">—</div>
            <div class="date-month" id="clockMonth">—</div>
            <div class="date-time" id="clockTime">00:00:00</div>
        </div>
    </div>

    {{-- ── STATS ROW ─────────────────────────────────── --}}
    <div class="stats-grid">

        {{-- Rata-rata Nilai --}}
        <div class="stat-card blue">
            <div class="stat-icon-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="stat-label">Rata-rata Nilai</div>
            <div class="stat-value mono">{{ $rataNilai ? number_format($rataNilai, 1) : '—' }}</div>
            <div class="stat-sub">dari 100 poin</div>
        </div>

        {{-- Hadir --}}
        <div class="stat-card green">
            <div class="stat-icon-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-label">Total Hadir</div>
            <div class="stat-value">{{ $hadir }}</div>
            <div class="stat-sub">pertemuan tercatat</div>
        </div>

        {{-- Tugas --}}
        <div class="stat-card amber">
            <div class="stat-icon-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="stat-label">Tugas</div>
            <div class="stat-value">{{ $tugas }}</div>
            <div class="stat-sub">tugas diberikan</div>
        </div>

        {{-- Mata Pelajaran --}}
        <div class="stat-card violet">
            <div class="stat-icon-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="stat-label">Mata Pelajaran</div>
            <div class="stat-value">{{ $nilaiTerbaru->pluck('mapel_id')->unique()->count() }}</div>
            <div class="stat-sub">mapel dinilai</div>
        </div>

    </div>

    {{-- ── RATA NILAI BAR ────────────────────────────── --}}
    @php $pct = $rataNilai ? min(round($rataNilai), 100) : 0; @endphp
    <div class="avg-band" style="--pct:{{ $pct }};">
        <div class="avg-circle" style="--pct:{{ $pct }};">
            <span class="avg-circle-val">{{ $pct }}%</span>
        </div>
        <div class="avg-info">
            <div class="avg-label">Progres Akademik</div>
            <div class="avg-title">
                @if($pct >= 85) Prestasi Sangat Baik ⭐
                @elseif($pct >= 70) Performa Baik 👍
                @elseif($pct >= 55) Cukup, Terus Semangat 💪
                @else Butuh Peningkatan 📚
                @endif
            </div>
            <div class="avg-bar-wrap">
                <div class="avg-bar"></div>
            </div>
            <div class="avg-foot">
                <span class="avg-foot-text">Rata-rata dari semua mata pelajaran</span>
                <span class="avg-foot-pct">{{ $rataNilai ? number_format($rataNilai, 1) : '0' }} / 100</span>
            </div>
        </div>
    </div>

    {{-- ── 2 COLUMNS ─────────────────────────────────── --}}
    <div class="main-cols">

        {{-- NILAI TERBARU --}}
        <div class="section-card">
            <div class="sc-head">
                <div class="sc-head-left">
                    <div class="sc-icon blue">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span class="sc-title">Nilai Terbaru</span>
                </div>
                <span class="sc-badge">5 terkini</span>
            </div>
            <div class="nilai-list">
                @forelse($nilaiTerbaru as $n)
                @php
                    $v = $n->nilai;
                    $cls = $v >= 85 ? 'a' : ($v >= 70 ? 'b' : ($v >= 55 ? 'c' : 'd'));
                    $colors = ['a'=>'#059669','b'=>'#2563eb','c'=>'#d97706','d'=>'#dc2626'];
                @endphp
                <div class="nilai-row">
                    <div class="nilai-mapel-dot" style="background:{{ $colors[$cls] }};"></div>
                    <span class="nilai-mapel">{{ $n->mapel->nama_mapel ?? '—' }}</span>
                    <span class="nilai-chip {{ $cls }}">{{ $v }}</span>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <p class="empty-text">Belum ada data nilai</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- ABSENSI TERAKHIR --}}
        <div class="section-card">
            <div class="sc-head">
                <div class="sc-head-left">
                    <div class="sc-icon green">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <span class="sc-title">Riwayat Absensi</span>
                </div>
                <span class="sc-badge">5 terkini</span>
            </div>
            <div class="absensi-list">
                @forelse($absensiTerakhir as $a)
                @php
                    $tgl = \Carbon\Carbon::parse($a->created_at);
                    $statusClass = in_array($a->status, ['hadir','izin','sakit','alpha']) ? $a->status : 'hadir';
                    $statusLabel = ucfirst($a->status);
                @endphp
                <div class="absensi-row">
                    <div class="ab-date-box">
                        <div class="ab-date-d">{{ $tgl->format('d') }}</div>
                        <div class="ab-date-m">{{ $tgl->format('M') }}</div>
                    </div>
                    <div class="ab-info">
                        <div class="ab-mapel">Absensi Kelas</div>
                        <div class="ab-time">{{ $tgl->format('H:i') }} WIB</div>
                    </div>
                    <span class="ab-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="empty-text">Belum ada data absensi</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>{{-- /.main-cols --}}

</div>{{-- /.db --}}

<script>
// Live clock
function tick() {
    const now = new Date();
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    document.getElementById('clockDay').textContent   = String(now.getDate()).padStart(2,'0');
    document.getElementById('clockMonth').textContent = months[now.getMonth()] + ' ' + now.getFullYear();
    document.getElementById('clockTime').textContent  =
        String(now.getHours()).padStart(2,'0') + ':' +
        String(now.getMinutes()).padStart(2,'0') + ':' +
        String(now.getSeconds()).padStart(2,'0');
}
tick(); setInterval(tick, 1000);
</script>

@endsection