{{-- ============================================================
     FILE: tugas/edit.blade.php
============================================================ --}}
@extends('layouts.app')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --warning:#d97706; --warning-light:#fffbeb; --warning-border:#fde68a;
    --danger:#dc2626; --danger-light:#fef2f2; --danger-border:#fecaca;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08); --shadow-focus:0 0 0 3px rgba(37,99,235,0.12);
    --radius-sm:6px; --radius-md:10px; --radius-lg:14px; --radius-xl:18px;
}
*{
    box-sizing:border-box;
}

body,
button,
input,
select,
textarea{
    font-family:'Plus Jakarta Sans',sans-serif;
}
.form-wrapper{
    width:100%;
    max-width:100%;
    animation:fadeUp .4s ease both;
}
@keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
.back-nav { display:inline-flex; align-items:center; gap:6px; color:var(--text-muted); font-size:13.5px; font-weight:500; text-decoration:none; margin-bottom:22px; transition:color 0.15s; }
.back-nav:hover { color:var(--primary); text-decoration:none; }
.back-nav svg { width:16px; height:16px; }
.page-header { display:flex; align-items:center; gap:14px; margin-bottom:24px; }
.page-icon { width:50px; height:50px; border-radius:var(--radius-lg); background:var(--warning-light); border:1px solid var(--warning-border); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.page-icon svg { width:24px; height:24px; color:var(--warning); }
.page-title { font-size:22px; font-weight:700; color:var(--text-primary); margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle { font-size:13px; color:var(--text-secondary); margin:0; }
.form-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; }
.card-head { padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); display:flex; align-items:center; gap:9px; }
.card-head-dot { width:8px; height:8px; border-radius:50%; background:var(--warning); }
.card-head-label { font-size:12.5px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.7px; }
.card-body-p { padding:24px; }
.form-label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.form-control, .form-select, textarea.form-control {
    width:100%; padding:10px 14px; font-size:13.5px; font-family:'Plus Jakarta Sans',sans-serif;
    color:var(--text-primary); background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus, .form-select:focus, textarea.form-control:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.form-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:38px; cursor:pointer; }
textarea.form-control { resize:vertical; min-height:90px; }
.mb-3 { margin-bottom:16px; }
.file-link { display:inline-flex; align-items:center; gap:7px; color:var(--primary); font-size:13px; font-weight:600; text-decoration:none; padding:7px 14px; background:var(--primary-light); border:1px solid var(--primary-border); border-radius:var(--radius-sm); margin-top:4px; }
.file-link:hover { background:#dbeafe; text-decoration:none; color:var(--primary); }
.file-link svg { width:14px; height:14px; }
.file-hint { font-size:12px; color:var(--text-muted); margin-top:5px; }
.alert-danger-c { background:var(--danger-light); border:1px solid var(--danger-border); border-radius:var(--radius-md); padding:14px 18px; margin-bottom:20px; font-size:13px; color:var(--danger); }
.card-footer-p { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-top:1px solid var(--border); background:var(--surface-secondary); flex-wrap:wrap; gap:10px; }
.btn-cancel { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--surface); color:var(--text-secondary); border:1px solid var(--border); border-radius:var(--radius-md); text-decoration:none; cursor:pointer; transition:all 0.15s; }
.btn-cancel:hover { background:var(--surface-secondary); color:var(--text-primary); text-decoration:none; }
.btn-cancel svg { width:15px; height:15px; }
.btn-update { display:inline-flex; align-items:center; gap:8px; padding:10px 26px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--warning); color:#fff; border:none; border-radius:var(--radius-md); cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(217,119,6,0.3); }
.btn-update:hover { background:#b45309; transform:translateY(-1px); }
.btn-update svg { width:15px; height:15px; }


.edit-tugas-page{
    width:100%;
    padding:24px 28px 40px;
}

.form-grid{
    display:grid;
    grid-template-columns:
        repeat(auto-fit,minmax(320px,1fr));
    gap:20px;
}

</style>

<div class="edit-tugas-page">
<div class="form-wrapper">

    <a href="{{ route('guru.tugas.index') }}" class="back-nav">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Tugas
    </a>

    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/></svg>
        </div>
        <div>
            <h2 class="page-title">Edit Tugas</h2>
            <p class="page-subtitle">Perbarui informasi tugas yang sudah dibuat</p>
        </div>
    </div>

    <div class="form-card">
        <div class="card-head"><div class="card-head-dot"></div><span class="card-head-label">Perbarui Data Tugas</span></div>
        <div class="card-body-p">

            @if ($errors->any())
            <div class="alert-danger-c">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
            @endif

            <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data" id="formEdit">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Tugas <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ $tugas->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas <span style="color:var(--danger)">*</span></label>
                    <select name="kelas_id" class="form-select" required>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ $tugas->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $tugas->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Saat Ini</label><br>
                    @if($tugas->file)
                        <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank" class="file-link">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Lihat / Download File
                        </a>
                    @else
                        <span style="font-size:13px;color:var(--text-muted);">Tidak ada file terlampir</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti File <span style="font-weight:400;color:var(--text-muted);">(opsional)</span></label>
                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx">
                    <p class="file-hint">Biarkan kosong jika tidak ingin mengganti file</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deadline <span style="color:var(--danger)">*</span></label>
                    <input type="datetime-local" name="deadline" class="form-control"
                        value="{{ \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') }}">
                </div>
            </form>
        </div>
        <div class="card-footer-p">
            <a href="{{ route('guru.tugas.index') }}" class="btn-cancel">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Batalkan
            </a>
            <button type="submit" form="formEdit" class="btn-update">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

</div>
</div>
@endsection