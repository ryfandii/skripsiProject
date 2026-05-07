@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --navy:          #0F1A2E;
    --navy-light:    #1E3050;
    --accent:        #3B6FE8;
    --success:       #059669;
    --success-light: #ECFDF5;
    --warning:       #D97706;
    --warning-light: #FFFBEB;
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --bg:            #F0F4FA;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-soft:     #6B7280;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

#content { padding: 0 !important; background: var(--bg) !important; }
#content-wrapper { background: var(--bg) !important; }

/* ── PAGE ── */
.hasil-wrapper {
    min-height: calc(100vh - 70px);
    background: var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

/* ── CARD ── */
.result-card {
    background: var(--surface);
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(15,26,46,.12);
    width: 100%;
    max-width: 480px;
    overflow: hidden;
}

/* ── CARD TOP (navy) ── */
.card-top {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
    padding: 32px 32px 28px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.card-top::before {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
    top: -60px; right: -60px;
}
.card-top::after {
    content: '';
    position: absolute;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    bottom: -40px; left: -30px;
}

/* ── SCORE RING ── */
.score-ring {
    position: relative; z-index: 2;
    width: 110px; height: 110px;
    border-radius: 50%;
    background: rgba(255,255,255,.1);
    border: 3px solid rgba(255,255,255,.2);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    margin: 0 auto 16px;
}
.score-num {
    font-size: 36px; font-weight: 800;
    color: #fff; line-height: 1;
}
.score-sub {
    font-size: 11px; font-weight: 600;
    color: rgba(255,255,255,.5);
    text-transform: uppercase; letter-spacing: .4px;
}
.card-top h3 {
    position: relative; z-index: 2;
    font-size: 16px; font-weight: 700;
    color: rgba(255,255,255,.85); margin: 0;
}

/* ── CARD BODY ── */
.card-body { padding: 28px 32px; }

/* ── STAT ROW ── */
.stat-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px; margin-bottom: 22px;
}
.stat-item {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 14px 16px; text-align: center;
}
.stat-val {
    font-size: 22px; font-weight: 800;
    color: var(--text-dark); margin-bottom: 2px;
}
.stat-lbl {
    font-size: 11.5px; font-weight: 600;
    color: var(--text-soft);
    text-transform: uppercase; letter-spacing: .3px;
}

/* ── PROGRESS ── */
.progress-wrap { margin-bottom: 20px; }
.progress-head {
    display: flex; justify-content: space-between;
    align-items: center; margin-bottom: 8px;
}
.progress-title { font-size: 12.5px; font-weight: 600; color: var(--text-soft); }
.progress-pct   { font-size: 12.5px; font-weight: 700; color: var(--accent); }
.progress-track {
    height: 10px; background: #F1F5F9;
    border-radius: 99px; overflow: hidden;
}
.progress-fill {
    height: 100%; border-radius: 99px;
    background: linear-gradient(90deg, var(--accent), var(--success));
}

/* ── FEEDBACK ── */
.feedback-badge {
    display: flex; align-items: center; gap: 10px;
    border-radius: 12px; padding: 13px 16px;
    margin-bottom: 22px;
    font-size: 13.5px; font-weight: 700;
}
.fb-success { background: var(--success-light); color: var(--success); border: 1px solid #A7F3D0; }
.fb-warning { background: var(--warning-light); color: var(--warning); border: 1px solid #FDE68A; }
.fb-danger  { background: var(--danger-light);  color: var(--danger);  border: 1px solid #FECACA; }

/* ── BUTTON ── */
.btn-home {
    display: flex; align-items: center;
    justify-content: center; gap: 9px;
    width: 100%; background: var(--navy); color: #fff;
    border: none; border-radius: 13px; padding: 14px;
    font-size: 14.5px; font-weight: 800;
    text-decoration: none; transition: all .18s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: 0 4px 16px rgba(15,26,46,.2);
}
.btn-home:hover {
    background: var(--navy-light); color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,26,46,.3);
    text-decoration: none;
}

@media (max-width: 480px) {
    .card-top  { padding: 24px 20px 20px; }
    .card-body { padding: 22px 20px; }
    .score-num { font-size: 30px; }
}
</style>

<div class="hasil-wrapper">
    <div class="result-card">

        {{-- TOP (navy) --}}
        <div class="card-top">
            <div class="score-ring">
                <div class="score-num">{{ $nilai }}</div>
                <div class="score-sub">Nilai</div>
            </div>
            <h3>Hasil Ujian — {{ $ujian->judul ?? 'Ujian' }}</h3>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            {{-- STAT --}}
            <div class="stat-row">
                <div class="stat-item">
                    <div class="stat-val" style="color:var(--success);">{{ $benar }}</div>
                    <div class="stat-lbl">Benar</div>
                </div>
                <div class="stat-item">
                    <div class="stat-val" style="color:var(--danger);">{{ $total - $benar }}</div>
                    <div class="stat-lbl">Salah</div>
                </div>
            </div>

            {{-- PROGRESS --}}
            <div class="progress-wrap">
                <div class="progress-head">
                    <span class="progress-title">Jawaban benar {{ $benar }} dari {{ $total }} soal</span>
                    <span class="progress-pct">{{ round(($benar / $total) * 100) }}%</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill"
                         style="width: {{ ($benar / $total) * 100 }}%">
                    </div>
                </div>
            </div>

            {{-- FEEDBACK --}}
            @if($nilai >= 80)
            <div class="feedback-badge fb-success">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sangat Baik! Pertahankan prestasi ini.
            </div>
            @elseif($nilai >= 60)
            <div class="feedback-badge fb-warning">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h.01M12 14h.01M10 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Cukup Baik. Masih bisa ditingkatkan!
            </div>
            @else
            <div class="feedback-badge fb-danger">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                Perlu Belajar Lagi. Jangan menyerah!
            </div>
            @endif

            {{-- BUTTON --}}
            <a href="{{ route('siswa.dashboard') }}" class="btn-home">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Dashboard
            </a>

        </div>
    </div>
</div>

@endsection