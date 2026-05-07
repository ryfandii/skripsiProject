@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --primary:      #4F46E5;
    --primary-dark: #3730A3;
    --primary-light:#EEF2FF;
    --danger:       #DC2626;
    --neutral-light:#F9FAFB;
    --bg:           #F3F4F8;
    --surface:      #FFFFFF;
    --border:       #E5E7EB;
    --text-dark:    #111827;
    --text-mid:     #374151;
    --text-soft:    #6B7280;
    --radius-md:    10px;
    --radius-lg:    14px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.sw-page {
    min-height: 100vh; background: var(--bg);
    display: flex; align-items: center; justify-content: center;
    padding: 32px 16px;
}

.sw-card {
    width: 100%; max-width: 440px;
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    overflow: hidden;
}

.sw-card-header {
    padding: 28px 32px 24px;
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
    border-bottom: 1px solid #DDD6FE;
    text-align: center;
}
.sw-card-header-icon {
    width: 52px; height: 52px;
    background: var(--primary);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; margin: 0 auto 16px;
    box-shadow: 0 4px 14px rgba(79,70,229,.3);
}
.sw-card-header h4 {
    font-size: 18px; font-weight: 700;
    color: #3730A3; margin: 0 0 4px;
    letter-spacing: -.3px;
}
.sw-card-header p {
    font-size: 12.5px; color: #6D6AA4; margin: 0;
}

.sw-card-body { padding: 28px 32px; }

.sw-info-banner {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--primary-light);
    border: 1px solid #C7D2FE;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    font-size: 12.5px; color: #3730A3;
    margin-bottom: 24px; line-height: 1.6;
}
.sw-info-banner svg { flex-shrink: 0; margin-top: 1px; }

.sw-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
.sw-label { font-size: 12.5px; font-weight: 600; color: var(--text-mid); }
.sw-label span { color: var(--danger); margin-left: 2px; }

.sw-input-wrap { position: relative; }
.sw-input-wrap svg {
    position: absolute; left: 14px; top: 50%;
    transform: translateY(-50%); color: #9CA3AF; pointer-events: none;
}
.sw-input {
    width: 100%;
    padding: 11px 14px 11px 42px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: var(--neutral-light);
    outline: none; transition: all .15s;
}
.sw-input:focus {
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}
.sw-input::placeholder { color: #C3C7D0; }

.sw-btn-submit {
    width: 100%; padding: 13px; border-radius: var(--radius-md); border: none;
    background: var(--primary); color: #fff;
    font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .18s; margin-top: 8px;
    box-shadow: 0 4px 14px rgba(79,70,229,.3);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.sw-btn-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,.35); }
</style>

<div class="sw-page">
    <div class="sw-card">

        <div class="sw-card-header">
            <div class="sw-card-header-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <h4>Ganti Password</h4>
            <p>Buat password baru yang kuat untuk akun Anda</p>
        </div>

        <div class="sw-card-body">

            <div class="sw-info-banner">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                Anda diwajibkan mengganti password sebelum dapat menggunakan sistem. Gunakan minimal 8 karakter.
            </div>

            <form method="POST" action="{{ route('force.password.update') }}">
                @csrf

                <div class="sw-form-group">
                    <label class="sw-label">Password Baru <span>*</span></label>
                    <div class="sw-input-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" name="password" class="sw-input" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Konfirmasi Password <span>*</span></label>
                    <div class="sw-input-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        <input type="password" name="password_confirmation" class="sw-input" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="sw-btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Password
                </button>

            </form>
        </div>
    </div>
</div>

@endsection