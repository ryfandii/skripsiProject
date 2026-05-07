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
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --info:          #0284C7;
    --info-light:    #F0F9FF;
    --warning:       #D97706;
    --warning-light: #FFFBEB;
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
.sw-topbar { display: flex; align-items: center; gap: 12px; margin-bottom: 26px; }
.sw-back-btn {
    width: 36px; height: 36px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-md); color: var(--text-mid);
    display: inline-flex; align-items: center; justify-content: center;
    text-decoration: none; transition: all .15s; flex-shrink: 0;
}
.sw-back-btn:hover { background: var(--primary-light); border-color: #C7D2FE; color: var(--primary); }
.sw-topbar-text h3 { font-size: 21px; font-weight: 800; color: var(--text-dark); margin: 0 0 2px; letter-spacing: -.3px; }
.sw-topbar-text p  { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── ALERTS ── */
.sw-alert {
    display: flex; align-items: flex-start; gap: 10px;
    border-radius: var(--radius-md); padding: 13px 16px;
    font-size: 13px; margin-bottom: 22px; font-weight: 500;
}
.sw-alert-success { background: var(--success-light); border: 1px solid #A7F3D0; color: var(--success); }
.sw-alert-danger  { background: var(--danger-light);  border: 1px solid #FECACA; color: var(--danger); }
.sw-alert svg { flex-shrink: 0; margin-top: 1px; }

/* ── CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    overflow: hidden;
    margin-bottom: 22px;
}
.sw-card-banner { height: 5px; }
.sw-card-banner.purple { background: linear-gradient(90deg, #4F46E5, #7C3AED); }
.sw-card-banner.green  { background: linear-gradient(90deg, #059669, #10B981); }

.sw-card-hd {
    display: flex; align-items: center; gap: 12px;
    padding: 18px 22px; border-bottom: 1px solid var(--border);
}
.sw-card-hd.purple { background: linear-gradient(135deg, #F5F3FF, #EEF2FF); }
.sw-card-hd.green  { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); }

.sw-card-hd-icon {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.sw-card-hd-icon.purple { background: var(--primary); box-shadow: 0 3px 10px rgba(79,70,229,.3); }
.sw-card-hd-icon.green  { background: var(--success);  box-shadow: 0 3px 10px rgba(5,150,105,.3); }
.sw-card-hd-icon.orange { background: var(--warning);  box-shadow: 0 3px 10px rgba(217,119,6,.3); }

.sw-card-hd h5 { font-size: 15px; font-weight: 700; margin: 0; }
.sw-card-hd h5.purple { color: #3730A3; }
.sw-card-hd h5.green  { color: #065F46; }
.sw-card-hd p  { font-size: 12px; margin: 2px 0 0; }
.sw-card-hd p.purple { color: #6D6AA4; }
.sw-card-hd p.green  { color: #047857; }

.sw-card-bd { padding: 24px 22px; }

/* ── SECTION DIVIDER ── */
.sw-section {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 18px;
}
.sw-section-label {
    font-size: 11.5px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .8px; white-space: nowrap;
}
.sw-section-label.purple { color: var(--primary); }
.sw-section-label.green  { color: var(--success); }
.sw-section-line {
    flex: 1; height: 1px;
}
.sw-section-line.purple { background: linear-gradient(to right, #C7D2FE, transparent); }
.sw-section-line.green  { background: linear-gradient(to right, #A7F3D0, transparent); }

/* ── FORM GRID ── */
.sw-form-row    { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px; }
.sw-form-row-2  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
.sw-form-group  { display: flex; flex-direction: column; gap: 6px; }
.sw-form-group.full { grid-column: 1 / -1; }

.sw-label { font-size: 12.5px; font-weight: 600; color: var(--text-mid); }
.sw-label span { color: var(--danger); margin-left: 2px; }

.sw-input, .sw-select, .sw-textarea {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: var(--neutral-light);
    outline: none; width: 100%;
    transition: border-color .15s, box-shadow .15s, background .15s;
}
.sw-input:focus, .sw-select:focus, .sw-textarea:focus {
    border-color: var(--primary); background: #fff;
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}
.sw-textarea { resize: vertical; min-height: 80px; }

/* ── SOAL CARD ── */
.soal-item {
    background: var(--surface);
    border: 1.5px solid #DDD6FE;
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: 16px;
    transition: box-shadow .2s;
}
.soal-item:hover { box-shadow: 0 4px 16px rgba(79,70,229,.08); }

.soal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 18px;
    background: linear-gradient(135deg, #F5F3FF, #EEF2FF);
    border-bottom: 1px solid #DDD6FE;
}
.soal-num {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: var(--primary);
}
.soal-num-badge {
    width: 26px; height: 26px; border-radius: 50%;
    background: var(--primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800;
}

.soal-body { padding: 18px; }

.sw-choices-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 10px; margin: 14px 0;
}
.sw-choice-wrap { position: relative; }
.sw-choice-label {
    position: absolute; left: 12px; top: 50%;
    transform: translateY(-50%);
    width: 22px; height: 22px; border-radius: 50%;
    background: var(--primary-light); color: var(--primary);
    font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    pointer-events: none; z-index: 1;
}
.sw-choice-input {
    width: 100%;
    padding: 9px 12px 9px 42px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: var(--neutral-light);
    outline: none; transition: all .15s;
}
.sw-choice-input:focus {
    border-color: var(--primary); background: #fff;
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}

.sw-answer-row {
    display: flex; align-items: center; gap: 12px;
    margin-top: 4px;
}
.sw-answer-label {
    font-size: 12px; font-weight: 700; color: var(--success);
    white-space: nowrap; display: flex; align-items: center; gap: 5px;
}
.sw-answer-select {
    flex: 1; padding: 9px 14px;
    border: 1.5px solid #A7F3D0;
    border-radius: var(--radius-md);
    background: var(--success-light);
    font-size: 13.5px; font-weight: 700; color: var(--success);
    font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none; transition: all .15s;
}
.sw-answer-select:focus { border-color: var(--success); box-shadow: 0 0 0 3px rgba(5,150,105,.1); }

/* ── ADD SOAL BUTTON ── */
.sw-add-soal {
    width: 100%; padding: 14px;
    border-radius: var(--radius-md);
    border: 2px dashed #C7D2FE;
    background: var(--primary-light);
    color: var(--primary); font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    margin-bottom: 8px;
}
.sw-add-soal:hover {
    background: var(--primary); color: #fff;
    border-color: var(--primary);
    transform: translateY(-1px);
}

/* ── FOOTER ── */
.sw-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 22px; border-top: 1px solid var(--border); margin-top: 8px;
}
.sw-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 11px 22px; border-radius: var(--radius-md);
    font-size: 14px; font-weight: 700; border: none;
    cursor: pointer; text-decoration: none;
    transition: all .18s ease; line-height: 1;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.sw-btn-secondary { background: var(--surface); color: var(--text-mid); border: 1.5px solid var(--border); }
.sw-btn-secondary:hover { background: var(--neutral-light); color: var(--text-dark); }
.sw-btn-success { background: var(--success); color: #fff; box-shadow: 0 4px 14px rgba(5,150,105,.3); }
.sw-btn-success:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(5,150,105,.35); }

@media (max-width: 900px) {
    .sw-page { padding: 14px; }
    .sw-form-row   { grid-template-columns: 1fr; }
    .sw-form-row-2 { grid-template-columns: 1fr; }
    .sw-choices-grid { grid-template-columns: 1fr; }
}
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <a href="{{ route('guru.ujian.index') }}" class="sw-back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <div class="sw-topbar-text">
            <h3>Buat Ujian</h3>
            <p>Isi data ujian dan tambahkan soal pilihan ganda</p>
        </div>
    </div>

    <form method="POST" action="{{ route('guru.ujian.store') }}">
        @csrf

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="sw-alert sw-alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="sw-alert sw-alert-danger">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $errors->first() }}
        </div>
        @endif

        {{-- ── CARD 1: PENGATURAN ── --}}
        <div class="sw-card">
            <div class="sw-card-banner purple"></div>
            <div class="sw-card-hd purple">
                <div class="sw-card-hd-icon orange">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                </div>
                <div>
                    <h5 class="purple">Pengaturan Ujian</h5>
                    <p class="purple">Pilih kelas, mapel, dan jenis ujian</p>
                </div>
            </div>
            <div class="sw-card-bd">
                <div class="sw-section">
                    <span class="sw-section-label purple">Klasifikasi</span>
                    <div class="sw-section-line purple"></div>
                </div>
                <div class="sw-form-row">
                    <!-- <div class="sw-form-group">
                        <label class="sw-label">Kelas <span>*</span></label>
                        <select name="kelas_id" class="sw-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="sw-form-group">
                        <label class="sw-label">Kelas <span>*</span></label>
                        <div style="background:var(--neutral-light);border:1.5px solid var(--border);border-radius:var(--radius-md);padding:12px 14px;display:flex;flex-wrap:wrap;gap:10px;">
                            @foreach($kelas as $k)
                            <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;font-weight:600;color:var(--text-mid);background:#fff;border:1.5px solid var(--border);border-radius:8px;padding:6px 12px;transition:all .15s;"
                                onmouseover="this.style.borderColor='#6366f1'" onmouseout="this.style.borderColor=''">
                                <input type="checkbox" name="kelas_ids[]" value="{{ $k->id }}"
                                    style="accent-color:var(--primary);width:15px;height:15px;">
                                {{ $k->nama_kelas }}
                            </label>
                            @endforeach
                        </div>
                        <div style="font-size:11.5px;color:var(--text-soft);margin-top:4px;">
                            ✓ Centang semua kelas yang akan menerima ujian ini
                        </div>
                    </div>
                    <div class="sw-form-group">
                        <label class="sw-label">Jenis Ujian <span>*</span></label>
                        <select name="jenis" class="sw-select" required>
                            <option value="UTS">UTS</option>
                            <option value="UAS">UAS</option>
                        </select>
                    </div>

                    <div class="sw-form-group">
                        <label class="sw-label">Mapel</label>
                        <input type="hidden" name="mapel_id" value="{{ auth()->user()->guru->mapel_id }}">
                        <input type="text" class="sw-input" 
                            value="{{ auth()->user()->guru->mapel->nama_mapel ?? '-' }}" 
                            disabled>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── CARD 2: DATA UJIAN ── --}}
        <div class="sw-card">
            <div class="sw-card-banner purple"></div>
            <div class="sw-card-hd purple">
                <div class="sw-card-hd-icon purple">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                    <h5 class="purple">Data Ujian</h5>
                    <p class="purple">Judul, durasi, dan jadwal ujian</p>
                </div>
            </div>
            <div class="sw-card-bd">
                <div class="sw-section">
                    <span class="sw-section-label purple">Informasi Umum</span>
                    <div class="sw-section-line purple"></div>
                </div>
                <div class="sw-form-row-2" style="margin-bottom:16px;">
                    <div class="sw-form-group">
                        <label class="sw-label">Judul <span>*</span></label>
                        <input type="text" name="judul" class="sw-input" placeholder="Judul ujian" required>
                    </div>
                    <div class="sw-form-group">
                        <label class="sw-label">Durasi (menit)</label>
                        <input type="number" name="durasi" class="sw-input" placeholder="Contoh: 90">
                    </div>
                </div>

                <div class="sw-section" style="margin-top:4px;">
                    <span class="sw-section-label purple">Jadwal</span>
                    <div class="sw-section-line purple"></div>
                </div>
                <div class="sw-form-row-2">
                    <div class="sw-form-group">
                        <label class="sw-label">Waktu Mulai</label>
                        <input type="datetime-local" name="mulai" class="sw-input">
                    </div>
                    <div class="sw-form-group">
                        <label class="sw-label">Waktu Selesai</label>
                        <input type="datetime-local" name="selesai" class="sw-input">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── CARD 3: SOAL ── --}}
        <div class="sw-card">
            <div class="sw-card-banner green"></div>
            <div class="sw-card-hd green">
                <div class="sw-card-hd-icon green">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div>
                    <h5 class="green">Soal Ujian</h5>
                    <p class="green">Tambahkan soal pilihan ganda</p>
                </div>
            </div>
            <div class="sw-card-bd">

                <div id="soal-container">

                    {{-- SOAL PERTAMA --}}
                    <div class="soal-item">
                        <div class="soal-header">
                            <div class="soal-num">
                                <div class="soal-num-badge">1</div>
                                Soal Nomor 1
                            </div>
                        </div>
                        <div class="soal-body">
                            <div class="sw-form-group">
                                <label class="sw-label">Pertanyaan <span>*</span></label>
                                <textarea name="soal[0][pertanyaan]" class="sw-textarea" placeholder="Tulis pertanyaan di sini..." required></textarea>
                            </div>

                            <div class="sw-choices-grid">
                                <div class="sw-choice-wrap">
                                    <div class="sw-choice-label">A</div>
                                    <input name="soal[0][a]" class="sw-choice-input" placeholder="Pilihan A">
                                </div>
                                <div class="sw-choice-wrap">
                                    <div class="sw-choice-label">B</div>
                                    <input name="soal[0][b]" class="sw-choice-input" placeholder="Pilihan B">
                                </div>
                                <div class="sw-choice-wrap">
                                    <div class="sw-choice-label">C</div>
                                    <input name="soal[0][c]" class="sw-choice-input" placeholder="Pilihan C">
                                </div>
                                <div class="sw-choice-wrap">
                                    <div class="sw-choice-label">D</div>
                                    <input name="soal[0][d]" class="sw-choice-input" placeholder="Pilihan D">
                                </div>
                            </div>

                            <div class="sw-answer-row">
                                <div class="sw-answer-label">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><polyline points="20 6 9 17 4 12"/></svg>
                                    Kunci Jawaban
                                </div>
                                <select name="soal[0][jawaban]" class="sw-answer-select">
                                    <option value="a">Jawaban A</option>
                                    <option value="b">Jawaban B</option>
                                    <option value="c">Jawaban C</option>
                                    <option value="d">Jawaban D</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="button" class="sw-add-soal" onclick="tambahSoal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Soal
                </button>

                <div class="sw-footer">
                    <a href="{{ route('guru.ujian.index') }}" class="sw-btn sw-btn-secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                    <button type="submit" class="sw-btn sw-btn-success">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Ujian + Soal
                    </button>
                </div>

            </div>
        </div>

    </form>
</div>

<script>
let index = 1;

function tambahSoal() {
    const html = `
    <div class="soal-item">
        <div class="soal-header">
            <div class="soal-num">
                <div class="soal-num-badge">${index + 1}</div>
                Soal Nomor ${index + 1}
            </div>
        </div>
        <div class="soal-body">
            <div class="sw-form-group">
                <label class="sw-label">Pertanyaan</label>
                <textarea name="soal[${index}][pertanyaan]" class="sw-textarea" placeholder="Tulis pertanyaan di sini..."></textarea>
            </div>
            <div class="sw-choices-grid">
                <div class="sw-choice-wrap">
                    <div class="sw-choice-label">A</div>
                    <input name="soal[${index}][a]" class="sw-choice-input" placeholder="Pilihan A">
                </div>
                <div class="sw-choice-wrap">
                    <div class="sw-choice-label">B</div>
                    <input name="soal[${index}][b]" class="sw-choice-input" placeholder="Pilihan B">
                </div>
                <div class="sw-choice-wrap">
                    <div class="sw-choice-label">C</div>
                    <input name="soal[${index}][c]" class="sw-choice-input" placeholder="Pilihan C">
                </div>
                <div class="sw-choice-wrap">
                    <div class="sw-choice-label">D</div>
                    <input name="soal[${index}][d]" class="sw-choice-input" placeholder="Pilihan D">
                </div>
            </div>
            <div class="sw-answer-row">
                <div class="sw-answer-label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><polyline points="20 6 9 17 4 12"/></svg>
                    Kunci Jawaban
                </div>
                <select name="soal[${index}][jawaban]" class="sw-answer-select">
                    <option value="a">Jawaban A</option>
                    <option value="b">Jawaban B</option>
                    <option value="c">Jawaban C</option>
                    <option value="d">Jawaban D</option>
                </select>
            </div>
        </div>
    </div>`;

    document.getElementById('soal-container').insertAdjacentHTML('beforeend', html);
    index++;
}
</script>

@endsection