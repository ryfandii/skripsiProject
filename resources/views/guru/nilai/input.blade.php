@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --danger:#dc2626;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
    --shadow-focus:0 0 0 3px rgba(37,99,235,0.12);
    --radius-sm:6px; --radius-md:10px; --radius-lg:14px; --radius-xl:18px;
}
* {
    box-sizing:border-box;
}

body,
button,
input,
select,
textarea {
    font-family:'Plus Jakarta Sans',sans-serif;
}
.form-wrapper {
    width:100%;
    max-width:100%;
    animation:fadeUp 0.4s ease both;
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
.dot-blue { background:var(--primary); }
.dot-green { background:var(--success); }
.card-head-label { font-size:12.5px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.7px; }
.card-body-p { padding:22px 24px; }

.form-label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.form-control {
    width:100%; padding:10px 14px; font-size:13.5px; font-family:'Plus Jakarta Sans',sans-serif;
    color:var(--text-primary); background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.form-control[readonly] { background:var(--surface-secondary); color:var(--text-secondary); }
.form-select {
    width:100%; padding:10px 38px 10px 14px; font-size:13.5px; font-family:'Plus Jakarta Sans',sans-serif;
    color:var(--text-primary); background:var(--surface); border:1px solid var(--border);
    border-radius:var(--radius-md); outline:none; appearance:none; cursor:pointer;
    transition:border-color 0.2s, box-shadow 0.2s;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 12px center; background-size:16px;
}
.form-select:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }
.mb-3 { margin-bottom:16px; }

.filter-row {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:18px;
}

/* TABLE */
.table-responsive { overflow-x:auto; }
table.nilai-input-table { width:100%; border-collapse:collapse; min-width:400px; }
.nilai-input-table thead tr { background:var(--surface-secondary); border-bottom:1px solid var(--border); }
.nilai-input-table thead th { padding:12px 16px; font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.7px; text-align:left; white-space:nowrap; }
.nilai-input-table tbody tr { border-bottom:1px solid var(--border); transition:background 0.15s; }
.nilai-input-table tbody tr:last-child { border-bottom:none; }
.nilai-input-table tbody tr:hover { background:#f8faff; }
.nilai-input-table tbody td { padding:12px 16px; font-size:13.5px; color:var(--text-primary); vertical-align:middle; }
.nilai-page{
    width:100%;
    padding:24px 28px 40px;
}
.cell-no { font-size:12px; color:var(--text-muted); width:42px; }

.name-cell { display:flex; align-items:center; gap:10px; }
.name-avatar { width:32px; height:32px; border-radius:50%; background:var(--primary-light); border:1px solid var(--primary-border); display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; color:var(--primary); flex-shrink:0; }

.nilai-input {
    width:90px; padding:7px 10px; font-size:14px; font-weight:700; text-align:center;
    font-family:'Plus Jakarta Sans',sans-serif; border:1px solid var(--border);
    border-radius:var(--radius-sm); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
}
.nilai-input:focus { border-color:var(--primary); box-shadow:var(--shadow-focus); }

/* PLACEHOLDER STATE */
.table-placeholder { padding:48px 24px; text-align:center; }
.placeholder-icon { width:52px; height:52px; background:var(--surface-secondary); border-radius:50%; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; margin:0 auto 12px; }
.placeholder-icon svg { width:24px; height:24px; color:var(--text-muted); }
.placeholder-text { font-size:13.5px; color:var(--text-muted); }

/* FOOTER */
.card-footer-p { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-top:1px solid var(--border); background:var(--surface-secondary); flex-wrap:wrap; gap:10px; }
.btn-save { display:inline-flex; align-items:center; gap:8px; padding:10px 26px; font-size:13.5px; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; background:var(--success); color:#fff; border:none; border-radius:var(--radius-md); cursor:pointer; transition:all 0.15s; box-shadow:0 2px 8px rgba(22,163,74,0.3); }
.btn-save:hover { background:#15803d; transform:translateY(-1px); }
.btn-save svg { width:15px; height:15px; }
.footer-info { font-size:12.5px; color:var(--text-muted); }

.form-card{
    width:100%;
}

.table-responsive{
    width:100%;
    overflow-x:auto;
}

.card-body-p{
    padding:28px;
}

.card-footer-p{
    padding:20px 28px;
}

@media (max-width:768px){

    .nilai-page{
        padding:16px;
    }

    .page-header{
        align-items:flex-start;
    }

    .page-title{
        font-size:20px;
    }

    .filter-row{
        grid-template-columns:1fr;
    }

    .card-body-p{
        padding:18px;
    }

    .card-footer-p{
        padding:16px 18px;
        flex-direction:column;
        align-items:flex-start;
    }

    .btn-save{
        width:100%;
        justify-content:center;
    }
}
</style>

<div class="nilai-page">
<div class="form-wrapper">

    <a href="{{ route('guru.nilai.index') }}" class="back-nav">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Nilai
    </a>

    <div class="page-header">
        <div class="page-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div>
            <h2 class="page-title">Input Nilai Siswa</h2>
            <p class="page-subtitle">Masukkan nilai akademik siswa per kelas</p>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <div class="form-card">
        <div class="card-head">
            <div class="card-head-dot dot-blue"></div>
            <span class="card-head-label">Pilih Kelas</span>
        </div>
        <div class="card-body-p">
            <div class="filter-row">
                <div>
                    <label class="form-label">Kelas</label>
                    <select id="kelas" class="form-select">
                        <option value="">— Pilih Kelas —</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Mata Pelajaran</label>
                    <input type="text" class="form-control" value="{{ $mapel->nama_mapel }}" readonly>
                </div>
            </div>
        </div>
    </div>

    {{-- INPUT NILAI CARD --}}
    <div class="form-card">
        <div class="card-head">
            <div class="card-head-dot dot-green"></div>
            <span class="card-head-label">Input Nilai</span>
        </div>

        <form action="{{ route('guru.nilai.storeBatch') }}" method="POST">
            @csrf
            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

            <div class="table-responsive">
                <table class="nilai-input-table">
                    <thead>
                        <tr>
                            <th class="cell-no">No</th>
                            <th>Nama Siswa</th>
                            <th style="text-align:center;">Nilai</th>
                        </tr>
                    </thead>
                    <tbody id="data-siswa">
                        <tr>
                            <td colspan="3">
                                <div class="table-placeholder">
                                    <div class="placeholder-icon">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m4 5.87a4 4 0 110-8 4 4 0 010 8zm6-12a4 4 0 10-8 0 4 4 0 008 0z"/>
                                        </svg>
                                    </div>
                                    <p class="placeholder-text">Pilih kelas terlebih dahulu untuk memuat daftar siswa</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer-p">
                <span class="footer-info" id="siswaCount">Pilih kelas untuk mulai</span>
                <button type="submit" class="btn-save" id="btnSave" style="display:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>

</div>
</div>

<script>
document.getElementById('kelas').addEventListener('change', function() {
    let kelas_id = this.value;
    if (!kelas_id) {
        document.getElementById('data-siswa').innerHTML = `
            <tr><td colspan="3"><div class="table-placeholder">
                <div class="placeholder-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width:24px;height:24px;color:var(--text-muted)"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m4 5.87a4 4 0 110-8 4 4 0 010 8zm6-12a4 4 0 10-8 0 4 4 0 008 0z"/></svg></div>
                <p class="placeholder-text">Pilih kelas terlebih dahulu untuk memuat daftar siswa</p>
            </div></td></tr>`;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('siswaCount').textContent = 'Pilih kelas untuk mulai';
        return;
    }
    fetch('/guru/get-siswa/' + kelas_id)
        .then(res => res.json())
        .then(data => {
            let html = '';
            if (data.length === 0) {
                html = `<tr><td colspan="3"><div class="table-placeholder"><p class="placeholder-text">Tidak ada siswa di kelas ini</p></div></td></tr>`;
                document.getElementById('btnSave').style.display = 'none';
                document.getElementById('siswaCount').textContent = '0 siswa';
            } else {
                let no = 1;
                data.forEach(siswa => {
                    const initials = siswa.nama.substring(0, 2).toUpperCase();
                    html += `
                    <tr>
                        <td class="cell-no">${no++}</td>
                        <td>
                            <div class="name-cell">
                                <div class="name-avatar">${initials}</div>
                                <span style="font-weight:600;">${siswa.nama}</span>
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <input type="number" name="nilai[${siswa.id}]" class="nilai-input" min="0" max="100" required placeholder="0">
                        </td>
                    </tr>`;
                });
                document.getElementById('btnSave').style.display = 'inline-flex';
                document.getElementById('siswaCount').textContent = data.length + ' siswa siap diinput';
            }
            document.getElementById('data-siswa').innerHTML = html;
        });
});
</script>

@endsection