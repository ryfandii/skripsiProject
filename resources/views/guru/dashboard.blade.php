@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --primary:       #4F46E5;
    --primary-dark:  #3730A3;
    --primary-light: #EEF2FF;
    --success:       #059669;
    --success-light: #ECFDF5;
    --warning:       #D97706;
    --warning-light: #FFFBEB;
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --info:          #0284C7;
    --info-light:    #F0F9FF;
    --bg:            #F3F4F8;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-mid:      #374151;
    --text-soft:     #6B7280;
    --radius-md:     10px;
    --radius-lg:     16px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

/* ── HERO BANNER ── */
.sw-hero {
    background: linear-gradient(135deg, #1E3A6E 0%, #3730A3 50%, #4F46E5 100%);
    border-radius: var(--radius-lg);
    padding: 32px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
}
.sw-hero::before {
    content: '';
    position: absolute; right: -60px; top: -60px;
    width: 280px; height: 280px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.08);
}
.sw-hero::after {
    content: '';
    position: absolute; right: 80px; bottom: -80px;
    width: 200px; height: 200px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.06);
}

.sw-hero-left { position: relative; z-index: 1; }
.sw-hero-greeting {
    font-size: 13px; font-weight: 600;
    color: rgba(255,255,255,.6);
    text-transform: uppercase; letter-spacing: 1px;
    margin-bottom: 8px;
}
.sw-hero-name {
    font-size: 26px; font-weight: 800;
    color: #fff; line-height: 1.2;
    margin-bottom: 10px; letter-spacing: -.4px;
}
.sw-hero-meta {
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
}
.sw-hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 99px; padding: 5px 14px;
    font-size: 12px; font-weight: 600; color: rgba(255,255,255,.9);
}
.sw-hero-badge svg { opacity: .8; }

.sw-hero-right {
    position: relative; z-index: 1;
    text-align: right; flex-shrink: 0;
}
.sw-hero-date {
    font-size: 12px; color: rgba(255,255,255,.55);
    font-weight: 500; margin-bottom: 4px;
}
.sw-hero-time {
    font-size: 28px; font-weight: 800;
    color: #fff; letter-spacing: -1px;
    font-variant-numeric: tabular-nums;
}

/* ── STATS GRID ── */
.sw-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }

.sw-stat-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    padding: 22px 20px;
    display: flex; align-items: center; gap: 16px;
    position: relative; overflow: hidden;
    transition: transform .2s, box-shadow .2s;
}
.sw-stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.07); }

.sw-stat-card::after {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: 99px 99px 0 0;
}
.sw-stat-card.primary::after { background: var(--primary); }
.sw-stat-card.success::after { background: var(--success); }
.sw-stat-card.warning::after { background: var(--warning); }
.sw-stat-card.danger::after  { background: var(--danger); }

.sw-stat-icon {
    width: 48px; height: 48px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.sw-stat-icon.primary { background: var(--primary-light); color: var(--primary); }
.sw-stat-icon.success { background: var(--success-light); color: var(--success); }
.sw-stat-icon.warning { background: var(--warning-light); color: var(--warning); }
.sw-stat-icon.danger  { background: var(--danger-light);  color: var(--danger); }

.sw-stat-val {
    font-size: 28px; font-weight: 800;
    color: var(--text-dark); line-height: 1;
    margin-bottom: 4px; font-variant-numeric: tabular-nums;
}
.sw-stat-lbl { font-size: 12.5px; font-weight: 600; color: var(--text-soft); }

/* ── TWO-COL GRID ── */
.sw-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.sw-row-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px; }

/* ── CARD BASE ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    overflow: hidden;
}
.sw-card-hd {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 20px;
    border-bottom: 1px solid var(--border);
}
.sw-card-hd-left { display: flex; align-items: center; gap: 10px; }
.sw-card-hd-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.sw-card-hd-icon.primary { background: var(--primary-light); color: var(--primary); }
.sw-card-hd-icon.success { background: var(--success-light); color: var(--success); }
.sw-card-hd-icon.warning { background: var(--warning-light); color: var(--warning); }
.sw-card-hd-icon.danger  { background: var(--danger-light);  color: var(--danger);  }
.sw-card-hd h6 { font-size: 14px; font-weight: 700; color: var(--text-dark); margin: 0; }
.sw-card-hd p  { font-size: 11.5px; color: var(--text-soft); margin: 2px 0 0; }
.sw-card-bd { padding: 20px; }

/* ── QUICK ACTIONS ── */
.sw-actions { display: flex; flex-direction: column; gap: 10px; padding: 20px; }

.sw-action-btn {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: all .18s;
    border: 1px solid transparent;
}
.sw-action-btn.success { background: var(--success-light); border-color: #A7F3D0; color: var(--success); }
.sw-action-btn.success:hover { background: var(--success); color: #fff; border-color: var(--success); }
.sw-action-btn.warning { background: var(--warning-light); border-color: #FDE68A; color: var(--warning); }
.sw-action-btn.warning:hover { background: var(--warning); color: #fff; border-color: var(--warning); }
.sw-action-btn.danger  { background: var(--danger-light);  border-color: #FECACA; color: var(--danger); }
.sw-action-btn.danger:hover  { background: var(--danger);  color: #fff; border-color: var(--danger); }

.sw-action-icon {
    width: 38px; height: 38px; border-radius: 9px;
    background: rgba(255,255,255,.6);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: background .18s;
}
.sw-action-btn:hover .sw-action-icon { background: rgba(255,255,255,.2); }
.sw-action-text strong { display: block; font-size: 13.5px; font-weight: 700; }
.sw-action-text span   { font-size: 11.5px; opacity: .75; }
.sw-action-btn svg.arrow { margin-left: auto; opacity: .5; }

/* ── INFO LIST ── */
.sw-info-list { display: flex; flex-direction: column; gap: 0; }
.sw-info-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 0;
    border-bottom: 1px solid var(--border);
    font-size: 13.5px;
}
.sw-info-row:last-child { border-bottom: none; }
.sw-info-row-label { color: var(--text-soft); font-weight: 500; display: flex; align-items: center; gap: 8px; }
.sw-info-row-val { font-weight: 700; color: var(--text-dark); }

/* ── BADGE ── */
.sw-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 99px;
    font-size: 11.5px; font-weight: 600;
}
.sw-badge-primary { background: var(--primary-light); color: var(--primary); }
.sw-badge-success { background: var(--success-light); color: var(--success); }

/* ── MAPEL HIGHLIGHT ── */
.sw-mapel-box {
    background: linear-gradient(135deg, var(--primary-light), #DDD6FE);
    border: 1px solid #C7D2FE;
    border-radius: var(--radius-md);
    padding: 18px 20px;
    display: flex; align-items: center; gap: 14px;
}
.sw-mapel-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: var(--primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: 0 4px 12px rgba(79,70,229,.3);
}
.sw-mapel-label { font-size: 11.5px; font-weight: 600; color: var(--primary); text-transform: uppercase; letter-spacing: .6px; }
.sw-mapel-name  { font-size: 17px; font-weight: 800; color: var(--primary-dark); margin-top: 3px; }

@media (max-width: 900px) {
    .sw-stats { grid-template-columns: repeat(2, 1fr); }
    .sw-row, .sw-row-3 { grid-template-columns: 1fr; }
    .sw-page { padding: 16px; }
    .sw-hero { flex-direction: column; text-align: center; }
    .sw-hero-right { text-align: center; }
}
</style>

<div class="sw-page">

    {{-- ── HERO BANNER ── --}}
    <div class="sw-hero">
        <div class="sw-hero-left">
            <div class="sw-hero-greeting">Selamat Datang</div>
            <div class="sw-hero-name">{{ auth()->user()->name }}</div>
            <div class="sw-hero-meta">
                <div class="sw-hero-badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Guru
                </div>
                @if(auth()->user()->guru)
                <div class="sw-hero-badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    {{ auth()->user()->guru->mapel->nama_mapel ?? '-' }}
                </div>
                @endif
            </div>
        </div>
        <div class="sw-hero-right">
            <div class="sw-hero-date" id="sw-date"></div>
            <div class="sw-hero-time" id="sw-time"></div>
        </div>
    </div>

    {{-- ── STATS ── --}}
    <div class="sw-stats">

        <div class="sw-stat-card primary">
            <div class="sw-stat-icon primary">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $jumlahJadwal ?? 0 }}</div>
                <div class="sw-stat-lbl">Jadwal Mengajar</div>
            </div>
        </div>

        <div class="sw-stat-card success">
            <div class="sw-stat-icon success">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="23 11 17 17 14 14"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $jumlahAbsensi ?? 0 }}</div>
                <div class="sw-stat-lbl">Absensi Hari Ini</div>
            </div>
        </div>

        <div class="sw-stat-card warning">
            <div class="sw-stat-icon warning">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $jumlahTugas ?? 0 }}</div>
                <div class="sw-stat-lbl">Tugas Dibuat</div>
            </div>
        </div>

        <div class="sw-stat-card danger">
            <div class="sw-stat-icon danger">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $jumlahUjian ?? 0 }}</div>
                <div class="sw-stat-lbl">Ujian</div>
            </div>
        </div>

    </div>

    {{-- ── ROW: QUICK ACTIONS + MAPEL INFO ── --}}
    <div class="sw-row-3">

        {{-- QUICK ACTIONS --}}
        <div class="sw-card">
            <div class="sw-card-hd">
                <div class="sw-card-hd-left">
                    <div class="sw-card-hd-icon primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <div>
                        <h6>Aksi Cepat</h6>
                        <p>Kelola aktivitas dengan mudah</p>
                    </div>
                </div>
            </div>
            <div class="sw-actions">
                <a href="{{ route('guru.absensi') }}" class="sw-action-btn success">
                    <div class="sw-action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="23 11 17 17 14 14"/></svg>
                    </div>
                    <div class="sw-action-text">
                        <strong>Input Absensi</strong>
                        <span>Catat kehadiran siswa hari ini</span>
                    </div>
                    <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="{{ route('guru.tugas.index') }}" class="sw-action-btn warning">
                    <div class="sw-action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div class="sw-action-text">
                        <strong>Kelola Tugas</strong>
                        <span>Buat dan pantau tugas siswa</span>
                    </div>
                    <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="{{ route('guru.ujian.index') }}" class="sw-action-btn danger">
                    <div class="sw-action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <div class="sw-action-text">
                        <strong>Kelola Ujian</strong>
                        <span>Buat soal dan jadwal ujian</span>
                    </div>
                    <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>

        {{-- INFO GURU --}}
        <div class="sw-card">
            <div class="sw-card-hd">
                <div class="sw-card-hd-left">
                    <div class="sw-card-hd-icon primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <h6>Info Saya</h6>
                        <p>Data profil guru</p>
                    </div>
                </div>
            </div>
            <div class="sw-card-bd">

                @if(auth()->user()->guru)
                <div class="sw-mapel-box" style="margin-bottom:16px;">
                    <div class="sw-mapel-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div>
                        <div class="sw-mapel-label">Mata Pelajaran</div>
                        <div class="sw-mapel-name">{{ auth()->user()->guru->mapel->nama_mapel ?? '-' }}</div>
                    </div>
                </div>
                @endif

                <div class="sw-info-list">
                    <div class="sw-info-row">
                        <div class="sw-info-row-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Role
                        </div>
                        <span class="sw-badge sw-badge-primary">Guru</span>
                    </div>
                    <div class="sw-info-row">
                        <div class="sw-info-row-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Status
                        </div>
                        <span class="sw-badge sw-badge-success">Aktif</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
function updateClock() {
    const now = new Date();
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const dateEl = document.getElementById('sw-date');
    const timeEl = document.getElementById('sw-time');
    if (dateEl) dateEl.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
    if (timeEl) timeEl.textContent = String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');
}
updateClock();
setInterval(updateClock, 1000);
</script>

@endsection