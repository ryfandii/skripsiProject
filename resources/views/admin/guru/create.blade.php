@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary: #2563eb;
    --primary-light: #eff6ff;
    --primary-border: #bfdbfe;
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --success-light: #f0fdf4;
    --success-border: #bbf7d0;
    --success-dark: #15803d;
    --danger: #dc2626;
    --danger-light: #fef2f2;
    --danger-border: #fecaca;
    --info: #0284c7;
    --info-light: #f0f9ff;
    --info-border: #bae6fd;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --surface: #ffffff;
    --surface-secondary: #f8fafc;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus: 0 0 0 3px rgba(37,99,235,0.12);
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
    --radius-xl: 18px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

/* ── PAKSA AREA KONTEN MENGISI RUANG YANG ADA ── */
.container-fluid {
    width: 100%;
    max-width: 100%;
    padding: 24px !important;
    background: #f1f5f9;
    min-height: 100vh;
}

.form-wrapper {
    animation: fadeInUp 0.4s ease both;
    width: 100%;
    max-width: 100%;
    margin: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(14px); }
    to { opacity: 1; transform: translateY(0); }
}

.back-nav {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    margin-bottom: 22px;
    transition: color 0.15s;
    padding: 6px 0;
}
.back-nav:hover { color: var(--primary); text-decoration: none; }
.back-nav svg { width: 16px; height: 16px; }

.form-page-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 28px;
}

.form-page-icon {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-lg);
    background: var(--primary-light);
    border: 1px solid var(--primary-border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.form-page-icon svg { width: 24px; height: 24px; color: var(--primary); }

.form-page-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 4px 0;
    letter-spacing: -0.3px;
}
.form-page-subtitle { font-size: 13.5px; color: var(--text-secondary); }

.steps-indicator {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 24px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px 22px;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}
.step-item {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
}
.step-item:not(:last-child)::after {
    content: '';
    width: 1px;
    height: 24px;
    background: var(--border);
    margin: 0 16px;
    flex-shrink: 0;
}
.step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--primary-light);
    border: 1.5px solid var(--primary-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    color: var(--primary);
    flex-shrink: 0;
}
.step-label { font-size: 12.5px; font-weight: 600; color: var(--text-secondary); }
.step-desc { font-size: 11.5px; color: var(--text-muted); margin-top: 1px; }

.error-alert {
    background: var(--danger-light);
    border: 1px solid var(--danger-border);
    border-radius: var(--radius-md);
    padding: 14px 18px;
    margin-bottom: 22px;
}
.error-alert-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--danger);
    margin-bottom: 10px;
}
.error-alert-header svg { width: 16px; height: 16px; }
.error-list {
    margin: 0;
    padding: 0 0 0 20px;
    font-size: 13px;
    color: var(--danger);
    line-height: 1.8;
}

.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 16px;
}
.form-card-header {
    padding: 17px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-secondary);
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-dot { width: 8px; height: 8px; border-radius: 50%; }
.dot-blue { background: var(--primary); }
.dot-green { background: var(--success); }
.form-card-header-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.6px;
}
.form-card-body { padding: 26px 24px; }

.form-row-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}
.form-row-full { margin-bottom: 18px; }

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 7px;
}
.form-label .required { color: var(--danger); margin-left: 3px; }

.form-control {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-primary);
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
}
.form-control:focus { border-color: var(--primary); box-shadow: var(--shadow-focus); }
.form-control:hover:not(:focus) { border-color: var(--border-hover); }
.form-control::placeholder { color: var(--text-muted); }
.form-control.is-invalid {
    border-color: var(--danger);
    box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
}

select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 38px;
    cursor: pointer;
}

.info-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: var(--info-light);
    border: 1px solid var(--info-border);
    border-radius: var(--radius-md);
    padding: 14px 18px;
    margin-top: 18px;
}
.info-box-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    background: #e0f2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.info-box-icon svg { width: 16px; height: 16px; color: var(--info); }
.info-box-title { font-size: 13px; font-weight: 600; color: #075985; margin-bottom: 4px; }
.info-box-desc { font-size: 12.5px; color: #0369a1; line-height: 1.6; }
.info-box-desc b { font-weight: 700; }

.form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface-secondary);
    border-radius: 0 0 var(--radius-xl) var(--radius-xl);
    gap: 12px;
    flex-wrap: wrap;
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--surface);
    color: var(--text-secondary);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.15s;
}
.btn-cancel:hover { background: var(--surface-secondary); color: var(--text-primary); border-color: var(--border-hover); text-decoration: none; }
.btn-cancel svg { width: 15px; height: 15px; }

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 26px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--success);
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all 0.15s;
    box-shadow: 0 2px 8px rgba(22,163,74,0.3);
}
.btn-submit svg { width: 15px; height: 15px; }
.btn-submit:hover { background: var(--success-dark); box-shadow: 0 4px 14px rgba(22,163,74,0.4); transform: translateY(-1px); }
.btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

@media (max-width: 640px) {
    .form-row-grid { grid-template-columns: 1fr; }
    .steps-indicator { flex-direction: column; align-items: flex-start; gap: 12px; }
    .step-item::after { display: none; }
    .form-card-body { padding: 20px 16px; }
    .form-footer { padding: 16px; }
}
</style>

<div class="form-wrapper">

    {{-- BACK LINK --}}
    <a href="{{ route('admin.guru.index') }}" class="back-nav">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Guru
    </a>

    {{-- PAGE HEADER --}}
    <div class="form-page-header">
        <div class="form-page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <div>
            <h2 class="form-page-title">Tambah Guru Baru</h2>
            <p class="form-page-subtitle">Daftarkan guru baru beserta akun login ke sistem</p>
        </div>
    </div>

    {{-- STEPS INDICATOR --}}
    <div class="steps-indicator">
        <div class="step-item">
            <div class="step-num">1</div>
            <div>
                <div class="step-label">Data Pribadi</div>
                <div class="step-desc">Nama, NIP, alamat</div>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <div>
                <div class="step-label">Mata Pelajaran</div>
                <div class="step-desc">Pilih bidang studi</div>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <div>
                <div class="step-label">Akun Login</div>
                <div class="step-desc">Email & password</div>
            </div>
        </div>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
    <div class="error-alert">
        <div class="error-alert-header">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856C18.07 19.126 19 17.643 19 16V8a2 2 0 00-2-2H7a2 2 0 00-2 2v8c0 1.643.93 3.126 2.062 4z"/>
            </svg>
            Terdapat {{ $errors->count() }} kesalahan pada form
        </div>
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.guru.store') }}" method="POST" id="formTambahGuru">
        @csrf

        {{-- CARD 1: DATA PRIBADI --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="section-dot dot-blue"></div>
                <span class="form-card-header-label">Data Pribadi Guru</span>
            </div>
            <div class="form-card-body">

                <div class="form-row-grid">
                    <div>
                        <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                               class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan nama lengkap guru" required>
                    </div>
                    <div>
                        <label class="form-label">NIP <span class="required">*</span></label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                               class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}"
                               placeholder="Nomor Induk Pegawai" required>
                    </div>
                </div>

                <div class="form-row-grid">
                    <div>
                        <label class="form-label">Mata Pelajaran <span class="required">*</span></label>
                        <select name="mapel_id" class="form-control {{ $errors->has('mapel_id') ? 'is-invalid' : '' }}" required>
                            <option value="">— Pilih Mata Pelajaran —</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Nomor Telepon <span class="required">*</span></label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                               class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}"
                               placeholder="Contoh: 081234567890" required>
                    </div>
                </div>

                <div class="form-row-full">
                    <label class="form-label">Alamat Lengkap <span class="required">*</span></label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}"
                           class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                           placeholder="Jl. ..., Kelurahan, Kecamatan, Kota" required>
                </div>

            </div>
        </div>

        {{-- CARD 2: AKUN LOGIN --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="section-dot dot-green"></div>
                <span class="form-card-header-label">Akun Login Guru</span>
            </div>
            <div class="form-card-body">

                <div class="form-row-full">
                    <label class="form-label">Alamat Email <span class="required">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="contoh@sekolah.sch.id" required>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="info-box-title">Informasi Password</div>
                        <div class="info-box-desc">
                            Password default yang ditetapkan adalah <b>12345678</b>.<br>
                            Guru wajib mengganti password saat pertama kali login ke sistem.
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ route('admin.guru.index') }}" class="btn-cancel">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batalkan
                </a>
                <button type="submit" class="btn-submit" id="btnSubmit">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Data Guru
                </button>
            </div>

        </div>

    </form>

</div>

<script>
document.getElementById('btnSubmit').addEventListener('click', function(e) {
    this.disabled = true;
    this.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="animation:spin 0.8s linear infinite">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Menyimpan...
    `;
    document.getElementById('formTambahGuru').submit();
});

const style = document.createElement('style');
style.textContent = '@keyframes spin { to { transform: rotate(360deg); } }';
document.head.appendChild(style);
</script>

@endsection