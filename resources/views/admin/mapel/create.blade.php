{{-- ============================================================
     FILE 2: resources/views/admin/mapel/create.blade.php
     ============================================================ --}}

@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --brand:        #1a56db;
        --brand-light:  #e8f0fe;
        --brand-dark:   #1648c0;
        --danger:       #dc2626;
        --danger-light: #fee2e2;
        --page-bg:      #f4f6fa;
        --surface:      #ffffff;
        --border:       rgba(0,0,0,0.08);
        --border-focus: rgba(26,86,219,0.5);
        --text-1:       #111827;
        --text-2:       #6b7280;
        --text-3:       #9ca3af;
        --r-sm: 8px; --r-md: 12px; --r-lg: 16px;
        --sh-sm: 0 1px 4px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.04);
    }
.container,
.container-fluid {
    width: 100% !important;
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
}
    *, *::before, *::after { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

    .form-wrap {
    background: var(--page-bg);
    min-height: 100vh;
    width: 100%;
    max-width: 100%;
    padding: 28px 32px 56px;
}

    /* breadcrumb / back nav */
    .form-nav { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
    .form-nav a { font-size: 13px; font-weight: 500; color: var(--text-2); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: color .12s; }
    .form-nav a:hover { color: var(--brand); }
    .form-nav-sep { color: var(--text-3); font-size: 13px; }
    .form-nav-current { font-size: 13px; font-weight: 600; color: var(--text-1); }

    /* page title */
    .form-page-title { margin-bottom: 24px; }
    .form-page-title .eyebrow { font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--brand); margin-bottom: 4px; }
    .form-page-title h1 { font-size: 24px; font-weight: 700; color: var(--text-1); margin: 0; letter-spacing: -.4px; }

    /* card */
    .form-card {
    background: var(--surface);
    border-radius: var(--r-lg);
    border: 1px solid var(--border);
    box-shadow: var(--sh-sm);
    width: 100%;
    max-width: 100%;
}
    .form-card-header { padding: 20px 24px 16px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
    .form-card-icon { width: 38px; height: 38px; border-radius: 9px; background: var(--brand-light); color: var(--brand); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .form-card-header-text h5 { font-size: 15px; font-weight: 700; color: var(--text-1); margin: 0 0 2px; }
    .form-card-header-text p  { font-size: 12px; color: var(--text-2); margin: 0; }
    .form-card-body { padding: 24px; }

    /* error list */
    .form-errors { background: #fff5f5; border: 1px solid rgba(220,38,38,.2); border-left: 4px solid var(--danger); border-radius: var(--r-md); padding: 14px 16px; margin-bottom: 22px; }
    .form-errors ul { margin: 0; padding-left: 18px; }
    .form-errors li { font-size: 13px; color: var(--danger); font-weight: 500; line-height: 1.7; }

    /* field */
    .field { margin-bottom: 20px; }
    .field:last-of-type { margin-bottom: 0; }
    .field-label { display: flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; color: var(--text-1); margin-bottom: 7px; }
    .field-label .req { color: var(--danger); font-size: 14px; line-height: 1; }
    .field-hint { font-size: 12px; color: var(--text-3); margin-top: 5px; }

    .field-input {
        width: 100%; padding: 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: var(--r-sm);
        font-size: 14px; color: var(--text-1);
        background: #fff;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .field-input::placeholder { color: var(--text-3); }
    .field-input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(26,86,219,.1); }
    .field-input.is-invalid { border-color: var(--danger); }
    .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,.1); }
    .field-input[type="number"] { font-family: 'DM Mono', monospace; }

    /* input with prefix/suffix */
    .field-input-group { display: flex; align-items: stretch; border: 1.5px solid var(--border); border-radius: var(--r-sm); overflow: hidden; transition: border-color .15s, box-shadow .15s; background: #fff; }
    .field-input-group:focus-within { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(26,86,219,.1); }
    .field-input-group .input-addon { display: flex; align-items: center; padding: 0 12px; background: #f8fafc; border-right: 1.5px solid var(--border); font-size: 12px; font-weight: 600; color: var(--text-3); white-space: nowrap; }
    .field-input-group .input-addon-right { border-right: none; border-left: 1.5px solid var(--border); }
    .field-input-group .field-input { border: none; border-radius: 0; box-shadow: none; }
    .field-input-group .field-input:focus { box-shadow: none; }

    /* form footer */
    .form-footer { display: flex; align-items: center; gap: 10px; padding-top: 20px; border-top: 1px solid var(--border); margin-top: 24px; }

    .btn-submit {
        display: inline-flex; align-items: center; gap: 7px;
        background: var(--brand); color: #fff; border: none;
        border-radius: var(--r-sm); padding: 10px 22px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; transition: all .15s ease;
        box-shadow: 0 2px 8px rgba(26,86,219,.25);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-submit:hover { background: var(--brand-dark); transform: translateY(-1px); color: #fff; }
    .btn-submit i { font-size: 11px; }

    .btn-back {
        display: inline-flex; align-items: center; gap: 7px;
        background: #f8fafc; color: var(--text-1);
        border: 1.5px solid rgba(0,0,0,.12);
        border-radius: var(--r-sm); padding: 10px 18px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; transition: all .12s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-back:hover { background: #eef2f6; color: var(--text-1); }
    .btn-back i { font-size: 11px; }

    @media (max-width: 768px) {
        .form-wrap { padding: 20px 16px 40px; }
        .form-card { max-width: 100%; }
    }
</style>

<div class="form-wrap">

    {{-- BREADCRUMB --}}
    <div class="form-nav">
        <a href="{{ route('admin.mapel.index') }}">
            <i class="fas fa-arrow-left" style="font-size:11px;"></i> Mata Pelajaran
        </a>
        <span class="form-nav-sep">/</span>
        <span class="form-nav-current">Tambah Baru</span>
    </div>

    <div class="form-page-title">
        <div class="eyebrow">Kurikulum</div>
        <h1>Tambah Mata Pelajaran</h1>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-book"></i></div>
            <div class="form-card-header-text">
                <h5>Data Mata Pelajaran</h5>
                <p>Isi semua field yang bertanda <span style="color:#dc2626;">*</span> wajib diisi</p>
            </div>
        </div>
        <div class="form-card-body">

            @if ($errors->any())
                <div class="form-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf

                {{-- Nama Mapel --}}
                <div class="field">
                    <label class="field-label">
                        Nama Mata Pelajaran <span class="req">*</span>
                    </label>
                    <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}"
                           class="field-input {{ $errors->has('nama_mapel') ? 'is-invalid' : '' }}"
                           placeholder="cth. Matematika Wajib" required>
                </div>

                {{-- Kode Mapel --}}
                <div class="field">
                    <label class="field-label">
                        Kode Mata Pelajaran <span class="req">*</span>
                    </label>
                    <div class="field-input-group">
                        <span class="input-addon"><i class="fas fa-hashtag" style="font-size:11px;"></i></span>
                        <input type="text" name="kode_mapel" value="{{ old('kode_mapel') }}"
                               class="field-input {{ $errors->has('kode_mapel') ? 'is-invalid' : '' }}"
                               placeholder="cth. MTK-01" required>
                    </div>
                    <div class="field-hint">Gunakan kode unik untuk setiap mata pelajaran.</div>
                </div>

                {{-- Jam Pelajaran --}}
                <div class="field">
                    <label class="field-label">
                        Jam Pelajaran <span class="req">*</span>
                    </label>
                    <div class="field-input-group">
                        <input type="number" name="jam_pelajaran" value="{{ old('jam_pelajaran') }}"
                               class="field-input {{ $errors->has('jam_pelajaran') ? 'is-invalid' : '' }}"
                               placeholder="0" min="1" max="40" required>
                        <span class="input-addon input-addon-right">jam / minggu</span>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.mapel.index') }}" class="btn-back">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection