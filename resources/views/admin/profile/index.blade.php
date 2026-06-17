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

/* ── PAGE ── */
.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

/* ── TOPBAR ── */
.sw-topbar { margin-bottom: 24px; }
.sw-topbar h3 { font-size: 21px; font-weight: 800; color: var(--text-dark); margin: 0 0 4px; letter-spacing: -.3px; }
.sw-topbar p  { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── ALERT ── */
.sw-alert-success {
    display: flex; align-items: center; gap: 9px;
    background: var(--success-light); border: 1px solid #A7F3D0;
    border-radius: var(--radius-md); padding: 13px 16px;
    font-size: 13px; color: var(--success); margin-bottom: 24px; font-weight: 500;
}

/* ── GRID ── */
.sw-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 24px;
    align-items: start;
}

/* ── CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    overflow: hidden;
}

/* ── AVATAR CARD ── */
.avatar-banner {
    height: 90px;
    background: linear-gradient(135deg, #1E3A6E 0%, #4F46E5 60%, #7C3AED 100%);
}
.avatar-body { padding: 0 24px 28px; text-align: center; }
.avatar-wrap {
    position: relative;
    display: inline-block;
    margin-top: -50px;
    margin-bottom: 14px;
}
.avatar-img {
    width: 100px; height: 100px;
    border-radius: 50%; object-fit: cover;
    border: 4px solid var(--surface); display: block;
}
.avatar-online {
    position: absolute; bottom: 6px; right: 6px;
    width: 14px; height: 14px;
    background: var(--success); border: 2px solid var(--surface); border-radius: 50%;
}
.avatar-name { font-size: 17px; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; }
.avatar-role {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--primary-light); border: 1px solid #C7D2FE;
    border-radius: 99px; padding: 4px 12px;
    font-size: 11.5px; font-weight: 700; color: var(--primary); margin-bottom: 20px;
}
.avatar-role span { width: 6px; height: 6px; background: var(--primary); border-radius: 50%; }

.avatar-stats {
    display: flex;
    border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden;
}
.avatar-stat { flex: 1; padding: 12px 8px; text-align: center; border-right: 1px solid var(--border); }
.avatar-stat:last-child { border-right: none; }
.avatar-stat-val { display: flex; justify-content: center; margin-bottom: 4px; }
.avatar-stat-lbl { font-size: 10.5px; color: var(--text-soft); font-weight: 600; }

/* ── INFO LIST (siswa) ── */
.avatar-info-list { margin-top: 18px; display: flex; flex-direction: column; gap: 10px; text-align: left; }
.avatar-info-item {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 12px;
    background: #F9FAFB; border: 1px solid var(--border); border-radius: var(--radius-md);
}
.avatar-info-item svg { color: var(--primary); flex-shrink: 0; margin-top: 1px; }
.avatar-info-item .lbl { font-size: 10.5px; font-weight: 700; color: var(--text-soft); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
.avatar-info-item .val { font-size: 13px; font-weight: 600; color: var(--text-dark); }

/* ── CARD HEADER ── */
.sw-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: 20px 24px; border-bottom: 1px solid var(--border);
    background: #F5F3FF;
}
.sw-card-header-icon {
    width: 38px; height: 38px;
    background: var(--primary); border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.sw-card-header h5 { font-size: 15px; font-weight: 700; color: #3730A3; margin: 0; }
.sw-card-header p  { font-size: 12.5px; color: #6D6AA4; margin: 2px 0 0; }

.sw-card-body { padding: 28px 24px; }

/* ── SECTION DIVIDER ── */
.sw-section { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
.sw-section-label { font-size: 11.5px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: .8px; white-space: nowrap; }
.sw-section-line   { flex: 1; height: 1px; background: linear-gradient(to right, #C7D2FE, transparent); }

/* ── FORM ── */
.sw-row          { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.sw-form-group   { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.sw-label        { font-size: 12.5px; font-weight: 600; color: var(--text-mid); }
.sw-input-note   { font-size: 11px; color: var(--text-soft); }

.sw-input-wrap { position: relative; }
.sw-input-wrap svg {
    position: absolute; left: 14px; top: 50%;
    transform: translateY(-50%); color: #9CA3AF; pointer-events: none;
}
.sw-input {
    width: 100%; padding: 11px 14px 11px 42px;
    border: 1.5px solid var(--border); border-radius: var(--radius-md);
    font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: #F9FAFB;
    outline: none; transition: all .15s;
}
.sw-input:focus  { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }
.sw-input[readonly] { background: #F3F4F8; color: var(--text-soft); cursor: not-allowed; }

.sw-textarea {
    width: 100%; padding: 11px 14px;
    border: 1.5px solid var(--border); border-radius: var(--radius-md);
    font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: #F9FAFB;
    outline: none; resize: vertical; min-height: 80px; transition: all .15s;
}
.sw-textarea:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

/* ── PHOTO ── */
.sw-photo-preview {
    display: flex; align-items: center; gap: 14px;
    background: #F9FAFB; border: 1px solid var(--border);
    border-radius: var(--radius-md); padding: 14px 16px; margin-bottom: 12px;
}
.sw-photo-preview img { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; border: 2px solid #C7D2FE; }
.sw-photo-preview-info .title { font-size: 13px; font-weight: 700; color: var(--text-dark); }
.sw-photo-preview-info .sub   { font-size: 11.5px; color: var(--text-soft); margin-top: 2px; }

.sw-upload-zone {
    border: 2px dashed var(--border); border-radius: var(--radius-md);
    padding: 24px 20px; text-align: center;
    background: #F9FAFB; cursor: pointer; transition: all .2s; position: relative;
}
.sw-upload-zone:hover { border-color: var(--primary); background: var(--primary-light); }
.sw-upload-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
.sw-upload-icon {
    width: 44px; height: 44px;
    background: var(--primary-light); border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; color: var(--primary);
}
.sw-upload-title { font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
.sw-upload-sub   { font-size: 12px; color: var(--text-soft); }
.sw-upload-badge {
    display: inline-block; margin-top: 10px;
    background: var(--primary-light); border: 1px solid #C7D2FE;
    border-radius: 99px; padding: 3px 10px;
    font-size: 11px; font-weight: 600; color: var(--primary);
}

/* ── FOOTER ── */
.sw-footer {
    display: flex; justify-content: flex-end;
    padding-top: 24px; border-top: 1px solid var(--border); margin-top: 8px;
}
.sw-btn-primary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 11px 22px; border-radius: var(--radius-md);
    font-size: 14px; font-weight: 700; border: none; cursor: pointer;
    background: var(--primary); color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif; transition: all .18s;
}
.sw-btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); }

@media (max-width: 900px) {
    .sw-grid { grid-template-columns: 1fr; }
    .sw-page { padding: 16px; }
    .sw-row  { grid-template-columns: 1fr; }
}
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <h3>Profile Saya</h3>
        <p>Kelola informasi dan foto profil akun Anda</p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="sw-alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="sw-grid">

        {{-- KIRI: AVATAR CARD --}}
        <div class="sw-card">
            <div class="avatar-banner"></div>
            <div class="avatar-body">

                <div class="avatar-wrap">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('uploads/' . auth()->user()->photo) }}" class="avatar-img" alt="Foto Profil">
                    @else
                        <img src="{{ asset('sbadmin2/img/undraw_profile.svg') }}" class="avatar-img" alt="Foto Profil">
                    @endif
                    <div class="avatar-online"></div>
                </div>

                <div class="avatar-name">{{ auth()->user()->name }}</div>
                <div class="avatar-role">
                    <span></span>
                    @if(auth()->user()->role == 'siswa') Siswa
                    @elseif(auth()->user()->role == 'guru') Guru
                    @else Administrator
                    @endif
                </div>

                <div class="avatar-stats">
                    <div class="avatar-stat">
                        <div class="avatar-stat-val">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#4F46E5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="avatar-stat-lbl">Profil</div>
                    </div>
                    <div class="avatar-stat">
                        <div class="avatar-stat-val">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#059669"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <div class="avatar-stat-lbl">Aman</div>
                    </div>
                    <div class="avatar-stat">
                        <div class="avatar-stat-val">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#D97706"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div class="avatar-stat-lbl">Aktif</div>
                    </div>
                </div>

                {{-- Info ringkas khusus siswa --}}
                @if(auth()->user()->role == 'siswa' && auth()->user()->siswa)
                @php $siswa = auth()->user()->siswa; @endphp
                <div class="avatar-info-list">
                    <div class="avatar-info-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8L2 7h20l-6-4z"/></svg>
                        <div><div class="lbl">NIS</div><div class="val">{{ $siswa->nis }}</div></div>
                    </div>
                    <div class="avatar-info-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <div><div class="lbl">Kelas</div><div class="val">{{ $siswa->kelas->nama_kelas ?? '-' }}</div></div>
                    </div>
                    <div class="avatar-info-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <div><div class="lbl">Orang Tua</div><div class="val">{{ $siswa->nama_ortu }}</div></div>
                    </div>
                    <div class="avatar-info-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.06 6.06l.94-.93a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <div><div class="lbl">Telepon</div><div class="val">{{ $siswa->telepon }}</div></div>
                    </div>
                    <div class="avatar-info-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <div><div class="lbl">Alamat</div><div class="val">{{ $siswa->alamat }}</div></div>
                    </div>
                </div>
                @endif

            </div>
        </div>

        {{-- KANAN: FORM CARD --}}
        <div class="sw-card">

            <div class="sw-card-header">
                <div class="sw-card-header-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <h5>Edit Profil</h5>
                    <p>Perbarui nama dan foto profil Anda</p>
                </div>
            </div>

            <div class="sw-card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Informasi Akun --}}
                    <div class="sw-section">
                        <span class="sw-section-label">Informasi Akun</span>
                        <div class="sw-section-line"></div>
                    </div>

                    <div class="sw-form-group">
                        <label class="sw-label">Nama Lengkap</label>
                        <div class="sw-input-wrap">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <input type="text" name="name" class="sw-input" value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>

                    {{-- Data Diri (khusus siswa) --}}
                    @if(auth()->user()->role == 'siswa' && auth()->user()->siswa)
                    @php $siswa = auth()->user()->siswa; @endphp

                    <div class="sw-section" style="margin-top: 8px;">
                        <span class="sw-section-label">Data Diri</span>
                        <div class="sw-section-line"></div>
                    </div>

                    <div class="sw-row">
                        <div class="sw-form-group">
                            <label class="sw-label">NIS</label>
                            <div class="sw-input-wrap">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3H8L2 7h20l-6-4z"/></svg>
                                <input type="text" class="sw-input" value="{{ $siswa->nis }}" readonly>
                            </div>
                            <span class="sw-input-note">NIS tidak dapat diubah</span>
                        </div>
                        <div class="sw-form-group">
                            <label class="sw-label">Kelas</label>
                            <div class="sw-input-wrap">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                <input type="text" class="sw-input" value="{{ $siswa->kelas->nama_kelas ?? '-' }}" readonly>
                            </div>
                            <span class="sw-input-note">Ditentukan oleh admin</span>
                        </div>
                    </div>

                    <div class="sw-row">
                        <div class="sw-form-group">
                            <label class="sw-label">Nama Orang Tua</label>
                            <div class="sw-input-wrap">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <input type="text" name="nama_ortu" class="sw-input" value="{{ $siswa->nama_ortu }}" required>
                            </div>
                        </div>
                        <div class="sw-form-group">
                            <label class="sw-label">Nomor Telepon</label>
                            <div class="sw-input-wrap">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.06 6.06l.94-.93a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <input type="text" name="telepon" class="sw-input" value="{{ $siswa->telepon }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="sw-form-group">
                        <label class="sw-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="sw-textarea" required>{{ $siswa->alamat }}</textarea>
                    </div>

                    @endif

                    {{-- Foto Profil --}}
                    <div class="sw-section" style="margin-top: 28px;">
                        <span class="sw-section-label">Foto Profil</span>
                        <div class="sw-section-line"></div>
                    </div>

                    <div class="sw-photo-preview">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('uploads/' . auth()->user()->photo) }}" alt="Foto saat ini">
                        @else
                            <img src="{{ asset('sbadmin2/img/undraw_profile.svg') }}" alt="Foto saat ini">
                        @endif
                        <div class="sw-photo-preview-info">
                            <div class="title">Foto saat ini</div>
                            <div class="sub">Format: JPG, PNG, WEBP · Maks. 2MB</div>
                        </div>
                    </div>

                    <div class="sw-upload-zone">
                        <input type="file" name="photo" accept="image/*">
                        <div class="sw-upload-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div class="sw-upload-title">Klik untuk unggah foto baru</div>
                        <div class="sw-upload-sub">atau seret &amp; lepas file ke sini</div>
                        <div class="sw-upload-badge">Pilih File</div>
                    </div>

                    <div class="sw-footer">
                        <button type="submit" class="sw-btn-primary">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Update Profil
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
const fileInput = document.querySelector('input[type="file"]');
const previewImg = document.querySelector('.sw-photo-preview img');
const uploadTitle = document.querySelector('.sw-upload-title');

if (fileInput) {
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                uploadTitle.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });
}
</script>

@endsection