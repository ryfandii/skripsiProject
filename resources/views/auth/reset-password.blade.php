<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Akademik</title>
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
.logo:hover { transform: scale(1.04); }

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

/* Step indicators */
.steps {
    margin-top: 36px;
    display: flex; flex-direction: column; gap: 12px;
    width: 100%; max-width: 220px;
}
.step { display: flex; align-items: center; gap: 12px; text-align: left; }
.step-dot {
    width: 30px; height: 30px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.step-dot.done    { background: #D1FAE5; color: #059669; }
.step-dot.active  { background: #4F46E5; color: #fff; box-shadow: 0 0 0 4px #C7D2FE; }
.step-dot.pending { background: #F3F4F6; color: #9CA3AF; }
.step-text { font-size: 12.5px; font-weight: 600; }
.step-text.done    { color: #059669; }
.step-text.active  { color: #4F46E5; }
.step-text.pending { color: #9CA3AF; }

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

/* Icon ring */
.form-icon {
    width: 64px; height: 64px; border-radius: 50%;
    background: rgba(255,255,255,.12);
    border: 2px solid rgba(255,255,255,.25);
    display: flex; align-items: center; justify-content: center;
    margin: 0 0 22px;
    backdrop-filter: blur(8px);
}

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
.input-label {
    font-size: 11px; font-weight: 700;
    color: rgba(255,255,255,.5);
    text-transform: uppercase; letter-spacing: 1px;
    margin-bottom: 6px; display: block;
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

/* Toggle password visibility */
.toggle-pw {
    position: absolute; right: 14px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    color: rgba(255,255,255,.4); padding: 0;
    transition: color .2s;
    display: flex; align-items: center;
}
.toggle-pw:hover { color: rgba(255,255,255,.8); }

/* Password strength bar */
.pw-strength {
    margin-top: 8px; margin-bottom: 4px;
    display: flex; gap: 4px; height: 3px;
}
.pw-strength-bar {
    flex: 1; border-radius: 99px;
    background: rgba(255,255,255,.15);
    transition: background .3s;
}
.pw-strength-bar.weak   { background: #EF4444; }
.pw-strength-bar.medium { background: #F59E0B; }
.pw-strength-bar.strong { background: #10B981; }
.pw-strength-text {
    font-size: 11px; color: rgba(255,255,255,.45);
    margin-bottom: 14px; min-height: 16px;
}

/* ── BUTTON ── */
.btn-submit {
    width: 100%; padding: 13px; border-radius: 12px; border: none;
    background: linear-gradient(135deg, #10B981, #059669);
    color: #fff; font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .2s; margin-top: 4px;
    box-shadow: 0 4px 16px rgba(5,150,105,.35);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(5,150,105,.4); }

/* ── ALERTS ── */
.sw-alert-error {
    display: flex; align-items: center; gap: 8px;
    background: rgba(239,68,68,.15); border: 1px solid rgba(239,68,68,.3);
    border-radius: 10px; padding: 11px 14px;
    font-size: 12.5px; color: #FCA5A5; margin-bottom: 18px;
}
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

    .left {
        width: 100%;
        padding: 32px 24px 28px;
        order: 1;
    }

    .left::after {
        right: unset; top: unset; left: 0; bottom: 0;
        width: 100%; height: 1px;
        background: linear-gradient(to right, transparent, #C7D2FE 30%, #C7D2FE 70%, transparent);
    }

    /* Sembunyikan steps di mobile agar tidak terlalu panjang */
    .steps { display: none; }

    .logo { width: 180px; margin-bottom: 20px; }
    .left-title { font-size: 18px; }
    .left-sub   { font-size: 12px; }
    .left-badge { margin-top: 20px; font-size: 11px; }

    .right {
        order: 2;
        padding: 36px 24px 52px;
        min-height: auto;
        align-items: flex-start;
        justify-content: center;
    }

    .right::before,
    .right::after { display: none; }

    .form-box { width: 100%; max-width: 420px; }
    .form-title { font-size: 21px; }
    .form-sub   { font-size: 12.5px; margin-bottom: 22px; }

    .input-wrap input { font-size: 16px; }
}

@media (max-width: 380px) {
    .left  { padding: 24px 20px 22px; }
    .logo  { width: 150px; }
    .right { padding: 28px 20px 44px; }
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
        <div class="left-sub">Buat password baru untuk<br>mengamankan akun Anda</div>
        <div class="left-badge"><span></span> Sistem Akademik Sekolah</div>

        <!-- Step indicators -->
        <div class="steps">
            <div class="step">
                <div class="step-dot done">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="step-text done">Masukkan Email</div>
            </div>
            <div class="step">
                <div class="step-dot done">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="step-text done">Verifikasi OTP</div>
            </div>
            <div class="step">
                <div class="step-dot active">3</div>
                <div class="step-text active">Reset Password</div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">

            <div class="form-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.8">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>

            <div class="form-title">Reset Password</div>
            <div class="form-sub">Buat password baru yang kuat<br>untuk mengamankan akun Anda.</div>

            {{-- Alert Error --}}
            @if(session('error'))
            <div class="sw-alert-error">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="flex-shrink:0">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            {{-- Alert Success --}}
            @if(session('success'))
            <div class="sw-alert-success">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="flex-shrink:0">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') ?? request('email') }}">

                {{-- Password Baru --}}
                <label class="input-label">Password Baru</label>
                <div class="input-wrap" style="margin-bottom:6px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" id="pw-new"
                        placeholder="Minimal 8 karakter" required
                        oninput="checkStrength(this.value)">
                    <button type="button" class="toggle-pw" onclick="togglePw('pw-new', this)" tabindex="-1">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="eye-new">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                {{-- Strength bar --}}
                <div class="pw-strength">
                    <div class="pw-strength-bar" id="bar1"></div>
                    <div class="pw-strength-bar" id="bar2"></div>
                    <div class="pw-strength-bar" id="bar3"></div>
                    <div class="pw-strength-bar" id="bar4"></div>
                </div>
                <div class="pw-strength-text" id="strength-text"></div>

                {{-- Konfirmasi Password --}}
                <label class="input-label">Konfirmasi Password</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                    <input type="password" name="password_confirmation" id="pw-confirm"
                        placeholder="Ulangi password baru" required>
                    <button type="button" class="toggle-pw" onclick="togglePw('pw-confirm', this)" tabindex="-1">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="eye-confirm">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Password Baru
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Login
            </a>

        </div>
    </div>

</div>

<script>
// ── Toggle show/hide password ──
function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const isHidden = inp.type === 'password';
    inp.type = isHidden ? 'text' : 'password';
    btn.querySelector('svg').innerHTML = isHidden
        ? '<line x1="1" y1="1" x2="23" y2="23"/><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}

// ── Password strength checker ──
function checkStrength(val) {
    const bars = [
        document.getElementById('bar1'),
        document.getElementById('bar2'),
        document.getElementById('bar3'),
        document.getElementById('bar4'),
    ];
    const txt = document.getElementById('strength-text');

    // Reset
    bars.forEach(b => { b.className = 'pw-strength-bar'; });

    if (!val) { txt.textContent = ''; return; }

    let score = 0;
    if (val.length >= 8)                    score++;
    if (/[A-Z]/.test(val))                  score++;
    if (/[0-9]/.test(val))                  score++;
    if (/[^A-Za-z0-9]/.test(val))          score++;

    const levels = [
        { cls: 'weak',   label: 'Lemah',  color: '#EF4444' },
        { cls: 'weak',   label: 'Lemah',  color: '#EF4444' },
        { cls: 'medium', label: 'Sedang', color: '#F59E0B' },
        { cls: 'strong', label: 'Kuat',   color: '#10B981' },
        { cls: 'strong', label: 'Sangat Kuat', color: '#10B981' },
    ];

    const lv = levels[score] || levels[0];
    for (let i = 0; i < score; i++) bars[i].classList.add(lv.cls);
    txt.textContent  = lv.label;
    txt.style.color  = lv.color;
}
</script>

</body>
</html>