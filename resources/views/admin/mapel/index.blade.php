{{-- ============================================================
     FILE 1: resources/views/admin/mapel/index.blade.php
     ============================================================ --}}

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

    .mp-wrap { background: var(--page-bg); min-height: 100vh; padding: 28px 32px 56px; }

    /* header */
    .mp-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; }
    .mp-header-left .eyebrow { font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--brand); margin-bottom: 4px; }
    .mp-header-left h1 { font-size: 24px; font-weight: 700; color: var(--text-1); margin: 0; letter-spacing: -.4px; }

    /* primary button */
    .btn-primary-mp {
        display: inline-flex; align-items: center; gap: 7px;
        background: var(--brand); color: #fff; border: none;
        border-radius: var(--r-sm); padding: 10px 20px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; transition: all .15s ease;
        box-shadow: 0 2px 8px rgba(26,86,219,.25); white-space: nowrap;
    }
    .btn-primary-mp:hover { background: var(--brand-dark); transform: translateY(-1px); color: #fff; box-shadow: 0 4px 12px rgba(26,86,219,.35); }
    .btn-primary-mp i { font-size: 11px; }

    /* alert */
    .mp-alert {
        display: flex; align-items: center; gap: 12px;
        background: var(--success-light); border: 1px solid rgba(13,148,136,.2);
        border-left: 4px solid var(--success); border-radius: var(--r-md);
        padding: 13px 16px; margin-bottom: 20px;
        font-size: 13px; font-weight: 500; color: #065f46; position: relative;
    }
    .mp-alert-close { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #065f46; font-size: 18px; opacity: .6; line-height: 1; }
    .mp-alert-close:hover { opacity: 1; }

    /* card */
    .mp-card { background: var(--surface); border-radius: var(--r-lg); border: 1px solid var(--border); box-shadow: var(--sh-sm); overflow: hidden; }
    .mp-card-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 15px 20px; border-bottom: 1px solid var(--border); }
    .mp-count { font-size: 13px; font-weight: 600; color: var(--text-2); }
    .mp-count strong { color: var(--text-1); font-weight: 700; }

    /* table */
    .mp-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    .mp-table thead tr { background: #f8fafc; border-bottom: 1px solid var(--border); }
    .mp-table thead th { padding: 12px 16px; font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-3); white-space: nowrap; border: none; }
    .mp-table thead th:first-child { padding-left: 20px; }
    .mp-table thead th:last-child  { padding-right: 20px; }
    .mp-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .mp-table tbody tr:last-child  { border-bottom: none; }
    .mp-table tbody tr:hover { background: #f8fafc; }
    .mp-table td { padding: 14px 16px; color: var(--text-1); vertical-align: middle; border: none; }
    .mp-table td:first-child { padding-left: 20px; }
    .mp-table td:last-child  { padding-right: 20px; }

    .cell-no { font-family: 'DM Mono', monospace; font-size: 12px; color: var(--text-3); font-weight: 500; width: 44px; }
    .cell-name { font-weight: 600; color: var(--text-1); display: flex; align-items: center; gap: 10px; }
    .name-icon { width: 34px; height: 34px; border-radius: 8px; background: var(--brand-light); color: var(--brand); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .cell-mono { font-family: 'DM Mono', monospace; font-size: 13px; color: var(--text-2); }

    /* badges */
    .pill { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; letter-spacing: .02em; }
    .pill-brand { background: var(--brand-light); color: var(--brand); border: 1px solid rgba(26,86,219,.15); }

    /* jam display */
    .jam-wrap { display: inline-flex; align-items: baseline; gap: 4px; }
    .jam-num  { font-size: 17px; font-weight: 700; font-family: 'DM Mono', monospace; color: var(--text-1); }
    .jam-unit { font-size: 11px; color: var(--text-3); font-weight: 500; }

    /* action buttons */
    .action-group { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
    .btn-act {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 7px; font-size: 12px; font-weight: 600;
        cursor: pointer; text-decoration: none; border: 1px solid;
        transition: all .12s ease; white-space: nowrap;
        font-family: 'Plus Jakarta Sans', sans-serif; background: none;
    }
    .btn-act i { font-size: 10px; }
    .btn-edit    { background: #f8fafc; border-color: var(--border-md); color: var(--text-1); }
    .btn-edit:hover { background: #eef2f6; color: var(--text-1); }
    .btn-del     { background: #fff5f5; border-color: rgba(220,38,38,.18); color: var(--danger); }
    .btn-del:hover { background: var(--danger-light); border-color: rgba(220,38,38,.35); color: var(--danger); }

    /* empty */
    .empty-state { padding: 52px 24px; text-align: center; }
    .empty-icon { width: 54px; height: 54px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: var(--text-3); font-size: 22px; }
    .empty-state p { font-size: 14px; color: var(--text-2); font-weight: 500; margin: 0 0 4px; }
    .empty-state small { font-size: 12px; color: var(--text-3); }

    @media (max-width: 768px) {
        .mp-wrap { padding: 20px 16px 40px; }
        .mp-header { flex-direction: column; align-items: flex-start; gap: 14px; }
        .mp-table-scroll { overflow-x: auto; }
    }
</style>

<div class="mp-wrap">

    <div class="mp-header">
        <div class="mp-header-left">
            <div class="eyebrow">Kurikulum</div>
            <h1>Mata Pelajaran</h1>
        </div>
        <a href="{{ route('admin.mapel.create') }}" class="btn-primary-mp">
            <i class="fa-solid fa-plus"></i> Tambah Mapel
        </a>
    </div>

    @if(session('success'))
        <div class="mp-alert" id="mpAlert">
            <i class="fa-solid fa-check-circle" style="font-size:15px;flex-shrink:0;"></i>
            {{ session('success') }}
            <button class="mp-alert-close" onclick="document.getElementById('mpAlert').remove()">&times;</button>
        </div>
    @endif

    <div class="mp-card">
        <div class="mp-card-toolbar">
            <div class="mp-count">Total <strong>{{ $mapel->count() }}</strong> mata pelajaran</div>
        </div>
        <div class="mp-table-scroll">
            <table class="mp-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kode</th>
                        <th style="text-align:center;">Jam Pelajaran</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapel as $m)
                    <tr>
                        <td class="cell-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="cell-name">
                                <div class="name-icon"><i class="fa-solid fa-book"></i></div>
                                {{ $m->nama_mapel }}
                            </div>
                        </td>
                        <td><span class="pill pill-brand">{{ $m->kode_mapel }}</span></td>
                        <td style="text-align:center;">
                            <div class="jam-wrap">
                                <span class="jam-num">{{ $m->jam_pelajaran }}</span>
                                <span class="jam-unit">jam</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.mapel.edit', $m->id) }}" class="btn-act btn-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-act btn-del"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-book"></i></div>
                                <p>Belum ada mata pelajaran</p>
                                <small>Klik "Tambah Mapel" untuk menambahkan data.</small>
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