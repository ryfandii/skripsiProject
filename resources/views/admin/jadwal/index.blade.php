{{-- ================================================================
     FILE: resources/views/admin/jadwal/index.blade.php
     ================================================================ --}}

@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --brand:        #1a56db;
        --brand-light:  #e8f0fe;
        --brand-dark:   #1648c0;
        --success:      #0d9488;
        --success-light:#ccfbf1;
        --danger:       #dc2626;
        --danger-light: #fee2e2;
        --warning:      #d97706;
        --warning-light:#fef3c7;
        --page-bg:      #f4f6fa;
        --surface:      #ffffff;
        --border:       rgba(0,0,0,0.07);
        --border-md:    rgba(0,0,0,0.12);
        --text-1:       #111827;
        --text-2:       #6b7280;
        --text-3:       #9ca3af;
        --r-sm: 8px; --r-md: 12px; --r-lg: 16px;
        --sh-sm: 0 1px 4px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.04);
        --sh-md: 0 4px 16px rgba(0,0,0,.08);
    }

    *, *::before, *::after {
    box-sizing: border-box;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

    .jd-wrap { background: var(--page-bg); min-height: 100vh; padding: 28px 32px 56px; }

    /* header */
    .jd-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; }
    .jd-header-left .eyebrow { font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--brand); margin-bottom: 4px; }
    .jd-header-left h1 { font-size: 24px; font-weight: 700; color: var(--text-1); margin: 0; letter-spacing: -.4px; }
    .jd-header-left p  { font-size: 13px; color: var(--text-2); margin: 4px 0 0; }

    .btn-add {
        display: inline-flex; align-items: center; gap: 7px;
        background: var(--brand); color: #fff; border: none;
        border-radius: var(--r-sm); padding: 10px 20px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; transition: all .15s ease;
        box-shadow: 0 2px 8px rgba(26,86,219,.25); white-space: nowrap;
    }
    .btn-add:hover { background: var(--brand-dark); transform: translateY(-1px); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,.35); }
    .btn-add i { font-size: 11px; }

    /* alert */
    .jd-alert {
        display: flex; align-items: center; gap: 12px;
        background: var(--success-light); border: 1px solid rgba(13,148,136,.2);
        border-left: 4px solid var(--success); border-radius: var(--r-md);
        padding: 13px 16px; margin-bottom: 20px;
        font-size: 13px; font-weight: 500; color: #065f46; position: relative;
    }
    .jd-alert-close { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #065f46; font-size: 18px; opacity: .6; }
    .jd-alert-close:hover { opacity: 1; }

    /* filter card */
    .filter-card {
        background: var(--surface); border-radius: var(--r-lg);
        border: 1px solid var(--border); box-shadow: var(--sh-sm);
        padding: 16px 20px; margin-bottom: 16px;
        display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    }
    .filter-label { font-size: 12px; font-weight: 700; color: var(--text-3); text-transform: uppercase; letter-spacing: .08em; white-space: nowrap; }
    .filter-select {
        flex: 1; min-width: 200px; max-width: 300px;
        padding: 9px 13px; border: 1.5px solid var(--border);
        border-radius: var(--r-sm); font-size: 13px; color: var(--text-1);
        background: #f8fafc; outline: none; cursor: pointer;
        transition: border-color .15s, box-shadow .15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .filter-select:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(26,86,219,.1); background: #fff; }
    .btn-filter {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 16px; border-radius: var(--r-sm);
        font-size: 13px; font-weight: 600; cursor: pointer;
        border: none; text-decoration: none; transition: all .13s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-filter.primary { background: var(--brand); color: #fff; }
    .btn-filter.primary:hover { background: var(--brand-dark); color: #fff; }
    .btn-filter.reset { background: #f8fafc; color: var(--text-2); border: 1.5px solid var(--border-md); }
    .btn-filter.reset:hover { background: #eef2f6; color: var(--text-1); }
    .btn-filter i { font-size: 11px; }

    /* info banner */
    .filter-info {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--brand-light); border: 1px solid rgba(26,86,219,.15);
        border-radius: var(--r-sm); padding: 8px 14px;
        font-size: 13px; font-weight: 500; color: var(--brand);
        margin-bottom: 16px;
    }

    /* table card */
    .jd-card { background: var(--surface); border-radius: var(--r-lg); border: 1px solid var(--border); box-shadow: var(--sh-sm); overflow: hidden; }
    .jd-card-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 15px 20px; border-bottom: 1px solid var(--border); }
    .jd-count { font-size: 13px; font-weight: 600; color: var(--text-2); }
    .jd-count strong { color: var(--text-1); font-weight: 700; }

    /* table */
    .jd-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    .jd-table thead tr { background: #f8fafc; border-bottom: 1px solid var(--border); }
    .jd-table thead th { padding: 12px 16px; font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-3); white-space: nowrap; border: none; }
    .jd-table thead th:first-child { padding-left: 20px; }
    .jd-table thead th:last-child  { padding-right: 20px; text-align: right; }
    .jd-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .jd-table tbody tr:last-child { border-bottom: none; }
    .jd-table tbody tr:hover { background: #f8fafc; }
    .jd-table td { padding: 13px 16px; color: var(--text-1); vertical-align: middle; border: none; }
    .jd-table td:first-child { padding-left: 20px; }
    .jd-table td:last-child  { padding-right: 20px; }

    .cell-no { font-family: 'DM Mono', monospace; font-size: 12px; color: var(--text-3); font-weight: 500; width: 44px; }
    .cell-mapel { font-weight: 600; color: var(--text-1); }
    .cell-muted { color: var(--text-2); font-size: 13px; }

    /* hari pills */
    .hari-pill {
        display: inline-flex; align-items: center; padding: 3px 10px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
    }
    .hari-senin    { background: #eff6ff; color: #1d4ed8; }
    .hari-selasa   { background: #f0fdf4; color: #15803d; }
    .hari-rabu     { background: #fefce8; color: #a16207; }
    .hari-kamis    { background: #fdf4ff; color: #9333ea; }
    .hari-jumat    { background: #fff7ed; color: #c2410c; }
    .hari-default  { background: #f1f5f9; color: #475569; }

    /* jam badge */
    .jam-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-family: 'DM Mono', monospace; font-size: 12.5px;
        font-weight: 500; color: var(--text-2);
        background: #f8fafc; border: 1px solid var(--border);
        border-radius: 6px; padding: 3px 9px;
    }
    .jam-badge i { font-size: 10px; color: var(--text-3); }

    /* kelas pill */
    .kelas-pill { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; background: var(--brand-light); color: var(--brand); border: 1px solid rgba(26,86,219,.15); }

    /* guru pill */
    .guru-pill { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 500; color: var(--text-1); }
    .guru-avatar { width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #1a56db, #6366f1); color: #fff; font-size: 9px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

    /* action buttons */
    .action-group { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
    .btn-act { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer; text-decoration: none; border: 1px solid; transition: all .12s ease; white-space: nowrap; font-family: 'Plus Jakarta Sans', sans-serif; background: none; }
    .btn-act i { font-size: 10px; }
    .btn-edit  { background: #f8fafc; border-color: var(--border-md); color: var(--text-1); }
    .btn-edit:hover { background: #eef2f6; color: var(--text-1); }
    .btn-del   { background: #fff5f5; border-color: rgba(220,38,38,.18); color: var(--danger); }
    .btn-del:hover { background: var(--danger-light); border-color: rgba(220,38,38,.35); color: var(--danger); }

    /* empty */
    .empty-state { padding: 52px 24px; text-align: center; }
    .empty-icon { width: 54px; height: 54px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: var(--text-3); font-size: 22px; }
    .empty-state p { font-size: 14px; color: var(--text-2); font-weight: 500; margin: 0 0 4px; }
    .empty-state small { font-size: 12px; color: var(--text-3); }

    @media (max-width: 768px) {
        .jd-wrap { padding: 20px 16px 40px; }
        .jd-header { flex-direction: column; align-items: flex-start; gap: 14px; }
        .jd-scroll { overflow-x: auto; }
    }
</style>

<div class="jd-wrap">

    {{-- HEADER --}}
    <div class="jd-header">
        <div class="jd-header-left">
            <div class="eyebrow">Akademik</div>
            <h1>Data Jadwal</h1>
            <p>Pengelolaan jadwal SMA Negeri 1 Bondowoso</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="jd-alert" id="jdAlert">
            <i class="fas fa-check-circle" style="font-size:15px;flex-shrink:0;"></i>
            {{ session('success') }}
            <button class="jd-alert-close" onclick="document.getElementById('jdAlert').remove()">&times;</button>
        </div>
    @endif

    {{-- FILTER --}}
    <form method="GET" action="{{ route('admin.jadwal.index') }}">
        <div class="filter-card">
            <span class="filter-label"><i class="fas fa-filter" style="font-size:10px;"></i> Filter Kelas</span>
            <select name="kelas_id" class="filter-select">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn-filter primary">
                <i class="fas fa-search"></i> Tampilkan
            </button>
            <a href="{{ route('admin.jadwal.index') }}" class="btn-filter reset">
                <i class="fas fa-times"></i> Reset
            </a>
        </div>
    </form>

    @if(request('kelas_id') && $kelas->where('id', request('kelas_id'))->first())
        <div class="filter-info">
            <i class="fas fa-info-circle"></i>
            Menampilkan jadwal kelas:
            <strong>{{ $kelas->where('id', request('kelas_id'))->first()->nama_kelas }}</strong>
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="jd-card">
        <div class="jd-card-toolbar">
            <div class="jd-count">
                Total <strong>{{ $jadwal->count() }}</strong> jadwal
            </div>
        </div>
        <div class="jd-scroll">
            <table class="jd-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $j)
                    <tr>
                        <td class="cell-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>

                        <td>
                            <span class="kelas-pill">{{ $j->kelas->nama_kelas ?? '—' }}</span>
                        </td>

                        <td class="cell-mapel">{{ $j->mapel->nama_mapel ?? '—' }}</td>

                        <td>
                            <div class="guru-pill">
                                <div class="guru-avatar">{{ strtoupper(substr($j->guru->nama ?? 'G', 0, 2)) }}</div>
                                {{ $j->guru->nama ?? '—' }}
                            </div>
                        </td>

                        <td>
                            @php
                                $hariClass = match(strtolower($j->hari)) {
                                    'senin'  => 'hari-senin',
                                    'selasa' => 'hari-selasa',
                                    'rabu'   => 'hari-rabu',
                                    'kamis'  => 'hari-kamis',
                                    'jumat'  => 'hari-jumat',
                                    default  => 'hari-default',
                                };
                            @endphp
                            <span class="hari-pill {{ $hariClass }}">{{ $j->hari }}</span>
                        </td>

                        <td>
                            <span class="jam-badge">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </span>
                        </td>

                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="btn-act btn-edit">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-act btn-del"
                                            onclick="return confirm('Yakin hapus jadwal ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-calendar-times"></i></div>
                                <p>Belum ada data jadwal</p>
                                <small>Klik "Tambah Jadwal" untuk menambahkan.</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection