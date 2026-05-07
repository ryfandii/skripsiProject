{{-- ================================================================
     FILE: resources/views/layouts/topbar.blade.php
     ================================================================ --}}

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    /* ── TOPBAR SHELL ──────────────────────────────────── */
    .custom-topbar {
        position: fixed;
        top: 0;
        left: 240px; /* sama dengan lebar sidebar */
        right: 0;
        height: 60px;
        background: #ffffff;
        border-bottom: 1px solid rgba(0,0,0,0.07);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        z-index: 900;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    /* ── LEFT: SEARCH ──────────────────────────────────── */
    .tb-search {
        display: flex;
        align-items: center;
        gap: 9px;
        background: #f4f6fa;
        border: 1.5px solid rgba(0,0,0,0.07);
        border-radius: 9px;
        padding: 7px 14px;
        width: 260px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .tb-search:focus-within {
        border-color: rgba(26,86,219,0.4);
        box-shadow: 0 0 0 3px rgba(26,86,219,0.08);
        background: #fff;
    }

    .tb-search i {
        font-size: 13px;
        color: #9ca3af;
        flex-shrink: 0;
    }

    .tb-search input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 13px;
        color: #111827;
        font-family: 'Plus Jakarta Sans', sans-serif;
        width: 100%;
    }

    .tb-search input::placeholder { color: #9ca3af; }

    /* ── RIGHT: ACTIONS ────────────────────────────────── */
    .tb-right {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── ICON BUTTON ───────────────────────────────────── */
    .tb-icon-btn {
        position: relative;
        width: 38px;
        height: 38px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #6b7280;
        background: transparent;
        border: none;
        text-decoration: none;
        transition: background 0.13s, color 0.13s;
        font-size: 15px;
    }

    .tb-icon-btn:hover {
        background: #f4f6fa;
        color: #111827;
    }

    .tb-badge {
        position: absolute;
        top: 5px; right: 5px;
        width: 16px; height: 16px;
        border-radius: 50%;
        background: #dc2626;
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        line-height: 1;
    }

    /* ── DIVIDER ───────────────────────────────────────── */
    .tb-sep {
        width: 1px;
        height: 24px;
        background: rgba(0,0,0,0.08);
        margin: 0 8px;
    }

    /* ── USER BUTTON ───────────────────────────────────── */
    .tb-user {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 5px 10px 5px 6px;
        border-radius: 10px;
        cursor: pointer;
        border: 1.5px solid transparent;
        background: transparent;
        text-decoration: none;
        transition: background 0.13s, border-color 0.13s;
        position: relative;
    }

    .tb-user:hover {
        background: #f4f6fa;
        border-color: rgba(0,0,0,0.07);
        text-decoration: none;
    }

    .tb-user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(26,86,219,0.15);
    }

    .tb-user-avatar-text {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a56db, #6366f1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        border: 2px solid rgba(26,86,219,0.2);
        letter-spacing: 0;
    }

    .tb-user-info { line-height: 1.2; }

    .tb-user-name {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }

    .tb-user-role {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 500;
        white-space: nowrap;
    }

    .tb-user-caret {
        font-size: 10px;
        color: #9ca3af;
        margin-left: 2px;
    }

    /* ── DROPDOWN SHARED ───────────────────────────────── */
    .tb-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.10), 0 2px 6px rgba(0,0,0,0.06);
        min-width: 280px;
        z-index: 1100;
        overflow: hidden;
        opacity: 0;
        transform: translateY(-6px);
        pointer-events: none;
        transition: opacity 0.15s ease, transform 0.15s ease;
    }

    .tb-dropdown.open {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .tb-dd-header {
        padding: 12px 16px 10px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9ca3af;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    /* ── NOTIFICATION ITEMS ────────────────────────────── */
    .tb-notif-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 12px 16px;
        text-decoration: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: background 0.12s;
    }

    .tb-notif-item:last-of-type { border-bottom: none; }

    .tb-notif-item:hover { background: #f8fafc; text-decoration: none; }

    .tb-notif-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
        color: #fff;
    }

    .tb-notif-icon.blue   { background: linear-gradient(135deg, #1a56db, #3b82f6); }
    .tb-notif-icon.green  { background: linear-gradient(135deg, #0d9488, #10b981); }
    .tb-notif-icon.yellow { background: linear-gradient(135deg, #d97706, #f59e0b); }

    .tb-notif-body { flex: 1; min-width: 0; }

    .tb-notif-text {
        font-size: 13px;
        font-weight: 500;
        color: #111827;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tb-notif-time {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 3px;
        font-weight: 500;
    }

    .tb-dd-footer {
        padding: 10px 16px;
        text-align: center;
        border-top: 1px solid rgba(0,0,0,0.06);
        font-size: 12px;
        font-weight: 600;
        color: #1a56db;
        text-decoration: none;
        display: block;
        transition: background 0.12s;
    }

    .tb-dd-footer:hover { background: #f4f6fa; text-decoration: none; }

    /* ── USER DROPDOWN ─────────────────────────────────── */
    .tb-user-dd { min-width: 200px; }

    .tb-user-dd-profile {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .tb-user-dd-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a56db, #6366f1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .tb-user-dd-name { font-size: 13.5px; font-weight: 700; color: #111827; }
    .tb-user-dd-role { font-size: 11px; color: #9ca3af; font-weight: 500; }

    .tb-user-dd-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        transition: background 0.12s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .tb-user-dd-item:hover { background: #f4f6fa; color: #111827; text-decoration: none; }
    .tb-user-dd-item.danger { color: #dc2626; }
    .tb-user-dd-item.danger:hover { background: #fff5f5; }
    .tb-user-dd-item i { font-size: 13px; width: 16px; text-align: center; color: #9ca3af; }
    .tb-user-dd-item.danger i { color: #dc2626; }

    .tb-user-dd-divider { height: 1px; background: rgba(0,0,0,0.06); margin: 4px 0; }

    /* ── WRAPPER for dropdown trigger ─────────────────── */
    .tb-dropdown-wrap { position: relative; }

    /* ── MOBILE toggle ─────────────────────────────────── */
    .tb-mobile-toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 9px;
        border: none;
        background: #f4f6fa;
        color: #374151;
        cursor: pointer;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .custom-topbar { left: 0; padding: 0 16px; }
        .tb-search { display: none; }
        .tb-mobile-toggle { display: flex; }
        .tb-user-name, .tb-user-role, .tb-user-caret { display: none; }
    }
</style>

<nav class="custom-topbar">

    {{-- LEFT --}}
    <div style="display:flex; align-items:center; gap:12px;">
        {{-- Mobile sidebar toggle --}}
        <button class="tb-mobile-toggle" id="sidebarToggleTop">
            <i class="fas fa-bars"></i>
        </button>

        {{-- Search --}}
        <div class="tb-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari sesuatu...">
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="tb-right">

        {{-- NOTIFIKASI --}}
        <div class="tb-dropdown-wrap">
            <button class="tb-icon-btn" id="btnNotif" onclick="toggleDropdown('ddNotif', this)">
                <i class="fas fa-bell"></i>
                <span class="tb-badge">3</span>
            </button>

            <div class="tb-dropdown" id="ddNotif">
                <div class="tb-dd-header">Notifikasi</div>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon blue"><i class="fas fa-file-alt"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Laporan bulanan baru siap diunduh</div>
                        <div class="tb-notif-time">2 jam yang lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon green"><i class="fas fa-user-graduate"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Siswa baru telah terdaftar ke sistem</div>
                        <div class="tb-notif-time">5 jam yang lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon yellow"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Jadwal minggu depan belum dikonfirmasi</div>
                        <div class="tb-notif-time">1 hari yang lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-dd-footer">Lihat Semua Notifikasi &rarr;</a>
            </div>
        </div>

        {{-- PESAN --}}
        <div class="tb-dropdown-wrap">
            <button class="tb-icon-btn" id="btnMsg" onclick="toggleDropdown('ddMsg', this)">
                <i class="fas fa-envelope"></i>
                <span class="tb-badge">7</span>
            </button>

            <div class="tb-dropdown" id="ddMsg">
                <div class="tb-dd-header">Pesan</div>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon blue"><i class="fas fa-user"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Ada pertanyaan mengenai jadwal pelajaran minggu ini</div>
                        <div class="tb-notif-time">Emily Fowler · 58 menit lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon green"><i class="fas fa-user"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Foto tugas bulan lalu sudah siap, mau dikirim bagaimana?</div>
                        <div class="tb-notif-time">Jae Chun · 1 hari lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-notif-item">
                    <div class="tb-notif-icon yellow"><i class="fas fa-user"></i></div>
                    <div class="tb-notif-body">
                        <div class="tb-notif-text">Laporan bulan ini terlihat bagus, perkembangannya sangat baik!</div>
                        <div class="tb-notif-time">Morgan Alvarez · 2 hari lalu</div>
                    </div>
                </a>

                <a href="#" class="tb-dd-footer">Baca Semua Pesan &rarr;</a>
            </div>
        </div>

        <div class="tb-sep"></div>

        {{-- USER MENU --}}
        <div class="tb-dropdown-wrap">
            <a href="#" class="tb-user" id="btnUser" onclick="toggleDropdown('ddUser', this); return false;">

                @if(auth()->check() && auth()->user()->photo)
                    <img class="tb-user-avatar"
                         src="{{ asset('uploads/' . auth()->user()->photo) }}"
                         alt="{{ auth()->user()->name }}">
                @else
                    <div class="tb-user-avatar-text">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                    </div>
                @endif

                <div class="tb-user-info">
                    <span class="tb-user-name">{{ auth()->user()->name ?? 'Guest' }}</span>
                    <span class="tb-user-role">{{ ucfirst(auth()->user()->role ?? '') }}</span>
                </div>

                <i class="fas fa-chevron-down tb-user-caret"></i>
            </a>

            <div class="tb-dropdown tb-user-dd" id="ddUser">

                {{-- Profile summary --}}
                <div class="tb-user-dd-profile">
                    <div class="tb-user-dd-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div>
                        <div class="tb-user-dd-name">{{ auth()->user()->name ?? 'Guest' }}</div>
                        <div class="tb-user-dd-role">{{ ucfirst(auth()->user()->role ?? '') }}</div>
                    </div>
                </div>

                {{-- Menu items --}}
                <a href="{{ route('admin.profile') }}" class="tb-user-dd-item">
                    <i class="fas fa-user"></i> Profil Saya
                </a>

                <div class="tb-user-dd-divider"></div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>

                <button class="tb-user-dd-item danger"
                        onclick="document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>

            </div>
        </div>

    </div>

</nav>

<script>
    function toggleDropdown(id, trigger) {
        const dd = document.getElementById(id);
        const allDDs = document.querySelectorAll('.tb-dropdown');

        allDDs.forEach(el => {
            if (el.id !== id) el.classList.remove('open');
        });

        dd.classList.toggle('open');

        // close on outside click
        const handler = (e) => {
            if (!trigger.contains(e.target) && !dd.contains(e.target)) {
                dd.classList.remove('open');
                document.removeEventListener('click', handler);
            }
        };

        if (dd.classList.contains('open')) {
            setTimeout(() => document.addEventListener('click', handler), 0);
        }
    }
</script>