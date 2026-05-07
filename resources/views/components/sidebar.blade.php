{{-- ================================================================
     FILE: resources/views/layouts/sidebar.blade.php
     ================================================================ --}}

@php
    $role = auth()->user()->role ?? null;
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    /* ── SIDEBAR SHELL ─────────────────────────────────── */
    .custom-sidebar {
        width: 240px;
        min-height: 100vh;
        background: #0f1e3d;
        display: flex;
        flex-direction: column;
        font-family: 'Plus Jakarta Sans', sans-serif;
        position: fixed;
        top: 0; left: 0;
        z-index: 1000;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,0.08) transparent;
    }

    .custom-sidebar::-webkit-scrollbar { width: 4px; }
    .custom-sidebar::-webkit-scrollbar-track { background: transparent; }
    .custom-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

    /* ── BRAND ─────────────────────────────────────────── */
    .sb-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 20px 20px 18px;
        text-decoration: none;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 8px;
    }

    .sb-brand-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(37,99,235,0.4);
    }

    .sb-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }

    .sb-brand-name {
        font-size: 15px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: -0.3px;
    }

    .sb-brand-sub {
        font-size: 10.5px;
        font-weight: 500;
        color: rgba(255,255,255,0.35);
        letter-spacing: 0.05em;
        margin-top: 2px;
    }

    /* ── SECTION HEADING ───────────────────────────────── */
    .sb-section {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.28);
        padding: 14px 20px 6px;
    }

    /* ── NAV ITEM ──────────────────────────────────────── */
    .sb-nav {
        list-style: none;
        margin: 0;
        padding: 0 10px 16px;
    }

    .sb-nav li { margin-bottom: 2px; }

    .sb-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 9px 12px;
        border-radius: 8px;
        text-decoration: none;
        color: rgba(255,255,255,0.55);
        font-size: 13.5px;
        font-weight: 500;
        transition: all 0.15s ease;
        position: relative;
    }

    .sb-link:hover {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.9);
        text-decoration: none;
    }

    .sb-link .sb-icon {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        background: rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.45);
        flex-shrink: 0;
        transition: all 0.15s ease;
    }

    .sb-link:hover .sb-icon {
        background: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.85);
    }

    /* ── ACTIVE STATE ──────────────────────────────────── */
    .sb-link.active {
        background: linear-gradient(135deg, rgba(37,99,235,0.35) 0%, rgba(29,78,216,0.2) 100%);
        color: #ffffff;
        font-weight: 600;
    }

    .sb-link.active::before {
        content: '';
        position: absolute;
        left: 0; top: 50%;
        transform: translateY(-50%);
        width: 3px; height: 60%;
        background: #3b82f6;
        border-radius: 0 3px 3px 0;
    }

    .sb-link.active .sb-icon {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        box-shadow: 0 3px 8px rgba(37,99,235,0.4);
    }

    /* ── DIVIDER ───────────────────────────────────────── */
    .sb-divider {
        height: 1px;
        background: rgba(255,255,255,0.06);
        margin: 6px 20px 10px;
    }

    /* ── ROLE BADGE (bottom) ───────────────────────────── */
    .sb-footer {
        margin-top: auto;
        padding: 14px 20px 20px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .sb-role-card {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        padding: 10px 12px;
    }

    .sb-role-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #6366f1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        letter-spacing: 0;
    }

    .sb-role-info { overflow: hidden; }

    .sb-role-name {
        font-size: 12.5px;
        font-weight: 600;
        color: rgba(255,255,255,0.85);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
    }

    .sb-role-label {
        font-size: 10.5px;
        color: rgba(255,255,255,0.3);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
</style>


{{-- ================= ADMIN SIDEBAR ================= --}}
@if($role == 'admin')

<aside class="custom-sidebar">

    <a class="sb-brand" href="{{ route('admin.dashboard') }}">
        <div class="sb-brand-icon"><i class="fa-solid fa-school"></i></div>
        <div class="sb-brand-text">
            <span class="sb-brand-name">SMAN 1</span>
            <span class="sb-brand-sub">Panel Admin</span>
        </div>
    </a>

    <span class="sb-section">Menu Utama</span>
    <ul class="sb-nav">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-tachometer-alt"></i></span>
                Dashboard
            </a>
        </li>
    </ul>

    <div class="sb-divider"></div>
    <span class="sb-section">Manajemen Data</span>

    <ul class="sb-nav">
        <li>
            <a href="{{ route('admin.guru.index') }}"
               class="sb-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-chalkboard-teacher"></i></span>
                Data Guru
            </a>
        </li>
        <li>
            <a href="{{ route('admin.siswa.index') }}"
               class="sb-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-user-graduate"></i></span>
                Data Siswa
            </a>
        </li>
        <li>
            <a href="{{ route('admin.mapel.index') }}"
               class="sb-link {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-book"></i></span>
                Mata Pelajaran
            </a>
        </li>
        <li>
            <a href="{{ route('admin.kelas.index') }}"
               class="sb-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-school"></i></span>
                Data Kelas
            </a>
        </li>
        <li>
            <a href="{{ route('admin.jadwal.index') }}"
               class="sb-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-calendar-alt"></i></span>
                Jadwal
            </a>
        </li>
    </ul>

    <div class="sb-footer">
        <div class="sb-role-card">
            <div class="sb-role-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="sb-role-info">
                <div class="sb-role-name">{{ auth()->user()->name }}</div>
                <div class="sb-role-label">Administrator</div>
            </div>
        </div>
    </div>

</aside>

@endif


{{-- ================= GURU SIDEBAR ================= --}}
@if(auth()->check() && auth()->user()->role == 'guru')

<aside class="custom-sidebar">

    <a class="sb-brand" href="{{ route('guru.dashboard') }}">
        <div class="sb-brand-icon"><i class="fa-solid fa-school"></i></div>
        <div class="sb-brand-text">
            <span class="sb-brand-name">SMAN 1</span>
            <span class="sb-brand-sub">Portal Guru</span>
        </div>
    </a>

    <span class="sb-section">Menu Utama</span>
    <ul class="sb-nav">
        <li>
            <a href="{{ route('guru.dashboard') }}"
               class="sb-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-tachometer-alt"></i></span>
                Dashboard
            </a>
        </li>
    </ul>

    <div class="sb-divider"></div>
    <span class="sb-section">Menu Guru</span>

    <ul class="sb-nav">
        <li>
            <a href="{{ route('guru.jadwal') }}"
               class="sb-link {{ request()->routeIs('guru.jadwal') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-calendar-alt"></i></span>
                Jadwal
            </a>
        </li>
        <li>
            <a href="{{ route('guru.absensi') }}"
               class="sb-link {{ request()->routeIs('guru.absensi*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-user-check"></i></span>
                Absensi
            </a>
        </li>
        <li>
            <a href="{{ route('guru.nilai.index') }}"
               class="sb-link {{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-clipboard-list"></i></span>
                Nilai
            </a>
        </li>
        <li>
            <a href="{{ route('guru.tugas.index') }}"
               class="sb-link {{ request()->routeIs('guru.tugas.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-tasks"></i></span>
                Tugas
            </a>
        </li>
        <li>
            <a href="{{ route('guru.ujian.index') }}"
               class="sb-link {{ request()->routeIs('guru.ujian.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-alt"></i></span>
                Ujian
            </a>
        </li>
    </ul>

    <div class="sb-footer">
        <div class="sb-role-card">
            <div class="sb-role-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="sb-role-info">
                <div class="sb-role-name">{{ auth()->user()->name }}</div>
                <div class="sb-role-label">Guru</div>
            </div>
        </div>
    </div>

</aside>

@endif


{{-- ================= SISWA SIDEBAR ================= --}}
@if($role == 'siswa')

<aside class="custom-sidebar">

    <a class="sb-brand" href="{{ route('siswa.dashboard') }}">
        <div class="sb-brand-icon"><i class="fa-solid fa-school"></i></div>
        <div class="sb-brand-text">
            <span class="sb-brand-name">SMAN 1</span>
            <span class="sb-brand-sub">Portal Siswa</span>
        </div>
    </a>

    <span class="sb-section">Menu Utama</span>
    <ul class="sb-nav">
        <li>
            <a href="{{ route('siswa.dashboard') }}"
               class="sb-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-tachometer-alt"></i></span>
                Dashboard
            </a>
        </li>
    </ul>

    <div class="sb-divider"></div>
    <span class="sb-section">Menu Siswa</span>

    <ul class="sb-nav">
        <li>
            <a href="{{ route('siswa.jadwal') }}"
               class="sb-link {{ request()->routeIs('siswa.jadwal') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-calendar-alt"></i></span>
                Jadwal
            </a>
        </li>
        <li>
            <a href="{{ route('siswa.nilai') }}"
               class="sb-link {{ request()->routeIs('siswa.nilai') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-clipboard-list"></i></span>
                Nilai
            </a>
        </li>
        <li>
            <a href="{{ route('siswa.tugas.index') }}"
               class="sb-link {{ request()->routeIs('siswa.tugas.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-tasks"></i></span>
                Tugas
            </a>
        </li>
        <li>
            <a href="{{ route('siswa.ujian.index') }}"
               class="sb-link {{ request()->routeIs('siswa.ujian.*') ? 'active' : '' }}">
                <span class="sb-icon"><i class="fa-solid fa-file-alt"></i></span>
                Ujian
            </a>
        </li>
    </ul>

    <div class="sb-footer">
        <div class="sb-role-card">
            <div class="sb-role-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="sb-role-info">
                <div class="sb-role-name">{{ auth()->user()->name }}</div>
                <div class="sb-role-label">Siswa</div>
            </div>
        </div>
    </div>

</aside>

@endif