@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --warning:       #D97706;
    --warning-light: #FFFBEB;
    --success:       #059669;
    --success-light: #ECFDF5;
    --danger:        #DC2626;
    --danger-light:  #FEF2F2;
    --neutral-light: #F9FAFB;
    --bg:            #F3F4F8;
    --surface:       #FFFFFF;
    --border:        #E5E7EB;
    --text-dark:     #111827;
    --text-mid:      #374151;
    --text-soft:     #6B7280;
    --radius-md:     10px;
    --radius-lg:     14px;
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
    background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
    border-bottom: 1px solid #FDE68A;
    text-align: center;
}
.sw-card-header-icon {
    width: 52px; height: 52px;
    background: var(--warning);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; margin: 0 auto 16px;
    box-shadow: 0 4px 14px rgba(217,119,6,.3);
}
.sw-card-header h4 {
    font-size: 18px; font-weight: 700;
    color: #92400E; margin: 0 0 4px;
    letter-spacing: -.3px;
}
.sw-card-header p { font-size: 12.5px; color: #A16207; margin: 0; }

.sw-card-body { padding: 28px 32px; }

/* ALERTS */
.sw-alert {
    display: flex; align-items: center; gap: 9px;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    font-size: 12.5px; margin-bottom: 20px;
}
.sw-alert-danger  { background: var(--danger-light);  border: 1px solid #FECACA; color: var(--danger); }
.sw-alert-success { background: var(--success-light); border: 1px solid #A7F3D0; color: var(--success); }

/* FORM */
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
    border-color: var(--warning);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(217,119,6,.1);
}
.sw-input::placeholder { color: #C3C7D0; }

.sw-btn-submit {
    width: 100%; padding: 13px; border-radius: var(--radius-md); border: none;
    background: var(--warning); color: #fff;
    font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .18s; margin-top: 8px;
    box-shadow: 0 4px 14px rgba(217,119,6,.3);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.sw-btn-submit:hover { background: #B45309; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(217,119,6,.35); }
</style>

<div class="sw-page">
    <div class="sw-card">

        <div class="sw-card-header">
            <div class="sw-card-header-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
            </div>
            <h4>Reset Password</h4>
            <p>Buat password baru untuk akun Anda</p>
        </div>

        <div class="sw-card-body">

            {{-- ERROR --}}
            @if(session('error'))
            <div class="sw-alert sw-alert-danger">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
            @endif

            {{-- SUCCESS --}}
            @if(session('success'))
            <div class="sw-alert sw-alert-success">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="sw-form-group">
                    <label class="sw-label">Password Baru <span>*</span></label>
                    <div class="sw-input-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" name="password" class="sw-input" placeholder="Password baru" required>
                    </div>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Konfirmasi Password <span>*</span></label>
                    <div class="sw-input-wrap">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        <input type="password" name="password_confirmation" class="sw-input" placeholder="Konfirmasi password" required>
                    </div>
                </div>

                <button type="submit" class="sw-btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Reset Password
                </button>

            </form>
        </div>
    </div>
</div>

@endsection