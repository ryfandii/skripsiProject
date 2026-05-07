@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:       #4F46E5;
    --primary-light: #EEF2FF;
    --primary-dark:  #3730A3;
    --success:       #059669;
    --success-light: #ECFDF5;
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --warning:       #D97706;
    --warning-light: #FFFBEB;
    --info:          #0284C7;
    --info-light:    #F0F9FF;
    --neutral:       #6B7280;
    --neutral-light: #F9FAFB;
    --bg:            #F3F4F8;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-mid:      #374151;
    --text-soft:     #6B7280;
    --radius-md:     10px;
    --radius-lg:     14px;
    --shadow-sm:     0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md:     0 4px 16px rgba(0,0,0,.07);
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

/* ── PAGE WRAPPER ── */
.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

/* ── TOPBAR ── */
.sw-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}
.sw-topbar-left h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
    letter-spacing: -.3px;
}
.sw-topbar-left p {
    font-size: 13px;
    color: var(--text-soft);
    margin: 2px 0 0;
}

/* ── BUTTON ── */
.sw-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    border-radius: var(--radius-md);
    font-size: 13.5px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .18s ease;
    line-height: 1;
}
.sw-btn-primary   { background: var(--primary); color: #fff; }
.sw-btn-primary:hover { background: var(--primary-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.35); }
.sw-btn-secondary { background: var(--surface); color: var(--text-mid); border: 1px solid var(--border); }
.sw-btn-secondary:hover { background: var(--neutral-light); color: var(--text-mid); }
.sw-btn-danger    { background: var(--danger-light); color: var(--danger); border: 1px solid #FECACA; }
.sw-btn-danger:hover { background: var(--danger); color: #fff; }
.sw-btn-warning   { background: var(--warning-light); color: var(--warning); border: 1px solid #FDE68A; }
.sw-btn-warning:hover { background: var(--warning); color: #fff; }
.sw-btn-success   { background: var(--success-light); color: var(--success); border: 1px solid #A7F3D0; }
.sw-btn-success:hover { background: var(--success); color: #fff; }
.sw-btn-sm { padding: 6px 12px; font-size: 12.5px; border-radius: 8px; }

/* ── ALERT ── */
.sw-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 16px;
    border-radius: var(--radius-md);
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 20px;
    background: var(--success-light);
    color: var(--success);
    border: 1px solid #A7F3D0;
}
.sw-alert svg { flex-shrink: 0; }

/* ── FILTER CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
}
.sw-filter {
    padding: 16px 20px;
    margin-bottom: 18px;
}
.sw-filter form { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
.sw-filter label { font-size: 13px; font-weight: 600; color: var(--text-mid); white-space: nowrap; }
.sw-filter .form-select {
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 13px;
    color: var(--text-mid);
    background: var(--neutral-light);
    font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none;
    transition: border-color .15s;
}
.sw-filter .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

/* ── BULK BAR ── */
.sw-bulk-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
}

/* ── TABLE CARD ── */
.sw-table-card { overflow: hidden; }
.sw-table-wrap { overflow-x: auto; }

table.sw-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}

table.sw-table thead tr {
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
    border-bottom: 2px solid #DDD6FE;
}
table.sw-table thead th {
    padding: 13px 16px;
    font-weight: 700;
    font-size: 12px;
    color: #5B21B6;
    text-transform: uppercase;
    letter-spacing: .6px;
    white-space: nowrap;
    border: none;
}
table.sw-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
table.sw-table tbody tr:last-child { border-bottom: none; }
table.sw-table tbody tr:hover { background: #FAFAFF; }
table.sw-table td {
    padding: 13px 16px;
    color: var(--text-mid);
    border: none;
    vertical-align: middle;
}
table.sw-table td.center { text-align: center; }
table.sw-table td.name-cell { font-weight: 600; color: var(--text-dark); }

/* ── CUSTOM CHECKBOX ── */
.sw-check {
    width: 16px; height: 16px;
    accent-color: var(--primary);
    cursor: pointer;
}

/* ── BADGES ── */
.sw-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11.5px;
    font-weight: 600;
    letter-spacing: .1px;
}
.sw-badge-success  { background: var(--success-light); color: var(--success); }
.sw-badge-danger   { background: var(--danger-light);  color: var(--danger); }
.sw-badge-primary  { background: var(--primary-light); color: var(--primary); }
.sw-badge-neutral  { background: #F3F4F6; color: #6B7280; }
.sw-badge-info     { background: var(--info-light);    color: var(--info); }

/* ── NONAKTIF INLINE FORM ── */
.sw-nonaktif-form {
    display: flex;
    gap: 6px;
    align-items: center;
}
.sw-nonaktif-input {
    width: 110px;
    padding: 6px 10px;
    border: 1px solid var(--border);
    border-radius: 7px;
    font-size: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-mid);
    background: var(--neutral-light);
    outline: none;
    transition: border-color .15s;
}
.sw-nonaktif-input:focus { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(220,38,38,.08); }
.sw-nonaktif-input::placeholder { color: #9CA3AF; }

/* ── ACTION CELL ── */
.sw-action-cell { display: flex; gap: 6px; align-items: center; justify-content: center; }

/* ── EMPTY STATE ── */
.sw-empty {
    padding: 60px 20px;
    text-align: center;
    color: var(--text-soft);
}
.sw-empty-icon { font-size: 40px; margin-bottom: 12px; opacity: .4; }
.sw-empty p { font-size: 14px; margin: 0; }

/* ── DOT INDICATOR ── */
.sw-dot {
    display: inline-block;
    width: 7px; height: 7px;
    border-radius: 50%;
    margin-right: 5px;
}
.sw-dot-success { background: var(--success); }
.sw-dot-danger  { background: var(--danger); }
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <div class="sw-topbar-left">
            <h3>Data Siswa</h3>
            <p>Kelola seluruh data dan status siswa</p>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="sw-btn sw-btn-primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Siswa
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="sw-alert">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- FILTER --}}
    <div class="sw-card sw-filter">
        <form method="GET">
            <label>Kelas</label>
            <select name="kelas_id" class="form-select">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="sw-btn sw-btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filter
            </button>
            <a href="{{ route('admin.siswa.index') }}" class="sw-btn sw-btn-secondary">Reset</a>
        </form>
    </div>

    {{-- BULK ACTION + TABLE --}}
    <form action="{{ route('admin.siswa.bulkNonaktif') }}" method="POST">
        @csrf

        <div class="sw-bulk-bar">
            <button type="submit" class="sw-btn sw-btn-danger"
                onclick="return confirm('Nonaktifkan siswa yang dipilih?')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                Nonaktifkan Terpilih
            </button>
        </div>

        <div class="sw-card sw-table-card">
            <div class="sw-table-wrap">
                <table class="sw-table">
                    <thead>
                        <tr>
                            <th class="center" style="width:36px">
                                <input type="checkbox" id="checkAll" class="sw-check">
                            </th>
                            <th class="center" style="width:44px">No</th>
                            <th>Nama</th>
                            <th class="center">JK</th>
                            <th class="center">NIS</th>
                            <th class="center">Kelas</th>
                            <th>Orang Tua</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th class="center">Telepon</th>
                            <th class="center">Status</th>
                            <th class="center" style="width:220px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $item)
                        <tr>
                            <td class="center">
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="sw-check">
                            </td>
                            <td class="center" style="color:var(--text-soft); font-size:12px;">
                                {{ $loop->iteration }}
                            </td>
                            <td class="name-cell">{{ $item->nama }}</td>
                            <td class="center">
                                @if($item->jenis_kelamin == 'L')
                                    <span class="sw-badge sw-badge-primary">L</span>
                                @else
                                    <span class="sw-badge sw-badge-neutral">P</span>
                                @endif
                            </td>
                            <td class="center" style="font-variant-numeric:tabular-nums; font-size:13px;">
                                {{ $item->nis }}
                            </td>
                            <td class="center">
                                <span class="sw-badge sw-badge-info">{{ $item->kelas->nama_kelas ?? '-' }}</span>
                            </td>
                            <td>{{ $item->nama_ortu }}</td>
                            <td style="font-size:12.5px; color:var(--text-soft);">{{ $item->user->email ?? '-' }}</td>
                            <td style="max-width:160px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{{ $item->alamat }}">
                                {{ $item->alamat }}
                            </td>
                            <td class="center" style="font-size:12.5px;">{{ $item->telepon }}</td>
                            <td class="center">
                                @if($item->status == 'aktif')
                                    <span class="sw-badge sw-badge-success">
                                        <span class="sw-dot sw-dot-success"></span>Aktif
                                    </span>
                                @else
                                    <span class="sw-badge sw-badge-danger">
                                        <span class="sw-dot sw-dot-danger"></span>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="sw-action-cell">
                                    <a href="{{ route('admin.siswa.edit', $item->id) }}"
                                       class="sw-btn sw-btn-warning sw-btn-sm">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    @if($item->status == 'aktif')
                                        <form action="{{ route('admin.siswa.nonaktif', $item->id) }}" method="POST" class="sw-nonaktif-form">
                                            @csrf
                                            <input type="text" name="alasan" placeholder="Alasan..." required class="sw-nonaktif-input">
                                            <button type="submit" class="sw-btn sw-btn-danger sw-btn-sm">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                                Nonaktif
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.siswa.aktifkan', $item->id) }}"
                                           class="sw-btn sw-btn-success sw-btn-sm">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"/></svg>
                                            Aktifkan
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">
                                <div class="sw-empty">
                                    <div class="sw-empty-icon">🎓</div>
                                    <p>Tidak ada data siswa ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>

</div>

<script>
document.getElementById('checkAll').addEventListener('change', function () {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = this.checked);
});
</script>

@endsection