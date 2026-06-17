{{-- ================================================================
     FILE 3: resources/views/admin/jadwal/edit.blade.php
     ================================================================ --}}

@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');
    :root {
        --brand:#1a56db; --brand-light:#e8f0fe; --brand-dark:#1648c0;
        --warning:#d97706; --warning-light:#fef3c7;
        --page-bg:#f4f6fa; --surface:#ffffff;
        --border:rgba(0,0,0,0.08); --text-1:#111827; --text-2:#6b7280; --text-3:#9ca3af;
        --r-sm:8px; --r-md:12px; --r-lg:16px;
        --sh-sm:0 1px 4px rgba(0,0,0,.06),0 2px 8px rgba(0,0,0,.04);
    }
    *,*::before,*::after{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}

    .container,
.container-fluid{
    width:100% !important;
    max-width:100% !important;
    padding-left:0 !important;
    padding-right:0 !important;
}
    .form-wrap{
    background:var(--page-bg);
    min-height:100vh;

    width:100%;
    max-width:100%;

    padding:28px 32px 56px;
}
    .form-nav{display:flex;align-items:center;gap:8px;margin-bottom:20px;}
    .form-nav a{font-size:13px;font-weight:500;color:var(--text-2);text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:color .12s;}
    .form-nav a:hover{color:var(--brand);}
    .form-nav-sep{color:var(--text-3);font-size:13px;}
    .form-nav-current{font-size:13px;font-weight:600;color:var(--text-1);}
    .form-page-title{margin-bottom:24px;}
    .form-page-title .eyebrow{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--warning);margin-bottom:4px;}
    .form-page-title h1{font-size:24px;font-weight:700;color:var(--text-1);margin:0;letter-spacing:-.4px;}
   .edit-banner{
    display:flex;
    align-items:center;
    gap:12px;
    background:var(--warning-light);
    border:1px solid rgba(217,119,6,.2);
    border-left:4px solid var(--warning);
    border-radius:var(--r-md);
    padding:13px 16px;
    margin-bottom:22px;
    font-size:13px;
    font-weight:500;
    color:#92400e;

    width:100%;
    max-width:100%;
}
   .form-card{
    background:var(--surface);
    border-radius:var(--r-lg);
    border:1px solid var(--border);
    box-shadow:var(--sh-sm);

    width:100%;
    max-width:100%;
}
    .form-card-header{padding:20px 24px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;}
    .form-card-icon{width:38px;height:38px;border-radius:9px;background:var(--warning-light);color:var(--warning);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
    .form-card-header-text h5{font-size:15px;font-weight:700;color:var(--text-1);margin:0 0 2px;}
    .form-card-header-text p{font-size:12px;color:var(--text-2);margin:0;}
    .form-card-body{padding:24px;}
    .field{margin-bottom:18px;}
    .field-label{font-size:13px;font-weight:600;color:var(--text-1);margin-bottom:7px;display:block;}
    .field-input,.field-select{width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:var(--r-sm);font-size:14px;color:var(--text-1);background:#fff;outline:none;transition:border-color .15s,box-shadow .15s;font-family:'Plus Jakarta Sans',sans-serif;appearance:none;}
    .field-input:focus,.field-select:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(26,86,219,.1);}
    .field-input[type="time"]{font-family:'DM Mono',monospace;cursor:pointer;}
    .select-wrap{position:relative;}
    .select-wrap::after{content:'\f107';font-family:'Font Awesome 6 Free';font-weight:900;position:absolute;right:13px;top:50%;transform:translateY(-50%);color:var(--text-3);pointer-events:none;font-size:12px;}
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
    .form-footer{display:flex;align-items:center;gap:10px;padding-top:20px;border-top:1px solid var(--border);margin-top:24px;}
    .btn-submit{display:inline-flex;align-items:center;gap:7px;background:var(--warning);color:#fff;border:none;border-radius:var(--r-sm);padding:10px 22px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .15s ease;box-shadow:0 2px 8px rgba(217,119,6,.3);font-family:'Plus Jakarta Sans',sans-serif;}
    .btn-submit:hover{background:#b45309;transform:translateY(-1px);color:#fff;}
    .btn-submit i{font-size:11px;}
    .btn-back{display:inline-flex;align-items:center;gap:7px;background:#f8fafc;color:var(--text-1);border:1.5px solid rgba(0,0,0,.12);border-radius:var(--r-sm);padding:10px 18px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .12s ease;font-family:'Plus Jakarta Sans',sans-serif;}
    .btn-back:hover{background:#eef2f6;color:var(--text-1);}
    @media(max-width:768px){.form-wrap{padding:20px 16px 40px;}.form-card,.edit-banner{max-width:100%;}.field-row{grid-template-columns:1fr;}}
</style>

<div class="form-wrap">

    <div class="form-nav">
        <a href="{{ route('admin.jadwal.index') }}"><i class="fas fa-arrow-left" style="font-size:11px;"></i> Jadwal</a>
        <span class="form-nav-sep">/</span>
        <span class="form-nav-current">Edit</span>
    </div>

    <div class="form-page-title">
        <div class="eyebrow">Akademik</div>
        <h1>Edit Jadwal</h1>
    </div>

    <div class="edit-banner">
        <i class="fas fa-pen" style="font-size:14px;flex-shrink:0;"></i>
        Mengedit jadwal:
        <strong>&nbsp;{{ $jadwal->mapel->nama_mapel ?? '' }} — {{ $jadwal->hari }}</strong>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="form-card-header-text">
                <h5>Ubah Data Jadwal</h5>
                <p>Perubahan akan langsung tersimpan ke sistem</p>
            </div>
        </div>
        <div class="form-card-body">

            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- KELAS --}}
                <div class="field">
                    <label class="field-label">Kelas</label>
                    <div class="select-wrap">
                        <select name="kelas_id" class="field-select" required>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- MAPEL --}}
                <div class="field">
                    <label class="field-label">Mata Pelajaran</label>
                    <div class="select-wrap">
                        <select name="mata_pelajaran_id" class="field-select" required>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" {{ $jadwal->mata_pelajaran_id == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- GURU --}}
                <div class="field">
                    <label class="field-label">Guru</label>
                    <div class="select-wrap">
                        <select name="guru_id" class="field-select" required>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- HARI --}}
                <div class="field">
                    <label class="field-label">Hari</label>
                    <div class="select-wrap">
                        <select name="hari" class="field-select" required>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                                <option value="{{ $h }}" {{ $jadwal->hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

               {{-- JAM --}}
<div class="field-row">
    <div class="field">
        <label class="field-label">Jam Mulai</label>
        <div class="select-wrap">
            <select name="jam_mulai" class="field-select" required>
                <option value="">-- Pilih Jam Mulai --</option>
                @php
                    $slots = [];
                    $start = strtotime('07:00');
                    $end   = strtotime('15:10');
                    for ($t = $start; $t <= $end; $t += 10 * 60) {
                        $slots[] = date('H:i', $t);
                        if (($t + 5 * 60) <= $end) {
                            $slots[] = date('H:i', $t + 5 * 60);
                        }
                    }
                    sort($slots);
                @endphp
                @foreach($slots as $slot)
                    <option value="{{ $slot }}" {{ old('jam_mulai', \Illuminate\Support\Str::substr($jadwal->jam_mulai, 0, 5)) == $slot ? 'selected' : '' }}>
                        {{ $slot }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label class="field-label">Jam Selesai</label>
        <div class="select-wrap">
            <select name="jam_selesai" class="field-select" required>
                <option value="">-- Pilih Jam Selesai --</option>
                @foreach($slots as $slot)
                    <option value="{{ $slot }}" {{ old('jam_selesai', \Illuminate\Support\Str::substr($jadwal->jam_selesai, 0, 5)) == $slot ? 'selected' : '' }}>
                        {{ $slot }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection


{{-- ================================================================
     FILE 4: resources/views/admin/jadwal/grid.blade.php
     ================================================================ --}}