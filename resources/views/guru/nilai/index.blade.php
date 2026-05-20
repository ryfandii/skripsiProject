@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root {
    --primary:#2563eb; --primary-light:#eff6ff; --primary-border:#bfdbfe; --primary-dark:#1d4ed8;
    --success:#16a34a; --success-light:#f0fdf4; --success-border:#bbf7d0;
    --warning:#d97706; --warning-light:#fffbeb; --warning-border:#fde68a;
    --danger:#dc2626; --danger-light:#fef2f2; --danger-border:#fecaca;
    --violet:#7c3aed; --violet-light:#f5f3ff; --violet-border:#ddd6fe;
    --text-primary:#0f172a; --text-secondary:#475569; --text-muted:#94a3b8;
    --surface:#ffffff; --surface-secondary:#f8fafc; --border:#e2e8f0;
    --shadow-md:0 4px 20px rgba(0,0,0,0.08);
    --radius-sm:6px; --radius-md:10px; --radius-lg:14px; --radius-xl:18px;
}
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
.page-wrapper{animation:fadeUp 0.4s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

/* HEADER */
.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;gap:16px;flex-wrap:wrap;}
.page-header-left{display:flex;align-items:center;gap:14px;}
.page-icon{width:50px;height:50px;border-radius:var(--radius-lg);background:var(--primary-light);border:1px solid var(--primary-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.page-icon svg{width:24px;height:24px;color:var(--primary);}
.page-title{font-size:22px;font-weight:700;color:var(--text-primary);margin:0 0 2px;}
.page-subtitle{font-size:13px;color:var(--text-secondary);margin:0;}

/* BUTTONS — ikon dikunci 14px agar tidak meluap */
.btn-primary{display:inline-flex;align-items:center;gap:7px;padding:10px 18px;font-size:13px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--primary);color:#fff;border:none;border-radius:var(--radius-md);text-decoration:none;cursor:pointer;transition:all .15s;box-shadow:0 2px 8px rgba(37,99,235,0.25);}
.btn-primary:hover{background:var(--primary-dark);color:#fff;text-decoration:none;transform:translateY(-1px);}
.btn-primary svg{width:14px;height:14px;flex-shrink:0;}

.btn-success{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;font-size:13px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--success);color:#fff;border:none;border-radius:var(--radius-md);cursor:pointer;transition:all .15s;box-shadow:0 2px 8px rgba(22,163,74,0.25);}
.btn-success:hover{background:#15803d;transform:translateY(-1px);}
.btn-success svg{width:14px;height:14px;flex-shrink:0;}

.btn-violet{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;font-size:13px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--violet);color:#fff;border:none;border-radius:var(--radius-md);cursor:pointer;transition:all .15s;box-shadow:0 2px 8px rgba(124,58,237,0.25);}
.btn-violet:hover{background:#6d28d9;transform:translateY(-1px);}
.btn-violet svg{width:14px;height:14px;flex-shrink:0;}

.btn-warning-sm{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;font-size:12px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--warning-light);color:var(--warning);border:1px solid var(--warning-border);border-radius:var(--radius-sm);text-decoration:none;cursor:pointer;transition:all .15s;}
.btn-warning-sm:hover{background:#fef3c7;color:var(--warning);text-decoration:none;}
.btn-warning-sm svg{width:13px;height:13px;flex-shrink:0;}

/* TOAST ALERT — menggantikan alert full-page */
.toast-container{position:fixed;top:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:10px;}
.toast{display:flex;align-items:center;gap:12px;padding:14px 18px;border-radius:var(--radius-lg);font-size:13.5px;font-weight:600;max-width:360px;box-shadow:0 8px 30px rgba(0,0,0,0.12);animation:toastIn 0.35s cubic-bezier(.34,1.56,.64,1) both;}
@keyframes toastIn{from{opacity:0;transform:translateX(60px)}to{opacity:1;transform:translateX(0)}}
.toast.toast-success{background:#fff;border:1px solid var(--success-border);color:var(--success);}
.toast-icon{width:32px;height:32px;border-radius:50%;background:var(--success-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.toast-icon svg{width:16px;height:16px;color:var(--success);}
.toast-close{margin-left:auto;background:none;border:none;cursor:pointer;color:var(--text-muted);padding:2px;display:flex;align-items:center;border-radius:4px;transition:color .15s;}
.toast-close:hover{color:var(--text-primary);}
.toast-close svg{width:14px;height:14px;}

/* ALERT inline (fallback jika tidak pakai toast) */
.alert-success{display:flex;align-items:center;gap:10px;background:var(--success-light);border:1px solid var(--success-border);border-radius:var(--radius-md);padding:12px 16px;margin-bottom:18px;font-size:13px;font-weight:600;color:var(--success);}
.alert-success svg{width:16px;height:16px;flex-shrink:0;}

/* FILTER BAR */
.filter-row{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap;}
.filter-select{padding:8px 32px 8px 12px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid var(--border);border-radius:var(--radius-md);background:var(--surface);color:var(--text-primary);outline:none;appearance:none;cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;background-size:14px;transition:border-color .2s;}
.filter-select:focus{border-color:var(--primary);}
.filter-label{font-size:13px;font-weight:600;color:var(--text-secondary);}

/* CARD */
.section-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-xl);box-shadow:var(--shadow-md);overflow:hidden;margin-bottom:22px;}
.card-toolbar{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:var(--surface-secondary);flex-wrap:wrap;gap:10px;}
.toolbar-title{font-size:13.5px;font-weight:600;color:var(--text-primary);display:flex;align-items:center;gap:8px;}
.toolbar-badge{background:var(--primary-light);color:var(--primary);border:1px solid var(--primary-border);border-radius:999px;font-size:11.5px;font-weight:600;padding:2px 10px;}

/* TABLE */
.table-responsive{overflow-x:auto;}
table.nilai-table{width:100%;border-collapse:collapse;min-width:700px;}
.nilai-table thead tr{background:var(--surface-secondary);border-bottom:1px solid var(--border);}
.nilai-table thead th{padding:11px 16px;font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.7px;text-align:left;white-space:nowrap;}
.nilai-table thead th.c{text-align:center;}
.nilai-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s;}
.nilai-table tbody tr:last-child{border-bottom:none;}
.nilai-table tbody tr:hover{background:#f8faff;}
.nilai-table tbody td{padding:13px 16px;font-size:13.5px;color:var(--text-primary);vertical-align:middle;}
.nilai-table tbody td.c{text-align:center;}

/* BADGES */
.name-cell{display:flex;align-items:center;gap:10px;}
.name-avatar{width:34px;height:34px;border-radius:50%;background:var(--primary-light);border:1px solid var(--primary-border);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--primary);flex-shrink:0;}
.badge-kelas{background:var(--primary-light);color:var(--primary);border:1px solid var(--primary-border);border-radius:999px;font-size:11.5px;font-weight:600;padding:3px 11px;display:inline-flex;}
.chip-nilai{display:inline-flex;align-items:center;justify-content:center;min-width:46px;padding:4px 10px;border-radius:var(--radius-sm);font-size:13px;font-weight:700;}
.chip-a{background:var(--success-light);color:var(--success);border:1px solid var(--success-border);}
.chip-b{background:var(--primary-light);color:var(--primary);border:1px solid var(--primary-border);}
.chip-c{background:var(--warning-light);color:var(--warning);border:1px solid var(--warning-border);}
.chip-d{background:var(--danger-light);color:var(--danger);border:1px solid var(--danger-border);}
.chip-null{background:var(--surface-secondary);color:var(--text-muted);border:1px solid var(--border);}
.badge-kirim{background:var(--success-light);color:var(--success);border:1px solid var(--success-border);border-radius:999px;font-size:11px;font-weight:700;padding:2px 9px;display:inline-flex;align-items:center;gap:4px;}
.badge-kirim::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--success);}
.badge-belum{background:var(--surface-secondary);color:var(--text-muted);border:1px solid var(--border);border-radius:999px;font-size:11px;font-weight:600;padding:2px 9px;display:inline-flex;}

/* EMPTY */
.empty-state{padding:56px 24px;text-align:center;}
.empty-icon{width:56px;height:56px;background:var(--surface-secondary);border-radius:50%;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;}
.empty-icon svg{width:24px;height:24px;color:var(--text-muted);}
.empty-title{font-size:15px;font-weight:600;color:var(--text-primary);margin-bottom:4px;}
.empty-desc{font-size:13px;color:var(--text-muted);}

/* TABLE FOOTER */
.table-footer{display:flex;align-items:center;justify-content:space-between;padding:13px 22px;border-top:1px solid var(--border);background:var(--surface-secondary);font-size:12.5px;color:var(--text-muted);flex-wrap:wrap;gap:6px;}
.table-footer .btn-violet svg{width:13px;height:13px;}

/* INFO BOX */
.info-box{display:flex;align-items:flex-start;gap:10px;background:var(--primary-light);border:1px solid var(--primary-border);border-radius:var(--radius-md);padding:12px 16px;margin-bottom:18px;font-size:13px;color:var(--primary);}
.info-box svg{width:16px;height:16px;flex-shrink:0;margin-top:1px;}
</style>

{{-- TOAST ALERT (pojok kanan atas, auto-dismiss 4 detik) --}}
@if(session('success'))
<div class="toast-container" id="toastContainer">
    <div class="toast toast-success" id="toastSuccess">
        <div class="toast-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <span>{{ session('success') }}</span>
        <button class="toast-close" onclick="dismissToast()">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
<script>
function dismissToast(){
    var t=document.getElementById('toastSuccess');
    if(t){t.style.transition='all .3s ease';t.style.opacity='0';t.style.transform='translateX(60px)';setTimeout(function(){t.remove();},300);}
}
setTimeout(dismissToast, 4000);
</script>
@endif

<div class="container-fluid px-4 py-2 page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h4 class="page-title">Menu Nilai</h4>
                <p class="page-subtitle">Rekap nilai tugas, UTS, UAS &amp; hitung rata-rata siswa</p>
            </div>
        </div>
        <!-- <a href="{{ route('guru.nilai.input') }}" class="btn-primary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Input Nilai Manual
        </a> -->
    </div>

    {{-- INFO --}}
    <div class="info-box">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Nilai tugas &amp; ujian otomatis masuk sini saat diklik "Masukkan ke Menu Nilai" di menu Tugas atau Ujian. Setelah semua terisi, pilih kelas → klik <strong>Hitung Rata-Rata</strong> → lalu <strong>Kirim ke Siswa</strong>.</span>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('guru.nilai.index') }}" id="filterForm">
        <div class="filter-row">
            <span class="filter-label">Filter Kelas:</span>
            <select name="kelas_id" class="filter-select" onchange="document.getElementById('filterForm').submit()" style="width:200px;">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>

            @if(request('kelas_id'))
            <span class="filter-label" style="margin-left:10px;">Filter Siswa:</span>
            <select name="siswa_id" class="filter-select" onchange="document.getElementById('filterForm').submit()" style="width:220px;">
                <option value="">Semua Siswa</option>
                @foreach($siswaList as $s)
                <option value="{{ $s->id }}" {{ request('siswa_id') == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                @endforeach
            </select>
            @endif

            @if(request('kelas_id') || request('siswa_id'))
            <a href="{{ route('guru.nilai.index') }}" style="font-size:12.5px;color:var(--text-muted);font-weight:600;text-decoration:none;">✕ Reset</a>
            @endif
        </div>
    </form>

    {{-- TABEL NILAI --}}
    <div class="section-card">
        <div class="card-toolbar">
            <span class="toolbar-title">
                Daftar Nilai
                <span class="toolbar-badge">{{ $nilai->count() }} data</span>
            </span>
            @if(request('kelas_id'))
            <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                {{-- TOMBOL HITUNG RATA-RATA --}}
                <form action="{{ route('guru.nilai.hitungRata') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
                    <button type="submit" class="btn-success" onclick="return confirm('Hitung rata-rata nilai untuk kelas ini?')">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Hitung Rata-Rata
                    </button>
                </form>
                {{-- TOMBOL KIRIM KE KELAS INI --}}
                <form action="{{ route('guru.nilai.kirimKeSiswa') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
                    <button type="submit" class="btn-violet" onclick="return confirm('Kirim nilai ke siswa kelas ini? Siswa akan bisa melihat nilai mereka.')">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim ke Kelas Ini
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="nilai-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th class="c">Nilai Tugas</th>
                        <th class="c">Nilai UTS</th>
                        <th class="c">Nilai UAS</th>
                        <th class="c">Rata-Rata</th>
                        <th class="c">Status Kirim</th>
                        <th class="c">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilai as $n)
                    @php
                        $rata = $n->nilai_akhir;
                        $rataClass = !$rata ? 'chip-null' : ($rata >= 85 ? 'chip-a' : ($rata >= 70 ? 'chip-b' : ($rata >= 55 ? 'chip-c' : 'chip-d')));
                        $tugasClass = !$n->nilai_tugas ? 'chip-null' : ($n->nilai_tugas >= 85 ? 'chip-a' : ($n->nilai_tugas >= 70 ? 'chip-b' : ($n->nilai_tugas >= 55 ? 'chip-c' : 'chip-d')));
                        $utsClass   = !$n->nilai_uts   ? 'chip-null' : ($n->nilai_uts   >= 85 ? 'chip-a' : ($n->nilai_uts   >= 70 ? 'chip-b' : ($n->nilai_uts   >= 55 ? 'chip-c' : 'chip-d')));
                        $uasClass   = !$n->nilai_uas   ? 'chip-null' : ($n->nilai_uas   >= 85 ? 'chip-a' : ($n->nilai_uas   >= 70 ? 'chip-b' : ($n->nilai_uas   >= 55 ? 'chip-c' : 'chip-d')));
                    @endphp
                    <tr>
                        <td style="font-size:12.5px;color:var(--text-muted);">{{ $loop->iteration }}</td>
                        <td>
                            <div class="name-cell">
                                <div class="name-avatar">{{ strtoupper(substr($n->siswa->nama ?? 'S', 0, 2)) }}</div>
                                <span style="font-weight:600;">{{ $n->siswa->nama ?? '—' }}</span>
                            </div>
                        </td>
                        <td><span class="badge-kelas">{{ $n->siswa->kelas->nama_kelas ?? '—' }}</span></td>
                        <td class="c"><span class="chip-nilai {{ $tugasClass }}">{{ $n->nilai_tugas ?? '—' }}</span></td>
                        <td class="c"><span class="chip-nilai {{ $utsClass }}">{{ $n->nilai_uts ?? '—' }}</span></td>
                        <td class="c"><span class="chip-nilai {{ $uasClass }}">{{ $n->nilai_uas ?? '—' }}</span></td>
                        <td class="c"><span class="chip-nilai {{ $rataClass }}">{{ $rata ?? '—' }}</span></td>
                        <td class="c">
                            @if($n->sudah_kirim)
                                <span class="badge-kirim">Sudah Dikirim</span>
                            @else
                                <span class="badge-belum">Belum</span>
                            @endif
                        </td>
                        <td class="c">
                            <a href="{{ route('guru.nilai.edit', $n->id) }}" class="btn-warning-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 012.828 2.828L11.828 15.828a2 2 0 01-1.414.586H8v-2.414a2 2 0 01.586-1.414z"/></svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                </div>
                                <div class="empty-title">Belum ada data nilai</div>
                                <div class="empty-desc">Masukkan nilai dari menu Tugas atau Ujian terlebih dahulu.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER + TOMBOL KIRIM SEMUA KELAS --}}
       <div class="table-footer">
    <span>{{ $nilai->count() }} data nilai</span>
    <div style="display:flex;align-items:center;gap:10px;">
        <span>{{ now()->format('d M Y') }}</span>
        {{-- ✅ Hanya tampil jika TIDAK ada filter kelas --}}
        @if(!request('kelas_id'))
        <form action="{{ route('guru.nilai.kirimKeSiswa') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-violet" style="padding:7px 14px;font-size:12.5px;"
                onclick="return confirm('Kirim nilai ke SEMUA kelas? Siswa di semua kelas akan bisa melihat nilai mereka.')">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Kirim ke Semua Kelas
            </button>
        </form>
        @endif
    </div>
</div>
    </div>

</div>
@endsection