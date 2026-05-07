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

.sw-page {
    padding: 28px 32px;
    background: var(--bg);
    min-height: 100vh;
}

/* ── TOPBAR ── */
.sw-topbar { margin-bottom: 28px; }
.sw-topbar h3 { font-size: 21px; font-weight: 800; color: var(--text-dark); margin: 0 0 4px; letter-spacing: -.3px; }
.sw-topbar p  { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── LAYOUT ── */
.sw-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 24px;
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

/* ── CARD HEADER ── */
.sw-card-banner {
    height: 8px;
    background: linear-gradient(90deg, #4F46E5, #7C3AED, #059669);
}
.sw-card-hd {
    padding: 24px 28px 20px;
    border-bottom: 1px solid var(--border);
}
.sw-card-hd-top {
    display: flex; align-items: flex-start; gap: 14px;
    margin-bottom: 14px;
}
.sw-card-hd-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: var(--primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(79,70,229,.3);
}
.sw-card-hd-title {
    font-size: 19px; font-weight: 800;
    color: var(--text-dark); margin: 0 0 5px;
    letter-spacing: -.3px; line-height: 1.3;
}
.sw-card-hd-mapel {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--primary-light); border: 1px solid #C7D2FE;
    border-radius: 99px; padding: 4px 12px;
    font-size: 12px; font-weight: 600; color: var(--primary);
}

/* meta row */
.sw-meta-row {
    display: flex; gap: 8px; flex-wrap: wrap;
}
.sw-meta-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--neutral-light); border: 1px solid var(--border);
    border-radius: 8px; padding: 5px 12px;
    font-size: 12px; font-weight: 600; color: var(--text-mid);
}
.sw-meta-chip svg { color: var(--text-soft); }

/* ── CARD BODY ── */
.sw-card-bd { padding: 28px; }

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

/* ── UPLOAD ZONE ── */
.sw-upload-zone {
    border: 2px dashed #C7D2FE;
    border-radius: var(--radius-lg);
    padding: 40px 28px;
    text-align: center;
    background: var(--primary-light);
    cursor: pointer;
    transition: all .2s;
    position: relative;
    margin-bottom: 16px;
}
.sw-upload-zone:hover, .sw-upload-zone.dragover {
    border-color: var(--primary);
    background: #E0E7FF;
}
.sw-upload-zone input[type="file"] {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
    width: 100%; height: 100%;
}
.sw-upload-icon {
    width: 64px; height: 64px;
    background: var(--surface);
    border: 1.5px solid #C7D2FE;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    color: var(--primary);
    box-shadow: 0 2px 8px rgba(79,70,229,.1);
}
.sw-upload-title { font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }
.sw-upload-sub   { font-size: 13px; color: var(--text-soft); margin-bottom: 14px; }
.sw-upload-formats {
    display: flex; justify-content: center; flex-wrap: wrap; gap: 6px;
}
.sw-format-chip {
    background: var(--surface); border: 1px solid #C7D2FE;
    border-radius: 6px; padding: 3px 10px;
    font-size: 11px; font-weight: 700; color: var(--primary);
}

/* ── FILE SELECTED STATE ── */
.sw-file-selected {
    display: none;
    align-items: center; gap: 14px;
    background: var(--success-light);
    border: 1.5px solid #A7F3D0;
    border-radius: var(--radius-md);
    padding: 14px 18px;
    margin-bottom: 16px;
}
.sw-file-selected.show { display: flex; }
.sw-file-icon {
    width: 42px; height: 42px; border-radius: 10px;
    background: var(--success); color: #fff;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.sw-file-name { font-size: 13.5px; font-weight: 700; color: var(--success); word-break: break-all; }
.sw-file-size { font-size: 12px; color: #065F46; margin-top: 2px; }

/* ── SUBMIT BUTTON ── */
.sw-btn-submit {
    width: 100%; padding: 15px;
    border-radius: var(--radius-md); border: none;
    background: linear-gradient(135deg, var(--primary), #7C3AED);
    color: #fff; font-size: 15px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .2s;
    box-shadow: 0 4px 16px rgba(79,70,229,.35);
    display: flex; align-items: center; justify-content: center; gap: 9px;
}
.sw-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,.4); }

/* ── SIDEBAR CARD ── */
.sw-sidebar { display: flex; flex-direction: column; gap: 16px; }

.sw-info-card { padding: 20px; }
.sw-info-card-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: var(--text-dark);
    margin-bottom: 14px;
}
.sw-info-card-title svg { color: var(--primary); }

.sw-tip-list { display: flex; flex-direction: column; gap: 10px; }
.sw-tip {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 12.5px; color: var(--text-mid); line-height: 1.5;
}
.sw-tip-dot {
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--primary-light);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
    font-size: 10px; font-weight: 800; color: var(--primary);
}

/* warning box */
.sw-warn-box {
    background: var(--warning-light);
    border: 1px solid #FDE68A;
    border-radius: var(--radius-md);
    padding: 14px 16px;
    display: flex; gap: 10px; align-items: flex-start;
    font-size: 12.5px; color: var(--warning); line-height: 1.6;
}
.sw-warn-box svg { flex-shrink: 0; margin-top: 1px; }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
    .sw-layout { grid-template-columns: 1fr; }
    .sw-page { padding: 16px; }
    .sw-card-bd { padding: 20px; }
    .sw-card-hd { padding: 18px 20px 16px; }
    .sw-upload-zone { padding: 28px 16px; }
}
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <h3>Kumpulkan Tugas</h3>
        <p>Upload jawaban tugas Anda sebelum batas waktu</p>
    </div>

    <div class="sw-layout">

        {{-- ── MAIN CARD ── --}}
        <div class="sw-card">
            <div class="sw-card-banner"></div>

            <div class="sw-card-hd">
                <div class="sw-card-hd-top">
                    <div class="sw-card-hd-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div>
                        <div class="sw-card-hd-title">{{ $tugas->judul }}</div>
                        <div class="sw-card-hd-mapel">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            {{ $tugas->mapel->nama_mapel ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="sw-meta-row">
                    <div class="sw-meta-chip">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Tugas
                    </div>
                    <div class="sw-meta-chip">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload File
                    </div>
                </div>
            </div>

            <div class="sw-card-bd">
                <form action="{{ route('siswa.tugas.store', $tugas->id) }}" method="POST" enctype="multipart/form-data" id="sw-form">
                    @csrf

                    <div class="sw-section">
                        <span class="sw-section-label">Upload Jawaban</span>
                        <div class="sw-section-line"></div>
                    </div>

                    {{-- File selected preview --}}
                    <div class="sw-file-selected" id="sw-file-preview">
                        <div class="sw-file-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <div>
                            <div class="sw-file-name" id="sw-file-name">-</div>
                            <div class="sw-file-size" id="sw-file-size">-</div>
                        </div>
                    </div>

                    {{-- Upload Zone --}}
                    <div class="sw-upload-zone" id="sw-upload-zone">
                        <input type="file" name="file" required id="sw-file-input">
                        <div class="sw-upload-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div class="sw-upload-title">Klik untuk pilih file</div>
                        <div class="sw-upload-sub">atau seret & lepas file jawaban ke sini</div>
                        <div class="sw-upload-formats">
                            <span class="sw-format-chip">PDF</span>
                            <span class="sw-format-chip">DOC</span>
                            <span class="sw-format-chip">DOCX</span>
                            <span class="sw-format-chip">JPG</span>
                            <span class="sw-format-chip">PNG</span>
                            <span class="sw-format-chip">ZIP</span>
                        </div>
                    </div>

                    <button type="submit" class="sw-btn-submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload Tugas Sekarang
                    </button>

                </form>
            </div>
        </div>

        {{-- ── SIDEBAR ── --}}
        <div class="sw-sidebar">

            {{-- Tips --}}
            <div class="sw-card sw-info-card">
                <div class="sw-info-card-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    Panduan Upload
                </div>
                <div class="sw-tip-list">
                    <div class="sw-tip">
                        <div class="sw-tip-dot">1</div>
                        Pastikan file jawaban sudah lengkap sebelum diupload
                    </div>
                    <div class="sw-tip">
                        <div class="sw-tip-dot">2</div>
                        Gunakan format PDF untuk hasil terbaik
                    </div>
                    <div class="sw-tip">
                        <div class="sw-tip-dot">3</div>
                        Beri nama file dengan nama lengkap Anda
                    </div>
                    <div class="sw-tip">
                        <div class="sw-tip-dot">4</div>
                        Pastikan koneksi internet stabil saat upload
                    </div>
                </div>
            </div>

            {{-- Warning --}}
            <div class="sw-warn-box">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <div>
                    <strong>Perhatian!</strong><br>
                    Tugas yang sudah dikumpulkan tidak dapat diubah. Pastikan file sudah benar sebelum submit.
                </div>
            </div>

        </div>

    </div>
</div>

<script>
const fileInput  = document.getElementById('sw-file-input');
const preview    = document.getElementById('sw-file-preview');
const nameEl     = document.getElementById('sw-file-name');
const sizeEl     = document.getElementById('sw-file-size');
const zone       = document.getElementById('sw-upload-zone');

fileInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        nameEl.textContent = file.name;
        sizeEl.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        preview.classList.add('show');
    }
});

// Drag & drop visual
zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('dragover'); });
zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
zone.addEventListener('drop',      e => { e.preventDefault(); zone.classList.remove('dragover'); });
</script>

@endsection