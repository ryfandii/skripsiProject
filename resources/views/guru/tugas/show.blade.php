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
    --neutral-light: #F9FAFB;
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

/* ── TOPBAR ── */
.sw-topbar { margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }
.sw-back-btn {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-md); color: var(--text-mid);
    text-decoration: none; transition: all .15s; flex-shrink: 0;
}
.sw-back-btn:hover { background: var(--primary-light); border-color: #C7D2FE; color: var(--primary); }
.sw-topbar-text h3 { font-size: 21px; font-weight: 800; color: var(--text-dark); margin: 0 0 2px; letter-spacing: -.3px; }
.sw-topbar-text p  { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── LAYOUT ── */
.sw-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 22px;
    align-items: start;
}

/* ── CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    overflow: hidden;
}

/* ── BANNER ── */
.sw-card-banner {
    height: 6px;
    background: linear-gradient(90deg, #4F46E5, #7C3AED, #059669);
}

/* ── CARD HEADER ── */
.sw-card-hd {
    padding: 22px 26px 18px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
}
.sw-card-hd-top {
    display: flex; align-items: flex-start; gap: 14px;
    margin-bottom: 14px;
}
.sw-card-hd-icon {
    width: 50px; height: 50px; border-radius: 13px;
    background: var(--primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: 0 4px 12px rgba(79,70,229,.3);
}
.sw-card-hd-title {
    font-size: 20px; font-weight: 800;
    color: var(--text-dark); margin: 0 0 8px;
    letter-spacing: -.3px; line-height: 1.3;
}
.sw-chip-row { display: flex; gap: 7px; flex-wrap: wrap; }
.sw-chip {
    display: inline-flex; align-items: center; gap: 5px;
    border-radius: 99px; padding: 4px 12px;
    font-size: 12px; font-weight: 600;
}
.sw-chip-primary { background: var(--primary-light); border: 1px solid #C7D2FE; color: var(--primary); }
.sw-chip-info    { background: var(--info-light);    border: 1px solid #BAE6FD; color: var(--info); }

/* ── CARD BODY ── */
.sw-card-bd { padding: 26px; }

/* ── SECTION ── */
.sw-section {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
.sw-section-label {
    font-size: 11.5px; font-weight: 700; color: var(--primary);
    text-transform: uppercase; letter-spacing: .8px; white-space: nowrap;
}
.sw-section-line {
    flex: 1; height: 1px;
    background: linear-gradient(to right, #C7D2FE, transparent);
}

/* ── INFO LIST ── */
.sw-info-list { display: flex; flex-direction: column; gap: 0; margin-bottom: 26px; }
.sw-info-row {
    display: flex; align-items: flex-start;
    padding: 13px 0; border-bottom: 1px solid var(--border);
    gap: 16px;
}
.sw-info-row:last-child { border-bottom: none; }
.sw-info-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 12.5px; font-weight: 600; color: var(--text-soft);
    min-width: 110px; flex-shrink: 0; padding-top: 1px;
}
.sw-info-label svg { color: var(--primary); flex-shrink: 0; }
.sw-info-val { font-size: 14px; font-weight: 600; color: var(--text-dark); flex: 1; }

/* ── DESCRIPTION BOX ── */
.sw-desc-box {
    background: var(--neutral-light);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 16px 18px;
    font-size: 14px; color: var(--text-mid);
    line-height: 1.7; margin-top: 4px;
}

/* ── DEADLINE CARD ── */
.sw-deadline-box {
    background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
    border: 1px solid #FDE68A;
    border-radius: var(--radius-md);
    padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
}
.sw-deadline-icon {
    width: 44px; height: 44px; border-radius: 11px;
    background: var(--warning); color: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: 0 3px 10px rgba(217,119,6,.3);
}
.sw-deadline-label { font-size: 11.5px; font-weight: 600; color: #92400E; text-transform: uppercase; letter-spacing: .5px; }
.sw-deadline-val   { font-size: 16px; font-weight: 800; color: #78350F; margin-top: 3px; }

/* ── SIDEBAR ── */
.sw-sidebar-card { padding: 20px; }
.sw-sidebar-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: var(--text-dark);
    margin-bottom: 16px;
}
.sw-sidebar-title svg { color: var(--primary); }

/* stat mini */
.sw-mini-stats { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
.sw-mini-stat {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 14px;
    background: var(--neutral-light); border: 1px solid var(--border);
    border-radius: var(--radius-md);
}
.sw-mini-stat-left { display: flex; align-items: center; gap: 9px; font-size: 13px; font-weight: 600; color: var(--text-mid); }
.sw-mini-stat-left svg { color: var(--text-soft); }
.sw-mini-stat-val { font-size: 15px; font-weight: 800; color: var(--text-dark); }

/* divider */
.sw-divider { height: 1px; background: var(--border); margin: 16px 0; }

/* action buttons */
.sw-actions { display: flex; flex-direction: column; gap: 8px; }
.sw-action-link {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 14px; border-radius: var(--radius-md);
    text-decoration: none; font-size: 13.5px; font-weight: 600;
    transition: all .18s; border: 1px solid transparent;
}
.sw-action-link.primary { background: var(--primary-light); border-color: #C7D2FE; color: var(--primary); }
.sw-action-link.primary:hover { background: var(--primary); color: #fff; }
.sw-action-link.secondary { background: var(--neutral-light); border-color: var(--border); color: var(--text-mid); }
.sw-action-link.secondary:hover { background: var(--surface); color: var(--text-dark); }
.sw-action-link svg { flex-shrink: 0; }
.sw-action-link svg.arrow { margin-left: auto; opacity: .45; }

@media (max-width: 900px) {
    .sw-layout { grid-template-columns: 1fr; }
    .sw-page { padding: 16px; }
    .sw-card-bd, .sw-card-hd { padding: 18px; }
}
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <a href="{{ route('guru.tugas.index') }}" class="sw-back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <div class="sw-topbar-text">
            <h3>Detail Tugas</h3>
            <p>Informasi lengkap tugas yang diberikan</p>
        </div>
    </div>

    <div class="sw-layout">

        {{-- ── MAIN CARD ── --}}
        <div class="sw-card">
            <div class="sw-card-banner"></div>

            <div class="sw-card-hd">
                <div class="sw-card-hd-top">
                    <div class="sw-card-hd-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div>
                        <div class="sw-card-hd-title">{{ $tugas->judul }}</div>
                        <div class="sw-chip-row">
                            <span class="sw-chip sw-chip-primary">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                {{ $tugas->kelas->nama_kelas }}
                            </span>
                            <span class="sw-chip sw-chip-info">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                {{ $tugas->mapel->nama_mapel }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sw-card-bd">

                {{-- INFO ROWS --}}
                <div class="sw-section">
                    <span class="sw-section-label">Informasi Tugas</span>
                    <div class="sw-section-line"></div>
                </div>

                <div class="sw-info-list">
                    <div class="sw-info-row">
                        <div class="sw-info-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            Judul
                        </div>
                        <div class="sw-info-val">{{ $tugas->judul }}</div>
                    </div>
                    <div class="sw-info-row">
                        <div class="sw-info-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            Kelas
                        </div>
                        <div class="sw-info-val">{{ $tugas->kelas->nama_kelas }}</div>
                    </div>
                    <div class="sw-info-row">
                        <div class="sw-info-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            Mapel
                        </div>
                        <div class="sw-info-val">{{ $tugas->mapel->nama_mapel }}</div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="sw-section" style="margin-top:4px;">
                    <span class="sw-section-label">Deskripsi</span>
                    <div class="sw-section-line"></div>
                </div>
                <div class="sw-desc-box">
                    {{ $tugas->deskripsi ?: 'Tidak ada deskripsi.' }}
                </div>

                {{-- DEADLINE --}}
                <div class="sw-section" style="margin-top:24px;">
                    <span class="sw-section-label">Batas Waktu</span>
                    <div class="sw-section-line"></div>
                </div>
                <div class="sw-deadline-box">
                    <div class="sw-deadline-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <div class="sw-deadline-label">Deadline Pengumpulan</div>
                        <div class="sw-deadline-val">{{ $tugas->deadline }}</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── SIDEBAR ── --}}
        <div>
            <div class="sw-card sw-sidebar-card">
                <div class="sw-sidebar-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Aksi
                </div>

                <div class="sw-actions">
                    <a href="{{ route('guru.tugas.index') }}" class="sw-action-link secondary">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali ke Daftar
                        <svg class="arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>

                <div class="sw-divider"></div>

                <div class="sw-sidebar-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Ringkasan
                </div>

                <div class="sw-mini-stats">
                    <div class="sw-mini-stat">
                        <div class="sw-mini-stat-left">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            Kelas
                        </div>
                        <div class="sw-mini-stat-val">{{ $tugas->kelas->nama_kelas }}</div>
                    </div>
                    <div class="sw-mini-stat">
                        <div class="sw-mini-stat-left">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            Mapel
                        </div>
                        <div class="sw-mini-stat-val" style="font-size:13px;">{{ $tugas->mapel->nama_mapel }}</div>
                    </div>
                    <div class="sw-mini-stat">
                        <div class="sw-mini-stat-left">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Deadline
                        </div>
                        <div class="sw-mini-stat-val" style="font-size:12.5px;">{{ $tugas->deadline }}</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection