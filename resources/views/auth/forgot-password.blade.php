<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
html, body { height: 100%; }

.page { display: flex; height: 100vh; width: 100%; }

/* ── LEFT ── */
.left {
    width: 38%;
    background: #F3F4F8;
    display: flex; flex-direction: column;
    justify-content: center; align-items: center;
    text-align: center; padding: 48px 40px;
    position: relative;
}
.left::after {
    content: '';
    position: absolute; right: 0; top: 0; bottom: 0; width: 1px;
    background: linear-gradient(to bottom, transparent, #C7D2FE 30%, #C7D2FE 70%, transparent);
}

.logo {
    width: 280px;
    max-width: 100%;
    margin-bottom: 32px;
    filter: drop-shadow(0 8px 24px rgba(79,70,229,.18));
    transition: transform .3s;
}
.left-title { font-size: 22px; font-weight: 800; color: #1E3A6E; line-height: 1.3; margin-bottom: 10px; }
.left-sub   { font-size: 13px; color: #6B7280; line-height: 1.7; }

.left-badge {
    margin-top: 28px;
    display: inline-flex; align-items: center; gap: 6px;
    background: #EEF2FF; border: 1px solid #C7D2FE;
    border-radius: 99px; padding: 6px 16px;
    font-size: 11.5px; font-weight: 600; color: #4F46E5;
}
.left-badge span { width: 6px; height: 6px; background: #4F46E5; border-radius: 50%; display: inline-block; }

/* ── RIGHT ── */
.right {
    flex: 1;
    background: linear-gradient(145deg, #1E3A6E 0%, #2D5BB5 55%, #4F8DD6 100%);
    display: flex; justify-content: center; align-items: center;
    position: relative; overflow: hidden;
}
.right::before {
    content: ''; position: absolute;
    width: 420px; height: 420px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.07);
    top: -80px; right: -80px;
}
.right::after {
    content: ''; position: absolute;
    width: 300px; height: 300px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.06);
    bottom: -60px; left: -60px;
}

/* ── FORM BOX ── */
.form-box { width: 340px; position: relative; z-index: 2; }

.form-title {
    font-size: 24px; font-weight: 800; color: #fff;
    letter-spacing: -.5px; margin-bottom: 6px;
}
.form-sub {
    font-size: 13px; color: rgba(255,255,255,.65);
    line-height: 1.6; margin-bottom: 28px;
}

/* ── INPUT ── */
.input-wrap { position: relative; margin-bottom: 14px; }
.input-wrap svg {
    position: absolute; left: 16px; top: 50%;
    transform: translateY(-50%); color: rgba(255,255,255,.5); pointer-events: none;
}
.input-wrap input {
    width: 100%;
    padding: 13px 16px 13px 44px;
    border-radius: 12px;
    border: 1.5px solid rgba(255,255,255,.15);
    background: rgba(255,255,255,.12);
    color: #fff; font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none; transition: all .2s;
    backdrop-filter: blur(6px);
}
.input-wrap input::placeholder { color: rgba(255,255,255,.45); }
.input-wrap input:focus {
    border-color: rgba(255,255,255,.5);
    background: rgba(255,255,255,.18);
    box-shadow: 0 0 0 3px rgba(255,255,255,.1);
}

/* ── BUTTON ── */
.btn-submit {
    width: 100%; padding: 13px; border-radius: 12px; border: none;
    background: linear-gradient(135deg, #10B981, #059669);
    color: #fff; font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .2s; margin-top: 4px;
    box-shadow: 0 4px 16px rgba(5,150,105,.35);
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(5,150,105,.4); }

/* ── ALERT ── */
.sw-alert-success {
    display: flex; align-items: center; gap: 8px;
    background: rgba(16,185,129,.15); border: 1px solid rgba(16,185,129,.3);
    border-radius: 10px; padding: 11px 14px;
    font-size: 12.5px; color: #6EE7B7; margin-bottom: 18px;
}

/* ── BACK LINK ── */
.back-link {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    margin-top: 20px;
    font-size: 12.5px; color: rgba(255,255,255,.6);
    text-decoration: none; transition: color .2s;
}
.back-link:hover { color: #fff; }

/* ================================================================
   RESPONSIVE MOBILE
   Layout: logo + info sekolah di atas, form di bawah
   ================================================================ */
@media (max-width: 768px) {
    .page {
        flex-direction: column;
        height: auto;
        min-height: 100vh;
    }

    /* LEFT — di atas */
    .left {
        width: 100%;
        padding: 32px 24px 28px;
        order: 1;
    }

    /* Garis pembatas horizontal */
    .left::after {
        right: unset;
        top: unset;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, transparent, #C7D2FE 30%, #C7D2FE 70%, transparent);
    }

    .logo {
        width: 180px;
        margin-bottom: 20px;
    }

    .left-title { font-size: 18px; }
    .left-sub   { font-size: 12px; }

    .left-badge {
        margin-top: 20px;
        font-size: 11px;
    }

    /* RIGHT — form di bawah */
    .right {
        order: 2;
        padding: 36px 24px 52px;
        min-height: auto;
        align-items: flex-start;
        justify-content: center;
    }

    /* Sembunyikan dekorasi lingkaran di mobile */
    .right::before,
    .right::after {
        display: none;
    }

    .form-box {
        width: 100%;
        max-width: 420px;
    }

    .form-title { font-size: 21px; }

    .form-sub {
        font-size: 12.5px;
        margin-bottom: 22px;
    }

    .input-wrap input {
        font-size: 16px; /* Cegah auto-zoom di iOS */
    }
}

/* Extra small phones */
@media (max-width: 380px) {
    .left {
        padding: 24px 20px 22px;
    }

    .logo { width: 150px; }

    .right {
        padding: 28px 20px 44px;
    }

    .form-title { font-size: 19px; }
}
    </style>
</head>
<body>
<div class="page">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('sbadmin2/img/logosmasa.png') }}" class="logo" alt="Logo">
        <div class="left-title">SMAN 1<br>BONDOWOSO</div>
        <div class="left-sub">Silakan masukkan email untuk<br>reset password akun Anda</div>
        <div class="left-badge"><span></span> Sistem Akademik Sekolah</div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">

            <div class="form-title">Lupa Password?</div>
            <div class="form-sub">Masukkan email terdaftar dan kami akan mengirimkan kode OTP untuk reset password.</div>

            @if(session('success'))
            <div class="sw-alert-success">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="/forgot-password">
                @csrf
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </div>
                <button type="submit" class="btn-submit">Kirim OTP</button>
            </form>

            <a href="/login" class="back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Login
            </a>

        </div>
    </div>

</div>
</body>
</html>