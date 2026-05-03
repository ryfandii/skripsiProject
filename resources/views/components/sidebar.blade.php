@php
    $role = auth()->user()->role ?? null;
@endphp

{{-- ================= ADMIN (SIDEBAR) ================= --}}
@if($role == 'admin')

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- BRAND -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SMAN 1</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Admin Menu</div>

    <li class="nav-item">
        <a href="{{ route('admin.guru.index') }}" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Data Guru</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.siswa.index') }}" class="nav-link">
            <i class="fas fa-user-graduate"></i>
            <span>Data Siswa</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.mapel.index') }}" class="nav-link">
            <i class="fas fa-book"></i>
            <span>Mata Pelajaran</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.kelas.index') }}" class="nav-link">
            <i class="fas fa-school"></i>
            <span>Data Kelas</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.jadwal.index') }}" class="nav-link">
            <i class="fas fa-calendar"></i>
            <span>Jadwal</span>
        </a>
    </li>

  

</ul>

@endif


{{-- ================= GURU (NAVBAR MOBILE) ================= --}}
@if(auth()->check() && auth()->user()->role == 'guru')

<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm fixed-top">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="{{ route('guru.dashboard') }}">
            <i class="fas fa-school"></i> SMAN 1
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGuru">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarGuru">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}"
                       href="{{ route('guru.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.jadwal') ? 'active' : '' }}"
                       href="{{ route('guru.jadwal') }}">
                        <i class="fas fa-calendar"></i> Jadwal
                    </a>
                </li>

                                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.absensi*') ? 'active' : '' }}"
                    href="{{ route('guru.absensi') }}">
                        <i class="fas fa-user-check"></i> Absensi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}"
                       href="{{ route('guru.nilai.index') }}">
                        <i class="fas fa-clipboard-list"></i> Nilai
                    </a>
                </li>

                {{-- 🔥 MENU BARU: TUGAS --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.tugas.*') ? 'active' : '' }}"
                       href="{{ route('guru.tugas.index') }}">
                        <i class="fas fa-tasks"></i> Tugas
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('guru.ujian.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <p>Ujian</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- supaya konten tidak ketutup navbar --}}
<style>
body {
    padding-top: 70px;
}
</style>

@endif


{{-- ================= SISWA ================= --}}
@if($role == 'siswa')

<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm fixed-top">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-school"></i> SMAN 1
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswa">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarSiswa">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}"
                       href="{{ route('siswa.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/jadwal') ? 'active' : '' }}"
                       href="{{ route('siswa.jadwal') }}">
                        <i class="fas fa-calendar"></i> Jadwal
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/nilai') ? 'active' : '' }}"
                       href="{{ route('siswa.nilai') }}">
                        <i class="fas fa-clipboard-list"></i> Nilai
                    </a>
                </li>

                <!-- ✅ TUGAS (SUDAH BENAR) -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa/tugas*') ? 'active' : '' }}"
                       href="{{ route('siswa.tugas.index') }}">
                        <i class="fas fa-tasks"></i> Tugas
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.ujian.index') }}" class="nav-link">
                        <i class="fas fa-edit"></i> Ujian
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.absensi*') ? 'active' : '' }}"
                    href="{{ route('siswa.absensi') }}">
                        <i class="fas fa-user-check"></i> Absensi
                    </a>
                </li> -->

            </ul>
        </div>
    </div>
</nav>

{{-- supaya konten tidak ketutup navbar --}}
<style>
body {
    padding-top: 70px;
}
</style>

@endif