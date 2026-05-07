{{-- ============================================================
     FILE: tugas/create.blade.php
============================================================ --}}
@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --danger:#dc2626; --danger-light:#fef2f2; --danger-border:#fecaca;
    --info:#0284c7; --info-light:#f0f9ff; --info-border:#bae6fd;
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
.page-icon { width:50px; height:50px; border-radius:var(--radius-lg); background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.page-icon svg { width:24px; height:24px; color:var(--primary); }
.page-title { font-size:22px; font-weight:700; color:var(--text-primary); margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle { font-size:13px; color:var(--text-secondary); margin:0; }
.form-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; margin-bottom:16px; }
.card-head { padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); display:flex; align-items:center; gap:9px; }
.card-head-dot { width:8px; height:8px; border-radius:50%; }
.dot-blue { background:var(--primary); } .dot-green { background:var(--success); }
.card-head-label { font-size:12.5px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.7px; }
.card-body-p { padding:24px; }
.form-row { display:grid; gap:16px; margin-bottom:16px; }
.form-row.cols-2{
    grid-template-columns:
        repeat(auto-fit,minmax(280px,1fr));
}
.form-row.cols-3{
    grid-template-columns:
        repeat(auto-fit,minmax(260px,1fr));
}
.form-row.cols-1 { grid-template-columns:1fr; }
.form-label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.form-control, .form-select, textarea.form-control {
    width:100%; padding:10px 14px; font-size:13.5px; font-family:'Plus Jakarta Sans',sans-serif;
    color:var(--text-primary); background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus, .form-select:focus, textarea.form-control:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.form-control[readonly] { background:var(--surface-secondary); color:var(--text-secondary); }
.form-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; padding-right:38px; cursor:pointer; }
textarea.form-control { resize:vertical; min-height:100px; }
.file-hint { font-size:12px; color:var(--text-muted); margin-top:5px; }
.card-footer-p { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-top:1px solid var(--border); background:var(--surface-secondary); flex-wrap:wrap; gap:10px; }
.btn-cancel { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--surface); color:var(--text-secondary); border:1px solid var(--border); border-radius:var(--radius-md); text-decoration:none; cursor:pointer; transition:all 0.15s; }
.btn-cancel:hover { background:var(--surface-secondary); color:var(--text-primary); text-decoration:none; }
.btn-cancel svg { width:15px; height:15px; }
.btn-save { display:inline-flex; align-items:center; gap:8px; padding:10px 26px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--primary); color:#fff; border:none; border-radius:var(--radius-md); cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(37,99,235,0.25); }
.btn-save:hover { background:var(--primary-dark); transform:translateY(-1px); }
.btn-save svg { width:15px; height:15px; }
@media(max-width:768px){

    .tugas-page{
        padding:16px;
    }

    .page-header{
        align-items:flex-start;
    }

    .page-title{
        font-size:20px;
    }

    .form-row.cols-2,
    .form-row.cols-3{
        grid-template-columns:1fr;
    }

    .card-body-p{
        padding:18px;
    }

    .card-footer-p{
        flex-direction:column;
        align-items:stretch;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
        justify-content:center;
    }
}

.tugas-page{
    width:100%;
    padding:24px 28px 40px;
}

.form-card{
    width:100%;
}

.card-body-p{
    padding:28px;
}

</style>

<div class="tugas-page">
<div class="form-wrapper">

    <a href="{{ route('guru.tugas.index') }}" class="back-nav">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Tugas
    </a>

    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        </div>
        <div>
            <h2 class="page-title">Tambah Tugas Baru</h2>
            <p class="page-subtitle">Buat tugas untuk siswa lengkap dengan file dan deadline</p>
        </div>
    </div>

    <div class="form-card">
        <div class="card-head"><div class="card-head-dot dot-blue"></div><span class="card-head-label">Informasi Tugas</span></div>
        <div class="card-body-p">
            <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data" id="formCreate">
                @csrf

                <div class="form-row cols-3">
                    <div>
                        <label class="form-label">Judul Tugas <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul tugas" required>
                    </div>
                    <div>
                        <label class="form-label">Kelas <span style="color:var(--danger)">*</span></label>
                        <select name="kelas_id" class="form-select" required>
                            <option value="">— Pilih Kelas —</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Mata Pelajaran</label>
                        @if($mapel)
                            <input type="text" class="form-control" value="{{ $mapel->nama_mapel }}" readonly>
                            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                        @else
                            <input type="text" class="form-control" value="Mapel belum diset" readonly>
                        @endif
                    </div>
                </div>

                <div class="form-row cols-1">
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Tuliskan deskripsi dan instruksi tugas..."></textarea>
                    </div>
                </div>

                <div class="form-row cols-2">
                    <div>
                        <label class="form-label">Upload File Tugas</label>
                        <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <p class="file-hint">Format: PDF, DOC, DOCX, PPT, PPTX</p>
                    </div>
                    <div>
                        <label class="form-label">Deadline <span style="color:var(--danger)">*</span></label>
                        <input type="datetime-local" name="deadline" class="form-control" required>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer-p">
            <a href="{{ route('guru.tugas.index') }}" class="btn-cancel">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Batalkan
            </a>
            <button type="submit" form="formCreate" class="btn-save">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Tugas
            </button>
        </div>
    </div>

</div>
</div>
@endsection