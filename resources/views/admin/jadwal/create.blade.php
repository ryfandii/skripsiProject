{{-- ================================================================
     FILE 2: resources/views/admin/jadwal/create.blade.php
     ================================================================ --}}

@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');
    :root {
        --brand:#1a56db; --brand-light:#e8f0fe; --brand-dark:#1648c0;
        --danger:#dc2626; --page-bg:#f4f6fa; --surface:#ffffff;
        --border:rgba(0,0,0,0.08); --text-1:#111827; --text-2:#6b7280; --text-3:#9ca3af;
        --r-sm:8px; --r-md:12px; --r-lg:16px;
        --sh-sm:0 1px 4px rgba(0,0,0,.06),0 2px 8px rgba(0,0,0,.04);
    }
    *,*::before,*::after{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
    .form-wrap{background:var(--page-bg);min-height:100vh;padding:28px 32px 56px;}
    .form-nav{display:flex;align-items:center;gap:8px;margin-bottom:20px;}
    .form-nav a{font-size:13px;font-weight:500;color:var(--text-2);text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:color .12s;}
    .form-nav a:hover{color:var(--brand);}
    .form-nav-sep{color:var(--text-3);font-size:13px;}
    .form-nav-current{font-size:13px;font-weight:600;color:var(--text-1);}
    .form-page-title{margin-bottom:24px;}
    .form-page-title .eyebrow{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--brand);margin-bottom:4px;}
    .form-page-title h1{font-size:24px;font-weight:700;color:var(--text-1);margin:0;letter-spacing:-.4px;}
   .form-card{
    background:var(--surface);
    border-radius:var(--r-lg);
    border:1px solid var(--border);
    box-shadow:var(--sh-sm);

    width:100%;
    max-width:100%;
}
    .form-card-header{padding:20px 24px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;}
    .form-card-icon{width:38px;height:38px;border-radius:9px;background:var(--brand-light);color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
    .form-card-header-text h5{font-size:15px;font-weight:700;color:var(--text-1);margin:0 0 2px;}
    .form-card-header-text p{font-size:12px;color:var(--text-2);margin:0;}
    .form-card-body{padding:24px;}
    .form-errors{background:#fff5f5;border:1px solid rgba(220,38,38,.2);border-left:4px solid var(--danger);border-radius:var(--r-md);padding:14px 16px;margin-bottom:22px;}
    .form-errors ul{margin:0;padding-left:18px;}
    .form-errors li{font-size:13px;color:var(--danger);font-weight:500;line-height:1.7;}
    .field{margin-bottom:18px;}
    .field-label{font-size:13px;font-weight:600;color:var(--text-1);margin-bottom:7px;display:block;}
    .field-input,.field-select{width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:var(--r-sm);font-size:14px;color:var(--text-1);background:#fff;outline:none;transition:border-color .15s,box-shadow .15s;font-family:'Plus Jakarta Sans',sans-serif;appearance:none;}
    .field-input::placeholder{color:var(--text-3);}
    .field-input:focus,.field-select:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,.1);}
    .field-input[type="time"]{font-family:'DM Mono',monospace;cursor:pointer;}
    .select-wrap{position:relative;}
    .select-wrap::after{content:'\f107';font-family:'Font Awesome 6 Free';font-weight:900;position:absolute;right:13px;top:50%;transform:translateY(-50%);color:var(--text-3);pointer-events:none;font-size:12px;}
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
    .form-footer{display:flex;align-items:center;gap:10px;padding-top:20px;border-top:1px solid var(--border);margin-top:24px;}
    .btn-submit{display:inline-flex;align-items:center;gap:7px;background:var(--brand);color:#fff;border:none;border-radius:var(--r-sm);padding:10px 22px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .15s ease;box-shadow:0 2px 8px rgba(26,86,219,.25);font-family:'Plus Jakarta Sans',sans-serif;}
    .btn-submit:hover{background:var(--brand-dark);transform:translateY(-1px);color:#fff;}
    .btn-submit i{font-size:11px;}
    .btn-back{display:inline-flex;align-items:center;gap:7px;background:#f8fafc;color:var(--text-1);border:1.5px solid rgba(0,0,0,.12);border-radius:var(--r-sm);padding:10px 18px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .12s ease;font-family:'Plus Jakarta Sans',sans-serif;}
    .btn-back:hover{background:#eef2f6;color:var(--text-1);}
    @media(max-width:768px){.form-wrap{padding:20px 16px 40px;}.form-card{max-width:100%;}.field-row{grid-template-columns:1fr;}}
</style>

<div class="form-wrap">

    <div class="form-nav">
        <a href="{{ route('admin.jadwal.index') }}"><i class="fas fa-arrow-left" style="font-size:11px;"></i> Jadwal</a>
        <span class="form-nav-sep">/</span>
        <span class="form-nav-current">Tambah Baru</span>
    </div>

    <div class="form-page-title">
        <div class="eyebrow">Akademik</div>
        <h1>Tambah Jadwal</h1>
    </div>

    @if(session('error'))
        <div class="form-errors" style="max-width:600px;">
            <ul><li>{{ session('error') }}</li></ul>
        </div>
    @endif

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-calendar-plus"></i></div>
            <div class="form-card-header-text">
                <h5>Data Jadwal Baru</h5>
                <p>Isi semua informasi jadwal pelajaran</p>
            </div>
        </div>
        <div class="form-card-body">

            @if ($errors->any())
                <div class="form-errors">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf

                {{-- KELAS --}}
                <div class="field">
                    <label class="field-label">Kelas</label>
                    <div class="select-wrap">
                        <select name="kelas_id" class="field-select">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- MAPEL --}}
                <div class="field">
                    <label class="field-label">Mata Pelajaran</label>
                    <div class="select-wrap">
                        <select name="mata_pelajaran_id" class="field-select">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" {{ old('mata_pelajaran_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- GURU --}}
                <div class="field">
                    <label class="field-label">Guru</label>
                    <div class="select-wrap">
                        <select name="guru_id" class="field-select">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- HARI --}}
                <div class="field">
                    <label class="field-label">Hari</label>
                    <div class="select-wrap">
                        <select name="hari" class="field-select">
                            <option value="">-- Pilih Hari --</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                                <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- JAM --}}
                <div class="field-row">
                    <div class="field">
                        <label class="field-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="field-input">
                    </div>
                    <div class="field">
                        <label class="field-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="field-input">
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn-back"><i class="fas fa-times"></i> Batal</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection