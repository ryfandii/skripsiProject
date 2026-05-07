@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary: #2563eb;
    --primary-light: #eff6ff;
    --primary-border: #bfdbfe;
    --primary-dark: #1d4ed8;
    --warning: #d97706;
    --warning-light: #fffbeb;
    --warning-border: #fde68a;
    --warning-dark: #b45309;
    --success: #16a34a;
    --danger: #dc2626;
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

/* BREADCRUMB */
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

/* PAGE HEADING */
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
    background: var(--warning-light);
    border: 1px solid var(--warning-border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.form-page-icon svg { width: 24px; height: 24px; color: var(--warning); }

.form-page-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 4px 0;
    letter-spacing: -0.3px;
}

.form-page-subtitle {
    font-size: 13.5px;
    color: var(--text-secondary);
}

/* CARD */
.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.form-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-secondary);
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-card-header-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.section-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--warning);
}

.form-card-body { padding: 28px 24px; }

/* SECTION DIVIDER */
.form-section-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-muted);
    margin-bottom: 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border);
}

/* FORM ELEMENTS */
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

.form-label .required {
    color: var(--danger);
    margin-left: 3px;
}

.form-hint {
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 400;
    margin-left: 4px;
}

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
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    appearance: none;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: var(--shadow-focus);
    background: var(--surface);
}

.form-control:hover:not(:focus) {
    border-color: var(--border-hover);
}

.form-control::placeholder { color: var(--text-muted); }

select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 38px;
    cursor: pointer;
}

/* GURU INFO BANNER */
.guru-info-banner {
    display: flex;
    align-items: center;
    gap: 14px;
    background: var(--warning-light);
    border: 1px solid var(--warning-border);
    border-radius: var(--radius-md);
    padding: 14px 18px;
    margin-bottom: 26px;
}

.guru-avatar {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-md);
    background: var(--warning-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 700;
    color: var(--warning-dark);
    flex-shrink: 0;
    letter-spacing: -0.5px;
}

.guru-info-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.guru-info-meta {
    font-size: 12.5px;
    color: var(--text-secondary);
    margin-top: 2px;
}

/* FOOTER ACTIONS */
.form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface-secondary);
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

.btn-cancel svg { width: 15px; height: 15px; }

.btn-cancel:hover {
    background: var(--surface-secondary);
    color: var(--text-primary);
    border-color: var(--border-hover);
    text-decoration: none;
}

.btn-update {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 26px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--warning);
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all 0.15s;
    box-shadow: 0 2px 8px rgba(217,119,6,0.3);
}

.btn-update svg { width: 15px; height: 15px; }

.btn-update:hover {
    background: var(--warning-dark);
    box-shadow: 0 4px 14px rgba(217,119,6,0.4);
    transform: translateY(-1px);
}

.btn-update:active { transform: scale(0.98); }

@media (max-width: 640px) {
    .form-row-grid { grid-template-columns: 1fr; }
    .form-card-body { padding: 20px 16px; }
    .form-footer { padding: 16px; }
}
</style>

<div class="container-fluid px-4 py-2">
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/>
            </svg>
        </div>
        <div>
            <h2 class="form-page-title">Edit Data Guru</h2>
            <p class="form-page-subtitle">Perbarui informasi data guru yang sudah terdaftar</p>
        </div>
    </div>

    {{-- CURRENT GURU BANNER --}}
    <div class="guru-info-banner">
        <div class="guru-avatar">
            {{ strtoupper(substr($guru->nama, 0, 2)) }}
        </div>
        <div>
            <div class="guru-info-name">{{ $guru->nama }}</div>
            <div class="guru-info-meta">NIP: {{ $guru->nip ?: '—' }} &nbsp;&bull;&nbsp; {{ $guru->mapel->nama_mapel ?? 'Belum ada mapel' }}</div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">

        <div class="form-card-header">
            <div class="section-dot"></div>
            <span class="form-card-header-label">Informasi Data Guru</span>
        </div>

        <div class="form-card-body">
            <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ROW 1 --}}
                <div class="form-row-grid">
                    <div>
                        <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $guru->nama) }}"
                               class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div>
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}"
                               class="form-control" placeholder="Nomor Induk Pegawai">
                    </div>
                </div>

                {{-- ROW 2 --}}
                <div class="form-row-grid">
                    <div>
                        <label class="form-label">Mata Pelajaran <span class="required">*</span></label>
                        <select name="mapel_id" class="form-control" required>
                            <option value="">— Pilih Mata Pelajaran —</option>
                            @forelse($mapel as $m)
                                <option value="{{ $m->id }}" {{ $guru->mapel_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @empty
                                <option disabled>Tidak ada data mapel</option>
                            @endforelse
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $guru->telepon) }}"
                               class="form-control" placeholder="Contoh: 081234567890">
                    </div>
                </div>

                {{-- ROW 3 --}}
                <div class="form-row-full">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $guru->alamat) }}"
                           class="form-control" placeholder="Masukkan alamat lengkap">
                </div>

            {{-- Tombol di dalam form, sebelum </form> --}}
            </form>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.guru.index') }}" class="btn-cancel">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batalkan
            </a>
            <button type="submit" form="formEditGuru" class="btn-update" id="btnUpdate">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </div>

</div>
</div>

<script>
(function() {
    // Attach form id so footer button can submit
    const form = document.querySelector('form[action*="update"]');
    if (form) form.id = 'formEditGuru';
})();
</script>

@endsection