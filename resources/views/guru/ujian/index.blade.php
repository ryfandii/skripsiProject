@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
:root {
    --primary:#4F46E5;--primary-dark:#3730A3;--primary-light:#EEF2FF;
    --success:#059669;--success-light:#ECFDF5;
    --warning:#D97706;--warning-light:#FFFBEB;
    --danger:#DC2626;--danger-light:#FEF2F2;
    --info:#0284C7;--info-light:#F0F9FF;
    --neutral-light:#F9FAFB;--bg:#F3F4F8;--surface:#FFFFFF;
    --border:#E5E7EB;--text-dark:#111827;--text-mid:#374151;--text-soft:#6B7280;
    --radius-md:10px;--radius-lg:16px;
}
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
#content{padding:0!important;background:var(--bg)!important;}
#content-wrapper{background:var(--bg)!important;}
.sw-page{padding:28px 32px;background:var(--bg);min-height:calc(100vh - 70px);}
.sw-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;gap:16px;flex-wrap:wrap;}
.sw-topbar h3{font-size:21px;font-weight:800;color:var(--text-dark);margin:0 0 3px;letter-spacing:-.3px;}
.sw-topbar p{font-size:13px;color:var(--text-soft);margin:0;}
.sw-btn{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:var(--radius-md);font-size:13.5px;font-weight:700;border:none;cursor:pointer;text-decoration:none;transition:all .18s ease;line-height:1;font-family:'Plus Jakarta Sans',sans-serif;}
.sw-btn-primary{background:var(--primary);color:#fff;box-shadow:0 4px 14px rgba(79,70,229,.3);}
.sw-btn-primary:hover{background:var(--primary-dark);color:#fff;transform:translateY(-1px);}
.sw-btn-sm{padding:7px 13px;font-size:12.5px;border-radius:8px;}
.sw-btn-warning{background:var(--warning-light);color:var(--warning);border:1px solid #FDE68A;}
.sw-btn-warning:hover{background:var(--warning);color:#fff;}
.sw-btn-danger{background:var(--danger-light);color:var(--danger);border:1px solid #FECACA;}
.sw-btn-danger:hover{background:var(--danger);color:#fff;}
.sw-btn-success{background:var(--success);color:#fff;box-shadow:0 4px 14px rgba(5,150,105,.3);}
.sw-btn-success:hover{background:#047857;color:#fff;transform:translateY(-1px);}
.sw-btn-info{background:var(--info-light);color:var(--info);border:1px solid #BAE6FD;}
.sw-btn-info:hover{background:var(--info);color:#fff;}
.sw-card{background:var(--surface);border-radius:var(--radius-lg);border:1px solid var(--border);box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;margin-bottom:22px;}
.sw-card-hd{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:linear-gradient(135deg,#F5F3FF 0%,#EEF2FF 100%);}
.sw-card-hd-left{display:flex;align-items:center;gap:10px;}
.sw-card-hd-icon{width:34px;height:34px;border-radius:9px;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;}
.sw-card-hd h6{font-size:14px;font-weight:700;color:#3730A3;margin:0;}
.sw-card-hd p{font-size:11.5px;color:#6D6AA4;margin:2px 0 0;}
.sw-count-badge{background:var(--primary-light);border:1px solid #C7D2FE;border-radius:99px;padding:3px 12px;font-size:12px;font-weight:700;color:var(--primary);}
.sw-ujian-list{padding:8px 0;}
.sw-ujian-item{display:flex;align-items:center;gap:18px;padding:18px 22px;border-bottom:1px solid var(--border);transition:background .15s;flex-wrap:wrap;}
.sw-ujian-item:last-child{border-bottom:none;}
.sw-ujian-item:hover{background:#FAFAFF;}
.sw-ujian-icon{width:46px;height:46px;border-radius:12px;background:var(--primary-light);border:1px solid #C7D2FE;display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;}
.sw-ujian-info{flex:1;min-width:0;}
.sw-ujian-title{font-size:15px;font-weight:700;color:var(--text-dark);margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.sw-ujian-meta{display:flex;gap:10px;flex-wrap:wrap;}
.sw-meta-chip{display:inline-flex;align-items:center;gap:5px;background:var(--neutral-light);border:1px solid var(--border);border-radius:7px;padding:3px 10px;font-size:11.5px;font-weight:600;color:var(--text-soft);}
.sw-jenis{display:inline-flex;align-items:center;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:800;letter-spacing:.5px;}
.sw-jenis-uts{background:var(--info-light);border:1px solid #BAE6FD;color:var(--info);}
.sw-jenis-uas{background:var(--warning-light);border:1px solid #FDE68A;color:var(--warning);}
.sw-status-draft{display:inline-flex;align-items:center;gap:5px;background:#F3F4F6;border:1px solid #D1D5DB;border-radius:99px;padding:3px 10px;font-size:11px;font-weight:700;color:#6B7280;}
.sw-status-kirim{display:inline-flex;align-items:center;gap:5px;background:var(--success-light);border:1px solid #A7F3D0;border-radius:99px;padding:3px 10px;font-size:11px;font-weight:700;color:var(--success);}
.sw-ujian-actions{display:flex;gap:8px;align-items:center;flex-shrink:0;flex-wrap:wrap;}
.sw-empty{padding:70px 20px;text-align:center;}
.sw-empty-ring{width:80px;height:80px;border-radius:50%;background:var(--primary-light);border:2px solid #C7D2FE;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;color:var(--primary);}
.sw-empty h5{font-size:16px;font-weight:700;color:var(--text-dark);margin-bottom:6px;}
.sw-empty p{font-size:13px;color:var(--text-soft);margin-bottom:20px;}

/* NILAI SECTION */
.sw-nilai-card{background:var(--surface);border-radius:var(--radius-lg);border:1px solid var(--border);box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.sw-nilai-hd{display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid var(--border);background:linear-gradient(135deg,#ECFDF5,#D1FAE5);}
.sw-nilai-filter{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
.sw-select-kelas{padding:8px 14px;border:1.5px solid var(--border);border-radius:var(--radius-md);font-size:13px;font-weight:600;color:var(--text-dark);background:var(--neutral-light);font-family:'Plus Jakarta Sans',sans-serif;outline:none;}
.sw-select-kelas:focus{border-color:var(--success);box-shadow:0 0 0 3px rgba(5,150,105,.1);}
.sw-table{width:100%;border-collapse:collapse;}
.sw-table th{padding:11px 16px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-soft);background:var(--neutral-light);border-bottom:1px solid var(--border);text-align:left;}
.sw-table td{padding:12px 16px;font-size:13.5px;color:var(--text-mid);border-bottom:1px solid var(--border);}
.sw-table tr:last-child td{border-bottom:none;}
.sw-table tr:hover td{background:#FAFAFF;}
.sw-nilai-badge{display:inline-flex;align-items:center;justify-content:center;min-width:44px;padding:4px 10px;border-radius:99px;font-size:13px;font-weight:800;}
.n-a{background:#DCFCE7;color:#166534;}
.n-b{background:#FEF9C3;color:#854D0E;}
.n-c{background:#FEE2E2;color:#991B1B;}

@media(max-width:768px){
    .sw-page{padding:14px;}
    .sw-ujian-actions{width:100%;justify-content:flex-end;}
}
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <div>
            <h3>Manajemen Ujian</h3>
            <p>Kelola ujian dan pantau nilai siswa</p>
        </div>
        <a href="{{ route('guru.ujian.create') }}" class="sw-btn sw-btn-primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Ujian
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div style="display:flex;align-items:center;gap:10px;background:var(--success-light);border:1px solid #A7F3D0;border-radius:var(--radius-md);padding:13px 16px;margin-bottom:20px;font-size:13px;font-weight:600;color:var(--success);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- DAFTAR UJIAN --}}
    <div class="sw-card">
        <div class="sw-card-hd">
            <div class="sw-card-hd-left">
                <div class="sw-card-hd-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </div>
                <div>
                    <h6>Daftar Ujian</h6>
                    <p>Semua ujian yang telah dibuat</p>
                </div>
            </div>
            <span class="sw-count-badge">{{ $data->count() }} Ujian</span>
        </div>

        <div class="sw-ujian-list">
            @forelse($data as $u)
            <div class="sw-ujian-item">
                <div class="sw-ujian-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>

                <div class="sw-ujian-info">
                    <div class="sw-ujian-title">{{ $u->judul }}</div>
                    <div class="sw-ujian-meta">
                        @if($u->jenis)
                        <span class="sw-jenis {{ $u->jenis == 'UTS' ? 'sw-jenis-uts' : 'sw-jenis-uas' }}">
                            {{ $u->jenis }}
                        </span>
                        @endif

                        {{-- STATUS KIRIM --}}
                        @if($u->status_kirim == 'terkirim')
                        <span class="sw-status-kirim">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg>
                            Terkirim ke Siswa
                        </span>
                        @else
                        <span class="sw-status-draft">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Draft
                        </span>
                        @endif

                        <span class="sw-meta-chip">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $u->durasi ?? '-' }} menit
                        </span>

                        {{-- KELAS --}}
                        @foreach($u->kelas as $k)
                        <span class="sw-meta-chip" style="background:var(--primary-light);border-color:#C7D2FE;color:var(--primary);">
                            {{ $k->nama_kelas }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="sw-ujian-actions">
                    {{-- Tombol Kirim (hanya kalau masih draft) --}}
                    @if($u->status_kirim == 'draft')
                    <form action="{{ route('guru.ujian.kirim', $u->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Kirim ujian ini ke semua kelas yang dipilih?')">
                        @csrf
                        <button type="submit" class="sw-btn sw-btn-sm sw-btn-success">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg>
                            Kirim ke Siswa
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('guru.ujian.edit', $u->id) }}" class="sw-btn sw-btn-sm sw-btn-warning">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit
                    </a>

                    <form action="{{ route('guru.ujian.destroy', $u->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus ujian ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sw-btn sw-btn-sm sw-btn-danger">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="sw-empty">
                <div class="sw-empty-ring">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <h5>Belum Ada Ujian</h5>
                <p>Klik tombol di atas untuk membuat ujian pertama</p>
                <a href="{{ route('guru.ujian.create') }}" class="sw-btn sw-btn-primary">+ Buat Ujian</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ══ NILAI SISWA ══ --}}
    <div class="sw-nilai-card">
        <div class="sw-nilai-hd">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:34px;height:34px;border-radius:9px;background:var(--success);color:#fff;display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                </div>
                <div>
                    <div style="font-size:14px;font-weight:700;color:#065F46;">Nilai Siswa</div>
                    <div style="font-size:11.5px;color:#047857;margin-top:2px;">Filter berdasarkan kelas</div>
                </div>
            </div>

            {{-- FILTER KELAS --}}
            <form method="GET" action="{{ route('guru.ujian.index') }}" style="display:flex;gap:8px;align-items:center;">
                <select name="kelas_id" class="sw-select-kelas" onchange="this.form.submit()">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasList as $k)
                    <option value="{{ $k->id }}" {{ $selectedKelas == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
                @if($selectedKelas)
                <a href="{{ route('guru.ujian.index') }}" style="font-size:12px;color:var(--text-soft);text-decoration:none;font-weight:600;">✕ Reset</a>
                @endif
            </form>
        </div>

        @if($selectedKelas && $nilaiSiswa->count())
        <table class="sw-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Ujian</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiSiswa as $i => $n)
                <tr>
                    <td style="color:var(--text-soft);font-weight:600;">{{ $i + 1 }}</td>
                    <td style="font-weight:700;color:var(--text-dark);">{{ $n->siswa->nama ?? '-' }}</td>
                    <td>{{ $n->ujian->judul ?? '-' }}</td>
                    <td>
                        @if($n->ujian && $n->ujian->jenis)
                        <span class="sw-jenis {{ $n->ujian->jenis == 'UTS' ? 'sw-jenis-uts' : 'sw-jenis-uas' }}">
                            {{ $n->ujian->jenis }}
                        </span>
                        @endif
                    </td>
                    <td>
                        @php $v = $n->nilai; @endphp
                        <span class="sw-nilai-badge {{ $v >= 75 ? 'n-a' : ($v >= 60 ? 'n-b' : 'n-c') }}">
                            {{ $v }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @elseif($selectedKelas)
        <div style="padding:40px;text-align:center;color:var(--text-soft);font-size:13px;font-weight:600;">
            Belum ada siswa yang mengerjakan ujian di kelas ini.
        </div>
        @else
        <div style="padding:40px;text-align:center;color:var(--text-soft);font-size:13px;font-weight:600;">
            Pilih kelas di atas untuk melihat nilai siswa.
        </div>
        @endif
    </div>

</div>
@endsection