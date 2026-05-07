@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --navy:          #0F1A2E;
    --navy-mid:      #162236;
    --navy-light:    #1E3050;
    --accent:        #3B6FE8;
    --success:       #059669;
    --success-light: #ECFDF5;
    --bg:            #F0F4FA;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-mid:      #374151;
    --text-soft:     #6B7280;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

#content { padding: 0 !important; background: var(--bg) !important; }
#content-wrapper { background: var(--bg) !important; }

.sw-page { padding: 22px 28px; background: var(--bg); min-height: calc(100vh - 70px); }

/* ── HEADER ── */
.ujian-header {
    display: flex; align-items: flex-start;
    justify-content: space-between;
    gap: 16px; flex-wrap: wrap; margin-bottom: 22px;
}
.ujian-eyebrow {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(59,111,232,.1); border: 1px solid rgba(59,111,232,.2);
    border-radius: 99px; padding: 4px 12px;
    font-size: 11.5px; font-weight: 700; color: var(--accent);
    letter-spacing: .4px; text-transform: uppercase; margin-bottom: 8px;
}
.ujian-title {
    font-size: 20px; font-weight: 800;
    color: var(--text-dark); margin: 0; letter-spacing: -.3px;
}

/* ── TIMER ── */
.timer-wrap {
    display: flex; align-items: center; gap: 12px;
    background: var(--navy); border-radius: 14px;
    padding: 12px 20px; box-shadow: 0 4px 16px rgba(15,26,46,.25);
    flex-shrink: 0;
}
.timer-label {
    font-size: 11px; font-weight: 600;
    color: rgba(255,255,255,.5); text-transform: uppercase;
    letter-spacing: .5px; margin-bottom: 2px;
}
.timer-value {
    font-size: 22px; font-weight: 800;
    color: #fff; letter-spacing: 2px;
    font-variant-numeric: tabular-nums;
}
#timer-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #22C55E; flex-shrink: 0;
    animation: timerPulse 1.2s ease infinite;
}
@keyframes timerPulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%      { opacity: .4; transform: scale(.6); }
}

/* ── LAYOUT ── */
.ujian-layout {
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 20px;
    align-items: start;
}

/* ── SOAL CARD ── */
.soal-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    margin-bottom: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
}
.soal-head {
    display: flex; align-items: center; gap: 10px;
    padding: 14px 20px;
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
    border-bottom: 1px solid rgba(255,255,255,.06);
}
.soal-num {
    width: 30px; height: 30px; border-radius: 8px;
    background: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: #fff; flex-shrink: 0;
}
.soal-head-label {
    font-size: 13px; font-weight: 600;
    color: rgba(255,255,255,.75);
}
.soal-body { padding: 22px 20px; }
.pertanyaan {
    font-size: 14.5px; font-weight: 600;
    color: var(--text-dark); line-height: 1.75; margin-bottom: 18px;
}

/* ── OPSI ── */
.opsi-item   { display: block; cursor: pointer; margin-bottom: 10px; }
.opsi-item input { display: none; }
.opsi-inner {
    display: flex; align-items: center; gap: 12px;
    background: #F8FAFC; border: 1.5px solid var(--border);
    border-radius: 11px; padding: 11px 15px; transition: all .15s;
}
.opsi-item:hover .opsi-inner {
    border-color: var(--accent); background: #EEF4FF;
}
.opsi-item input:checked + .opsi-inner {
    background: rgba(59,111,232,.07);
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59,111,232,.1);
}
.opsi-key {
    width: 28px; height: 28px; border-radius: 7px;
    background: var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800; color: var(--text-soft);
    flex-shrink: 0; transition: all .15s;
}
.opsi-item input:checked + .opsi-inner .opsi-key {
    background: var(--accent); color: #fff;
}
.opsi-text {
    font-size: 13.5px; font-weight: 500; color: var(--text-mid);
}
.opsi-item input:checked + .opsi-inner .opsi-text {
    color: var(--accent); font-weight: 600;
}

/* ── SUBMIT ── */
.submit-wrap {
    display: flex; justify-content: flex-end; padding-bottom: 32px;
}
.btn-finish {
    display: inline-flex; align-items: center; gap: 9px;
    background: var(--navy); color: #fff; border: none;
    border-radius: 13px; padding: 13px 30px;
    font-size: 14.5px; font-weight: 800; cursor: pointer;
    transition: all .18s; font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: 0 4px 16px rgba(15,26,46,.25);
}
.btn-finish:hover {
    background: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,26,46,.35);
}

/* ── NAVIGASI SOAL ── */
.nav-card {
    background: var(--navy);
    border-radius: 18px; padding: 18px;
    box-shadow: 0 4px 20px rgba(15,26,46,.25);
    position: sticky; top: 90px;
}
.nav-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 11.5px; font-weight: 700;
    color: rgba(255,255,255,.55);
    text-transform: uppercase; letter-spacing: .5px;
    margin-bottom: 14px;
}
.nav-grid { display: flex; flex-wrap: wrap; gap: 7px; }
.nav-number {
    width: 38px; height: 38px; border-radius: 9px;
    border: 1.5px solid rgba(255,255,255,.12);
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; color: rgba(255,255,255,.7);
    font-size: 12.5px; font-weight: 700; transition: all .15s;
    background: rgba(255,255,255,.05);
}
.nav-number:hover {
    background: var(--accent); border-color: var(--accent); color: #fff;
}
.nav-number.answered {
    background: var(--success); border-color: var(--success); color: #fff;
}
.nav-legend {
    display: flex; gap: 12px; margin-top: 14px; flex-wrap: wrap;
}
.nav-leg-item {
    display: flex; align-items: center; gap: 6px;
    font-size: 11px; font-weight: 600; color: rgba(255,255,255,.45);
}
.nav-leg-dot { width: 10px; height: 10px; border-radius: 3px; }

@media (max-width: 992px) {
    .ujian-layout  { grid-template-columns: 1fr; }
    .nav-card      { position: relative; top: 0; }
    .sw-page       { padding: 16px; }
}
</style>

<div class="sw-page">

    {{-- HEADER --}}
    <div class="ujian-header">
        <div>
            <div class="ujian-eyebrow">
                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
                Sedang Berlangsung
            </div>
            <h2 class="ujian-title">{{ $ujian->judul }}</h2>
        </div>
        <div class="timer-wrap">
            <div>
                <div class="timer-label">Sisa Waktu</div>
                <div class="timer-value"><span id="timer"></span></div>
            </div>
            <div id="timer-dot"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('siswa.ujian.submit', $ujian->id) }}">
    @csrf

    <div class="ujian-layout">

        {{-- SOAL --}}
        <div>
            @foreach($soals as $i => $s)
            <div class="soal-card" id="soal{{ $s->id }}">
                <div class="soal-head">
                    <div class="soal-num">{{ $loop->iteration }}</div>
                    <div class="soal-head-label">Soal Nomor {{ $loop->iteration }}</div>
                </div>
                <div class="soal-body">
                    <p class="pertanyaan">{{ $s->pertanyaan }}</p>
                    <div>
                        @foreach(['a','b','c','d'] as $opt)
                        <label class="opsi-item">
                            <input type="radio"
                                   name="jawaban[{{ $s->id }}]"
                                   value="{{ $opt }}">
                            <div class="opsi-inner">
                                <div class="opsi-key">{{ strtoupper($opt) }}</div>
                                <div class="opsi-text">{{ $s->$opt }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <div class="submit-wrap">
                <button type="submit" class="btn-finish"
                        onclick="return confirm('Yakin ingin mengumpulkan ujian?')">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Selesai & Kumpulkan Ujian
                </button>
            </div>
        </div>

        {{-- NAVIGASI SOAL --}}
        <div class="nav-card">
            <div class="nav-title">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Navigasi Soal
            </div>
            <div class="nav-grid">
                @foreach($soals as $s)
                <a href="#soal{{ $s->id }}"
                   class="nav-number"
                   id="nav{{ $s->id }}">
                    {{ $loop->iteration }}
                </a>
                @endforeach
            </div>
            <div class="nav-legend">
                <div class="nav-leg-item">
                    <div class="nav-leg-dot" style="background:#059669;"></div>
                    Sudah dijawab
                </div>
                <div class="nav-leg-item">
                    <div class="nav-leg-dot" style="background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2);"></div>
                    Belum dijawab
                </div>
            </div>
        </div>

    </div>
    </form>

</div>

<script>
// TIMER
let waktu = {{ $ujian->durasi * 60 }};

let timerInterval = setInterval(function () {
    let menit = Math.floor(waktu / 60);
    let detik  = waktu % 60;
    document.getElementById('timer').innerHTML =
        menit + " : " + (detik < 10 ? "0" + detik : detik);
    waktu--;
    if (waktu < 0) {
        clearInterval(timerInterval);
        alert("Waktu habis!");
        document.querySelector('form').submit();
    }
}, 1000);

// AUTO HIGHLIGHT NAV
document.querySelectorAll('input[type=radio]').forEach(el => {
    el.addEventListener('change', function () {
        let soalId = this.name.match(/\[(\d+)\]/)[1];
        let navEl = document.getElementById('nav' + soalId);
        navEl.classList.add('answered');
    });
});
</script>

@endsection