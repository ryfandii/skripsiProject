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

.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

.sw-topbar { margin-bottom: 24px; }
.sw-topbar h3 { font-size: 21px; font-weight: 700; color: var(--text-dark); margin: 0 0 4px; letter-spacing: -.3px; }
.sw-topbar p  { font-size: 13px; color: var(--text-soft); margin: 0; }

.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    overflow: hidden;
}

.sw-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
}
.sw-card-header-icon {
    width: 38px; height: 38px;
    background: var(--success);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.sw-card-header h5 { font-size: 15px; font-weight: 700; color: #065F46; margin: 0; }
.sw-card-header p  { font-size: 12.5px; color: #047857; margin: 2px 0 0; }

.sw-card-body { padding: 28px 24px; }

.sw-section {
    display: flex; align-items: center; gap: 10px;
    margin: 0 0 20px;
}
.sw-section-label {
    font-size: 12px; font-weight: 700; color: var(--success);
    text-transform: uppercase; letter-spacing: .8px; white-space: nowrap;
}
.sw-section-line {
    flex: 1; height: 1px;
    background: linear-gradient(to right, #A7F3D0, transparent);
}

.sw-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.sw-label { font-size: 12.5px; font-weight: 600; color: var(--text-mid); }
.sw-label span { color: var(--danger); margin-left: 2px; }

.sw-input, .sw-select {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark);
    background: var(--neutral-light);
    outline: none;
    width: 100%;
    transition: border-color .15s, box-shadow .15s, background .15s;
}
.sw-input:focus, .sw-select:focus {
    border-color: var(--success);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(5,150,105,.1);
}
.sw-input::placeholder { color: #C3C7D0; }

.sw-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 24px;
    border-top: 1px solid var(--border);
    margin-top: 8px;
}

.sw-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    font-size: 13.5px; font-weight: 600;
    border: none; cursor: pointer; text-decoration: none;
    transition: all .18s ease; line-height: 1;
}
.sw-btn-secondary { background: var(--surface); color: var(--text-mid); border: 1.5px solid var(--border); }
.sw-btn-secondary:hover { background: var(--neutral-light); color: var(--text-mid); }
.sw-btn-success { background: var(--success); color: #fff; }
.sw-btn-success:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(5,150,105,.3); color: #fff; }

@media (max-width: 640px) { .sw-page { padding: 16px; } }
</style>

<div class="sw-page">

    <div class="sw-topbar">
        <h3>Tambah Kelas</h3>
        <p>Daftarkan kelas baru ke dalam sistem</p>
    </div>

    <div class="sw-card">
        <div class="sw-card-header">
            <div class="sw-card-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <h5>Formulir Kelas Baru</h5>
                <p>Semua kolom bertanda <span style="color:#DC2626">*</span> wajib diisi</p>
            </div>
        </div>

        <div class="sw-card-body">

            <div class="sw-section">
                <span class="sw-section-label">Informasi Kelas</span>
                <div class="sw-section-line"></div>
            </div>

            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf

                <div class="sw-form-group">
                    <label class="sw-label">Nama Kelas <span>*</span></label>
                    <input type="text" name="nama_kelas" class="sw-input" placeholder="Contoh: X IPA 1">
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Jurusan <span>*</span></label>
                    <select name="jurusan" class="sw-select">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                    </select>
                </div>

                <div class="sw-footer">
                    <a href="{{ route('admin.kelas.index') }}" class="sw-btn sw-btn-secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                    <button type="submit" class="sw-btn sw-btn-success">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Kelas
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection