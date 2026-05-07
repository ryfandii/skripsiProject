<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html, body { height: 100%; }

        .page {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* LEFT */
        .left {
            width: 38%;
            background: #F3F4F8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 48px 40px;
            position: relative;
        }

        .left::after {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, #C7D2FE 30%, #C7D2FE 70%, transparent);
        }

        .logo {
            width: 280px;
            max-width: 100%;
            margin-bottom: 32px;
            filter: drop-shadow(0 8px 24px rgba(79, 70, 229, .18));
            transition: transform .3s;
        }

        .logo:hover { transform: scale(1.04); }

        .left-title {
            font-size: 22px;
            font-weight: 800;
            color: #1E3A6E;
            line-height: 1.3;
            margin-bottom: 10px;
            letter-spacing: -.3px;
        }

        .left-sub {
            font-size: 13px;
            color: #6B7280;
            line-height: 1.7;
        }

        .left-badge {
            margin-top: 32px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #EEF2FF;
            border: 1px solid #C7D2FE;
            border-radius: 99px;
            padding: 6px 16px;
            font-size: 11.5px;
            font-weight: 600;
            color: #4F46E5;
        }

        .left-badge span {
            width: 6px; height: 6px;
            background: #4F46E5;
            border-radius: 50%;
            display: inline-block;
        }

        /* RIGHT */
        .right {
            flex: 1;
            background: linear-gradient(145deg, #1E3A6E 0%, #2D5BB5 55%, #4F8DD6 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .right::before {
            content: '';
            position: absolute;
            width: 420px; height: 420px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.07);
            top: -80px; right: -80px;
        }

        .right::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
            bottom: -60px; left: -60px;
        }

        /* FORM BOX */
        .form-box {
            width: 340px;
            position: relative;
            z-index: 2;
        }

        .form-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.5px;
            margin-bottom: 4px;
        }

        .form-sub {
            font-size: 12px;
            color: rgba(255,255,255,.6);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .form-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0;
        }

        .form-divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,.2);
        }

        .form-divider-text {
            font-size: 11px;
            color: rgba(255,255,255,.5);
            font-weight: 600;
            letter-spacing: .5px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            color: rgba(255,255,255,.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 12px;
        }

        .input-wrap svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border-radius: 12px;
            border: 1.5px solid rgba(255,255,255,.15);
            background: rgba(255,255,255,.12);
            color: #fff;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            transition: all .2s;
            backdrop-filter: blur(6px);
        }

        .input-wrap input::placeholder { color: rgba(255,255,255,.45); }

        .input-wrap input:focus {
            border-color: rgba(255,255,255,.5);
            background: rgba(255,255,255,.18);
            box-shadow: 0 0 0 3px rgba(255,255,255,.1);
        }

        .btn-otp {
            width: 100%;
            padding: 13px;
            border-radius: 12px;
            border: 1.5px solid rgba(255,255,255,.35);
            background: rgba(255,255,255,.1);
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .btn-otp:hover {
            background: rgba(255,255,255,.2);
            border-color: rgba(255,255,255,.5);
            transform: translateY(-1px);
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #10B981, #059669);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all .2s;
            margin-top: 4px;
            box-shadow: 0 4px 16px rgba(5,150,105,.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(5,150,105,.4);
        }

        /* Alert error */
        .sw-alert {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(239,68,68,.15);
            border: 1px solid rgba(239,68,68,.3);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12.5px;
            color: #FCA5A5;
            margin-bottom: 16px;
        }

        /* Alert success / OTP sent */
        .sw-success {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(16,185,129,.15);
            border: 1px solid rgba(16,185,129,.35);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12.5px;
            color: #6EE7B7;
            margin-bottom: 16px;
        }

        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            font-size: 12.5px;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            transition: color .2s;
        }

        .forgot-link:hover { color: #fff; }

        .method-btn {
            flex: 1;
            padding: 9px 10px;
            border-radius: 10px;
            border: 1.5px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.7);
            font-size: 12px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .method-btn:hover {
            background: rgba(255,255,255,.15);
            border-color: rgba(255,255,255,.4);
            color: #fff;
        }

        .method-btn.active {
            background: rgba(255,255,255,.22);
            border-color: #fff;
            color: #fff;
        }

        /* Admin info badge */
        .admin-info-badge {
            display: none;
            font-size: 11.5px;
            color: rgba(255,255,255,.75);
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 10px;
            padding: 9px 13px;
            margin-bottom: 12px;
            align-items: center;
            gap: 7px;
        }

        .admin-info-badge svg {
            flex-shrink: 0;
            color: #6EE7B7;
        }
    </style>
</head>

<body>
<div class="page">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('sbadmin2/img/logosmasa.png') }}" class="logo" alt="Logo">
        <div class="left-title">SMAN 1<br>BONDOWOSO</div>
        <div class="left-sub">Masukkan email dan password<br>untuk melanjutkan ke portal</div>
        <div class="left-badge">
            <span></span> Sistem Akademik Sekolah
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">

            <div class="form-title">SIGN IN</div>
            <div class="form-sub">TO ACCESS THE PORTAL</div>

            {{-- Alert error --}}
            @if(session('error'))
                <div class="sw-alert">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Alert OTP berhasil dikirim --}}
            @if(session('otp_sent'))
                <div class="sw-success">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    {{ session('otp_sent') }}
                </div>
            @endif

            {{-- ============================================================
                 LANGKAH 1: Dapatkan OTP
                 Langkah ini disembunyikan otomatis jika email adalah admin
                 ============================================================ --}}
            <div id="step1-section">
                <div class="section-label">Langkah 1 — Dapatkan OTP</div>

                <div style="font-size:10px; font-weight:700; color:rgba(255,255,255,.5); text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">
                    Pilih metode pengiriman OTP
                </div>

                <div style="display:flex; gap:8px; margin-bottom:10px;">
                    <button type="button" class="method-btn active" id="btn-email-method" onclick="selectMethod('email')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Email
                    </button>
                    <button type="button" class="method-btn" id="btn-wa-method" onclick="selectMethod('wa')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                        </svg>
                        WhatsApp
                    </button>
                </div>

                <form method="POST" action="{{ route('send.otp') }}" id="form-otp">
                    @csrf
                    <input type="hidden" name="method" id="otp_method" value="email">

                    {{-- Input email OTP --}}
                    <div class="input-wrap" id="wrap-email-otp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input type="email" name="email" id="input-email-otp" placeholder="Email untuk OTP" required>
                    </div>

                    {{-- Input nomor WA --}}
                    <div class="input-wrap" id="wrap-wa-otp" style="display:none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 3.08 4.18 2 2 0 0 1 5.09 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L9.91 9.91a16 16 0 0 0 6.18 6.18l1.27-1.34a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <input type="text" name="telepon" id="input-wa-otp" placeholder="Nomor WhatsApp (08xx...)">
                    </div>

                    <button type="submit" class="btn-otp">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span id="btn-otp-label">Dapatkan OTP via Email</span>
                    </button>
                </form>

                <div class="form-divider">
                    <div class="form-divider-line"></div>
                    <div class="form-divider-text">Langkah 2 — Login</div>
                    <div class="form-divider-line"></div>
                </div>
            </div>

            {{-- Divider khusus admin (tampil menggantikan step1 + divider di atas) --}}
            <div id="admin-divider" style="display:none;">
                <div class="form-divider" style="margin-bottom:16px;">
                    <div class="form-divider-line"></div>
                    <div class="form-divider-text">Login Admin</div>
                    <div class="form-divider-line"></div>
                </div>
            </div>

            {{-- ============================================================
                 LANGKAH 2: Login
                 Field OTP disembunyikan otomatis untuk admin
                 ============================================================ --}}
            <form method="POST" action="{{ route('login.otp') }}">
                @csrf

                {{-- Email --}}
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input
                        type="email"
                        name="email"
                        id="login-email"
                        placeholder="Email"
                        value="{{ session('email') ?? old('email') }}"
                        oninput="checkAdminEmail(this.value)"
                        required
                        autocomplete="email"
                    >
                </div>

                {{-- Password --}}
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                </div>

                {{-- OTP — disembunyikan untuk admin --}}
                <div class="input-wrap" id="wrap-otp-field">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                    <input
                        type="text"
                        name="otp"
                        id="otp-input"
                        placeholder="Masukkan OTP"
                        maxlength="6"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                    >
                </div>

                {{-- Badge info admin --}}
                <div class="admin-info-badge" id="admin-info-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    Akun admin tidak memerlukan kode OTP
                </div>

                <button type="submit" class="btn-login">Masuk ke Portal</button>
            </form>

            <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>

        </div>
    </div>

</div>

<script>
    // ================================================================
    // Daftar email admin — sesuaikan dengan data di database Anda
    // ================================================================
    // const ADMIN_EMAILS = [
    //     'admin@sman1bondowoso.sch.id',
    //     // tambahkan email admin lain di sini jika ada
    // ];

    // ================================================================
    // Toggle tampilan Langkah 1 (OTP section) berdasarkan role
    // ================================================================
    function checkAdminEmail(email) {
        const isAdmin = ADMIN_EMAILS.includes(email.trim().toLowerCase());

        const step1     = document.getElementById('step1-section');
        const adminDiv  = document.getElementById('admin-divider');
        const otpWrap   = document.getElementById('wrap-otp-field');
        const otpInput  = document.getElementById('otp-input');
        const adminBadge = document.getElementById('admin-info-badge');

        if (isAdmin) {
            // Sembunyikan Langkah 1 dan field OTP
            step1.style.display      = 'none';
            adminDiv.style.display   = 'block';
            otpWrap.style.display    = 'none';
            adminBadge.style.display = 'flex';
            otpInput.required        = false;
            otpInput.value           = '';
        } else {
            // Tampilkan kembali semua untuk guru/siswa
            step1.style.display      = 'block';
            adminDiv.style.display   = 'none';
            otpWrap.style.display    = 'block';
            adminBadge.style.display = 'none';
            otpInput.required        = true;
        }
    }

    // ================================================================
    // Toggle metode OTP (email / WhatsApp)
    // ================================================================
    function selectMethod(method) {
        const emailBtn   = document.getElementById('btn-email-method');
        const waBtn      = document.getElementById('btn-wa-method');
        const emailWrap  = document.getElementById('wrap-email-otp');
        const waWrap     = document.getElementById('wrap-wa-otp');
        const emailInput = document.getElementById('input-email-otp');
        const waInput    = document.getElementById('input-wa-otp');
        const label      = document.getElementById('btn-otp-label');
        const methodInput = document.getElementById('otp_method');

        if (method === 'email') {
            emailBtn.classList.add('active');
            waBtn.classList.remove('active');
            emailWrap.style.display = 'block';
            waWrap.style.display    = 'none';
            emailInput.required     = true;
            waInput.required        = false;
            waInput.value           = '';
            label.textContent       = 'Dapatkan OTP via Email';
            methodInput.value       = 'email';
        } else {
            waBtn.classList.add('active');
            emailBtn.classList.remove('active');
            waWrap.style.display    = 'block';
            emailWrap.style.display = 'none';
            waInput.required        = true;
            emailInput.required     = false;
            emailInput.value        = '';
            label.textContent       = 'Dapatkan OTP via WhatsApp';
            methodInput.value       = 'wa';
        }
    }

    // ================================================================
    // Jalankan saat halaman load — untuk prefill dari session (via WA)
    // ================================================================
    document.addEventListener('DOMContentLoaded', function () {
        const emailEl = document.getElementById('login-email');
        if (emailEl && emailEl.value.trim() !== '') {
            checkAdminEmail(emailEl.value);
        }
    });
</script>

</body>
</html>