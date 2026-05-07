<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sistem Akademik</title>
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

/* step indicators */
.steps {
    margin-top: 36px;
    display: flex; flex-direction: column; gap: 12px;
    width: 100%; max-width: 220px;
}
.step {
    display: flex; align-items: center; gap: 12px;
    text-align: left;
}
.step-dot {
    width: 30px; height: 30px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.step-dot.done  { background: #D1FAE5; color: #059669; }
.step-dot.active { background: #4F46E5; color: #fff; box-shadow: 0 0 0 4px #C7D2FE; }
.step-dot.pending { background: #F3F4F6; color: #9CA3AF; }
.step-text { font-size: 12.5px; font-weight: 600; }
.step-text.done   { color: #059669; }
.step-text.active { color: #4F46E5; }
.step-text.pending{ color: #9CA3AF; }

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
.form-box {
    width: 340px;
    position: relative; z-index: 2;
    text-align: center;
}

/* OTP icon ring */
.otp-icon {
    width: 68px; height: 68px;
    border-radius: 50%;
    background: rgba(255,255,255,.12);
    border: 2px solid rgba(255,255,255,.25);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 22px;
    backdrop-filter: blur(8px);
}

.form-title {
    font-size: 24px; font-weight: 800;
    color: #fff; letter-spacing: -.5px; margin-bottom: 6px;
}
.form-sub {
    font-size: 13px; color: rgba(255,255,255,.65);
    line-height: 1.6; margin-bottom: 32px;
}

/* ── OTP INPUT ── */
.input-wrap { position: relative; margin-bottom: 16px; }
.input-wrap svg {
    position: absolute; left: 16px; top: 50%;
    transform: translateY(-50%); color: rgba(255,255,255,.5); pointer-events: none;
}
.input-wrap input {
    width: 100%;
    padding: 15px 16px 15px 48px;
    border-radius: 14px;
    border: 1.5px solid rgba(255,255,255,.2);
    background: rgba(255,255,255,.12);
    color: #fff; font-size: 20px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    letter-spacing: 6px; text-align: center;
    outline: none; transition: all .2s;
    backdrop-filter: blur(6px);
}
.input-wrap input::placeholder {
    color: rgba(255,255,255,.3);
    font-size: 14px; font-weight: 400; letter-spacing: 1px;
}
.input-wrap input:focus {
    border-color: rgba(255,255,255,.55);
    background: rgba(255,255,255,.2);
    box-shadow: 0 0 0 3px rgba(255,255,255,.12);
}

/* expiry hint */
.otp-hint {
    font-size: 12px; color: rgba(255,255,255,.5);
    margin-bottom: 20px; display: flex; align-items: center;
    justify-content: center; gap: 5px;
}

/* ── BUTTON ── */
.btn-verify {
    width: 100%; padding: 14px; border-radius: 12px; border: none;
    background: linear-gradient(135deg, #10B981, #059669);
    color: #fff; font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .2s;
    box-shadow: 0 4px 16px rgba(5,150,105,.4);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-verify:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(5,150,105,.45); }

/* ── ALERT ── */
.sw-alert {
    display: flex; align-items: center; gap: 8px;
    background: rgba(239,68,68,.15); border: 1px solid rgba(239,68,68,.3);
    border-radius: 10px; padding: 11px 14px;
    font-size: 12.5px; color: #FCA5A5; margin-bottom: 18px;
    text-align: left;
}

/* ── BACK LINK ── */
.back-link {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    margin-top: 20px;
    font-size: 12.5px; color: rgba(255,255,255,.55);
    text-decoration: none; transition: color .2s;
}
.back-link:hover { color: #fff; }

@media (max-width: 640px) {
    .left { display: none; }
    .right { width: 100%; }
}
    </style>
</head>
<body>
<div class="page">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('sbadmin2/img/logosmasa.png') }}" class="logo" alt="Logo">
        <div class="left-title">SMAN 1<br>BONDOWOSO</div>
        <div class="left-sub">Masukkan kode OTP yang telah<br>dikirim ke email Anda</div>
        <div class="left-badge"><span></span> Verifikasi 2 Langkah</div>

        <!-- Step indicators -->
        <div class="steps">
            <div class="step">
                <div class="step-dot done">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="step-text done">Email & Password</div>
            </div>
            <div class="step">
                <div class="step-dot active">2</div>
                <div class="step-text active">Verifikasi OTP</div>
            </div>
            <div class="step">
                <div class="step-dot pending">3</div>
                <div class="step-text pending">Akses Portal</div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">

            <div class="otp-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.8"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
            </div>

            <div class="form-title">Verifikasi OTP</div>
            <div class="form-sub">Kode OTP telah dikirim ke email Anda.<br>Segera masukkan sebelum kadaluarsa.</div>

            @if(session('error'))
            <div class="sw-alert">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('verify.otp') }}">
                @csrf

                <div class="input-wrap">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    <input type="text" name="otp" placeholder="_ _ _ _ _ _"
                        maxlength="6" inputmode="numeric" autocomplete="one-time-code" required>
                </div>

                <div class="otp-hint">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Kode berlaku selama beberapa menit
                </div>

                <button type="submit" class="btn-verify">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    Verifikasi Sekarang
                </button>

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