@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --warning:#d97706; --warning-light:#fffbeb; --warning-border:#fde68a;
    --danger:#dc2626;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus:0 0 0 3px rgba(37,99,235,0.12);
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
.page-icon { width:50px; height:50px; border-radius:var(--radius-lg); background:var(--success-light); border:1px solid var(--success-border); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.page-icon svg { width:24px; height:24px; color:var(--success); }
.page-title { font-size:22px; font-weight:700; color:var(--text-primary); margin:0 0 2px; letter-spacing:-0.3px; }
.page-subtitle { font-size:13px; color:var(--text-secondary); margin:0; }

/* INFO BANNER */
.siswa-banner { display:flex; align-items:center; gap:14px; background:var(--surface-secondary); border:1px solid var(--border); border-radius:var(--radius-lg); padding:16px 20px; margin-bottom:22px; }
.siswa-avatar { width:44px; height:44px; border-radius:var(--radius-md); background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; color:var(--primary); flex-shrink:0; }
.siswa-name { font-size:14px; font-weight:600; color:var(--text-primary); }
.siswa-meta { font-size:12.5px; color:var(--text-secondary); margin-top:2px; }

/* CARD */
.form-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-xl); box-shadow:var(--shadow-md); overflow:hidden; }
.card-head { padding:16px 22px; border-bottom:1px solid var(--border); background:var(--surface-secondary); display:flex; align-items:center; gap:9px; }
.card-head-dot { width:8px; height:8px; border-radius:50%; background:var(--success); }
.card-head-label { font-size:12.5px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.7px; }
.card-body-p { padding:26px 24px; }

.form-label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.form-control {
    width:100%; padding:10px 14px; font-size:14px; font-family:'Plus Jakarta Sans',sans-serif;
    color:var(--text-primary); background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.form-control[readonly] { background:var(--surface-secondary); color:var(--text-secondary); }
.mb-3 { margin-bottom:18px; }

/* NILAI INPUT SPECIAL */
.nilai-input-wrap { position:relative; }
.nilai-input-wrap input { font-size:18px; font-weight:700; padding:12px 50px 12px 16px; text-align:center; }
.nilai-unit { position:absolute; right:14px; top:50%; transform:translateY(-50%); font-size:13px; color:var(--text-muted); font-weight:600; pointer-events:none; }

/* CARD FOOTER */
.card-footer-p { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-top:1px solid var(--border); background:var(--surface-secondary); flex-wrap:wrap; gap:10px; }

.btn-cancel { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--surface); color:var(--text-secondary); border:1px solid var(--border); border-radius:var(--radius-md); text-decoration:none; cursor:pointer; transition:all 0.15s; }
.btn-cancel:hover { background:var(--surface-secondary); color:var(--text-primary); text-decoration:none; }
.btn-cancel svg { width:15px; height:15px; }

.btn-save { display:inline-flex; align-items:center; gap:8px; padding:10px 26px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--success); color:#fff; border:none; border-radius:var(--radius-md); cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(22,163,74,0.3); }
.btn-save:hover { background:#15803d; transform:translateY(-1px); }
.btn-save svg { width:15px; height:15px; }


.edit-page{
    width:100%;
    padding:24px 28px 40px;
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:20px;
}
</style>

<div class="edit-page">
<div class="form-wrapper">

    <a href="{{ route('guru.nilai.index') }}" class="back-nav">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Nilai
    </a>

    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        <div>
            <h2 class="page-title">Edit Nilai</h2>
            <p class="page-subtitle">Perbarui nilai akademik siswa</p>
        </div>
    </div>

    {{-- SISWA BANNER --}}
    <div class="siswa-banner">
        <div class="siswa-avatar">{{ strtoupper(substr($nilai->siswa->nama, 0, 2)) }}</div>
        <div>
            <div class="siswa-name">{{ $nilai->siswa->nama }}</div>
            <div class="siswa-meta">{{ $nilai->mapel->nama_mapel }}</div>
        </div>
        <div style="margin-left:auto; text-align:right;">
            <div style="font-size:11px;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Nilai Saat Ini</div>
            <div style="font-size:24px;font-weight:700;color:var(--primary);">{{ $nilai->nilai }}</div>
        </div>
    </div>

    <div class="form-card">
        <div class="card-head">
            <div class="card-head-dot"></div>
            <span class="card-head-label">Perbarui Nilai</span>
        </div>
        <div class="card-body-p">
            <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST" id="formEditNilai">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" value="{{ $nilai->siswa->nama }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <input type="text" class="form-control" value="{{ $nilai->mapel->nama_mapel }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nilai Baru <span style="color:var(--danger);">*</span></label>
                    <div class="nilai-input-wrap">
                        <input type="number" name="nilai" class="form-control" value="{{ $nilai->nilai }}" min="0" max="100" required>
                        <span class="nilai-unit">/ 100</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer-p">
            <a href="{{ route('guru.nilai.index') }}" class="btn-cancel">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Batalkan
            </a>
            <button type="submit" form="formEditNilai" class="btn-save">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Nilai
            </button>
        </div>
    </div>

</div>
</div>
@endsection