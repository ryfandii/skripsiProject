@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:       #4F46E5;
    --primary-light: #EEF2FF;
    --primary-dark:  #3730A3;
    --success:       #059669;
    --success-light: #ECFDF5;
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
    --radius-lg:     14px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

/* ── BREADCRUMB / TOPBAR ── */
.sw-topbar { margin-bottom: 24px; }
.sw-topbar h3 {
    font-size: 21px; font-weight: 700;
    color: var(--text-dark); margin: 0 0 4px;
    letter-spacing: -.3px;
}
.sw-topbar p { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.05), 0 1px 2px rgba(0,0,0,.04);
    overflow: hidden;
}

.sw-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
}
.sw-card-header-icon {
    width: 38px; height: 38px;
    background: var(--primary);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    flex-shrink: 0;
}
.sw-card-header h5 {
    font-size: 15px; font-weight: 700;
    color: #3730A3; margin: 0;
}
.sw-card-header p { font-size: 12.5px; color: #6D6AA4; margin: 2px 0 0; }

.sw-card-body { padding: 28px 24px; }

/* ── SECTION DIVIDER ── */
.sw-section {
    display: flex; align-items: center; gap: 10px;
    margin: 28px 0 20px;
}
.sw-section-label {
    font-size: 12px; font-weight: 700;
    color: var(--primary); text-transform: uppercase; letter-spacing: .8px;
    white-space: nowrap;
}
.sw-section-line {
    flex: 1; height: 1px;
    background: linear-gradient(to right, #C7D2FE, transparent);
}

/* ── FORM GROUP ── */
.sw-form-row { display: flex; gap: 18px; margin-bottom: 18px; }
.sw-form-group { flex: 1; display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.sw-form-group.half { flex: 0 0 calc(50% - 9px); }
.sw-label {
    font-size: 12.5px; font-weight: 600;
    color: var(--text-mid);
}
.sw-label span { color: var(--danger); margin-left: 2px; }

.sw-input, .sw-select {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark);
    background: var(--neutral-light);
    outline: none;
    transition: border-color .15s, box-shadow .15s, background .15s;
    width: 100%;
}
.sw-input:focus, .sw-select:focus {
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}
.sw-input::placeholder { color: #C3C7D0; }

/* ── ALERT ── */
.sw-alert-info {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 14px 16px;
    background: var(--info-light);
    border: 1px solid #BAE6FD;
    border-radius: var(--radius-md);
    color: var(--info);
    font-size: 13px;
    margin-bottom: 22px;
}
.sw-alert-info svg { flex-shrink: 0; margin-top: 1px; }
.sw-alert-info strong { font-weight: 700; }

.sw-alert-danger {
    display: flex; gap: 10px; align-items: flex-start;
    padding: 14px 16px;
    background: var(--danger-light);
    border: 1px solid #FECACA;
    border-radius: var(--radius-md);
    color: var(--danger);
    font-size: 13px;
    margin-bottom: 22px;
}
.sw-alert-danger ul { margin: 0; padding-left: 16px; }
.sw-alert-danger li { margin-bottom: 2px; }

/* ── FOOTER ── */
.sw-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 24px;
    border-top: 1px solid var(--border);
    margin-top: 8px;
}
.sw-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    font-size: 13.5px; font-weight: 600;
    border: none; cursor: pointer; text-decoration: none;
    transition: all .18s ease; line-height: 1;
}
.sw-btn-secondary { background: var(--surface); color: var(--text-mid); border: 1.5px solid var(--border); }
.sw-btn-secondary:hover { background: var(--neutral-light); color: var(--text-mid); }
.sw-btn-success { background: var(--success); color: #fff; }
.sw-btn-success:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(5,150,105,.3); }
.sw-btn-success:disabled { opacity: .65; transform: none; box-shadow: none; cursor: not-allowed; }

@media (max-width: 640px) {
    .sw-page { padding: 16px; }
    .sw-form-row { flex-direction: column; gap: 0; }
    .sw-form-group.half { flex: 1; }
}
</style>

<div class="sw-page">

    <div class="sw-topbar">
        <h3>Tambah Siswa</h3>
        <p>Isi formulir di bawah untuk mendaftarkan siswa baru</p>
    </div>

    <div class="sw-card">

        <div class="sw-card-header">
            <div class="sw-card-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div>
                <h5>Formulir Data Siswa</h5>
                <p>Semua kolom bertanda <span style="color:#DC2626">*</span> wajib diisi</p>
            </div>
        </div>

        <div class="sw-card-body">

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="sw-alert-danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf

                {{-- SECTION: DATA SISWA --}}
                <div class="sw-section">
                    <span class="sw-section-label">Data Siswa</span>
                    <div class="sw-section-line"></div>
                </div>

                <div class="sw-form-row">
                    <div class="sw-form-group half">
                        <label class="sw-label">Nama <span>*</span></label>
                        <input type="text" name="nama" class="sw-input" placeholder="Nama lengkap siswa" required>
                    </div>
                    <div class="sw-form-group half">
                        <label class="sw-label">NIS <span>*</span></label>
                        <input type="text" name="nis" class="sw-input" placeholder="Nomor Induk Siswa" required>
                    </div>
                </div>

                <div class="sw-form-row">
                    <div class="sw-form-group half">
                        <label class="sw-label">Jenis Kelamin <span>*</span></label>
                        <select name="jenis_kelamin" class="sw-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="sw-form-group half">
                        <label class="sw-label">Nama Orang Tua <span>*</span></label>
                        <input type="text" name="nama_ortu" class="sw-input" placeholder="Nama ayah/ibu/wali" required>
                    </div>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Kelas <span>*</span></label>
                    <select name="kelas_id" class="sw-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Alamat <span>*</span></label>
                    <input type="text" name="alamat" class="sw-input" placeholder="Alamat lengkap" required>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Telepon <span>*</span></label>
                    <input type="text" name="telepon" class="sw-input" placeholder="Nomor telepon aktif" required>
                </div>

                {{-- SECTION: AKUN LOGIN --}}
                <div class="sw-section">
                    <span class="sw-section-label">Akun Login</span>
                    <div class="sw-section-line"></div>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Email <span>*</span></label>
                    <input type="email" name="email" class="sw-input" placeholder="email@siswa.com" required>
                </div>

                <div class="sw-alert-info">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <div>
                        Password default: <strong>12345678</strong><br>
                        Siswa wajib mengganti password saat login pertama.
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="sw-footer">
                    <a href="{{ route('admin.siswa.index') }}" class="sw-btn sw-btn-secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                    <button type="submit" class="sw-btn sw-btn-success"
                        onclick="this.disabled=true; this.innerText='Menyimpan...'; this.form.submit();">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Siswa
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection