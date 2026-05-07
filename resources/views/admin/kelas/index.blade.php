@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:       #4F46E5;
    --primary-dark:  #3730A3;
    --success:       #059669;
    --success-light: #ECFDF5;
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --warning:       #D97706;
    --warning-light: #FFFBEB;
    --info:          #0284C7;
    --info-light:    #F0F9FF;
    --bg:            #F3F4F8;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-mid:      #374151;
    --text-soft:     #6B7280;
    --radius-md:     10px;
    --radius-lg:     14px;
    --shadow-sm:     0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

.sw-topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.sw-topbar-left h3 { font-size: 22px; font-weight: 700; color: var(--text-dark); margin: 0; letter-spacing: -.3px; }
.sw-topbar-left p { font-size: 13px; color: var(--text-soft); margin: 2px 0 0; }

.sw-btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: var(--radius-md); font-size: 13.5px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; transition: all .18s ease; line-height: 1; }
.sw-btn-primary   { background: var(--primary); color: #fff; }
.sw-btn-primary:hover { background: var(--primary-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.35); }
.sw-btn-warning   { background: var(--warning-light); color: var(--warning); border: 1px solid #FDE68A; }
.sw-btn-warning:hover { background: var(--warning); color: #fff; }
.sw-btn-danger    { background: var(--danger-light); color: var(--danger); border: 1px solid #FECACA; }
.sw-btn-danger:hover { background: var(--danger); color: #fff; }
.sw-btn-sm { padding: 6px 12px; font-size: 12.5px; border-radius: 8px; }

.sw-alert { display: flex; align-items: center; gap: 10px; padding: 13px 16px; border-radius: var(--radius-md); font-size: 13.5px; font-weight: 500; margin-bottom: 20px; background: var(--success-light); color: var(--success); border: 1px solid #A7F3D0; }

.sw-card { background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--border); }
.sw-table-card { overflow: hidden; }
.sw-table-wrap { overflow-x: auto; }

table.sw-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
table.sw-table thead tr { background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%); border-bottom: 2px solid #DDD6FE; }
table.sw-table thead th { padding: 13px 16px; font-weight: 700; font-size: 12px; color: #5B21B6; text-transform: uppercase; letter-spacing: .6px; white-space: nowrap; border: none; }
table.sw-table tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
table.sw-table tbody tr:last-child { border-bottom: none; }
table.sw-table tbody tr:hover { background: #FAFAFF; }
table.sw-table td { padding: 13px 16px; color: var(--text-mid); border: none; vertical-align: middle; }
table.sw-table td.center { text-align: center; }
table.sw-table td.name-cell { font-weight: 600; color: var(--text-dark); }

.sw-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 99px; font-size: 11.5px; font-weight: 600; letter-spacing: .1px; }
.sw-badge-info { background: var(--info-light); color: var(--info); }

.sw-action-cell { display: flex; gap: 6px; align-items: center; justify-content: center; }

.sw-no { display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; background: #F3F4F6; border-radius: 7px; font-size: 12px; font-weight: 600; color: var(--text-soft); }

.sw-empty { padding: 60px 20px; text-align: center; color: var(--text-soft); }
.sw-empty-icon { font-size: 40px; margin-bottom: 12px; opacity: .4; }
.sw-empty p { font-size: 14px; margin: 0; }
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <div class="sw-topbar-left">
            <h3>Data Kelas</h3>
            <p>Pengelolaan data kelas SMA Negeri 1 Bondowoso</p>
        </div>
        <a href="{{ route('admin.kelas.create') }}" class="sw-btn sw-btn-primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Kelas
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="sw-alert">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- TABLE --}}
    <div class="sw-card sw-table-card">
        <div class="sw-table-wrap">
            <table class="sw-table">
                <thead>
                    <tr>
                        <th class="center" style="width:52px">No</th>
                        <th>Nama Kelas</th>
                        <th class="center">Jurusan</th>
                        <th class="center" style="width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $k)
                    <tr>
                        <td class="center">
                            <span class="sw-no">{{ $loop->iteration }}</span>
                        </td>
                        <td class="name-cell">{{ $k->nama_kelas }}</td>
                        <td class="center">
                            <span class="sw-badge sw-badge-info">{{ $k->jurusan }}</span>
                        </td>
                        <td>
                            <div class="sw-action-cell">
                                <a href="{{ route('admin.kelas.edit', $k->id) }}"
                                   class="sw-btn sw-btn-warning sw-btn-sm">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.kelas.destroy', $k->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="sw-btn sw-btn-danger sw-btn-sm"
                                            onclick="return confirm('Yakin hapus data kelas ini?')">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="sw-empty">
                                <div class="sw-empty-icon">🏫</div>
                                <p>Data kelas belum tersedia</p>
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