@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --warning:       #D97706;
    --warning-light: #FFFBEB;
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
    background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
}
.sw-card-header-icon {
    width: 38px; height: 38px;
    background: var(--warning);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.sw-card-header h5 { font-size: 15px; font-weight: 700; color: #92400E; margin: 0; }
.sw-card-header p  { font-size: 12.5px; color: #A16207; margin: 2px 0 0; }

.sw-id-chip {
    margin-left: auto;
    background: var(--warning-light);
    border: 1px solid #FDE68A;
    border-radius: 99px;
    padding: 5px 14px;
    font-size: 12px; font-weight: 600;
    color: var(--warning);
    display: flex; align-items: center; gap: 6px;
    white-space: nowrap;
}

.sw-card-body { padding: 28px 24px; }

.sw-section {
    display: flex; align-items: center; gap: 10px;
    margin: 0 0 20px;
}
.sw-section-label {
    font-size: 12px; font-weight: 700; color: var(--warning);
    text-transform: uppercase; letter-spacing: .8px; white-space: nowrap;
}
.sw-section-line {
    flex: 1; height: 1px;
    background: linear-gradient(to right, #FDE68A, transparent);
}

.sw-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.sw-label { font-size: 12.5px; font-weight: 600; color: var(--text-mid); }
.sw-label span { color: var(--danger); margin-left: 2px; }

.sw-input {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark);
    background: var(--neutral-light);
    outline: none; width: 100%;
    transition: border-color .15s, box-shadow .15s, background .15s;
}
.sw-input:focus {
    border-color: var(--warning);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(217,119,6,.1);
}
.sw-input::placeholder { color: #C3C7D0; }

.sw-alert-danger {
    display: flex; gap: 10px; align-items: flex-start;
    padding: 14px 16px;
    background: var(--danger-light);
    border: 1px solid #FECACA;
    border-radius: var(--radius-md);
    color: var(--danger);
    font-size: 13px;
    margin-bottom: 22px;
}
.sw-alert-danger > div { display: flex; flex-direction: column; gap: 3px; }

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
.sw-btn-warning { background: var(--warning); color: #fff; }
.sw-btn-warning:hover { background: #B45309; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(217,119,6,.3); color: #fff; }

@media (max-width: 640px) {
    .sw-page { padding: 16px; }
    .sw-id-chip { display: none; }
}
</style>

<div class="sw-page">

    <div class="sw-topbar">
        <h3>Edit Kelas</h3>
        <p>Perbarui informasi kelas yang tersimpan di sistem</p>
    </div>

    <div class="sw-card">
        <div class="sw-card-header">
            <div class="sw-card-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <div>
                <h5>Edit Kelas</h5>
                <p>Semua kolom bertanda <span style="color:#DC2626">*</span> wajib diisi</p>
            </div>
            <div class="sw-id-chip">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M8 12h8M8 16h5"/></svg>
                {{ $kelas->nama_kelas }}
            </div>
        </div>

        <div class="sw-card-body">

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="sw-alert-danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="flex-shrink:0;margin-top:2px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="sw-section">
                <span class="sw-section-label">Informasi Kelas</span>
                <div class="sw-section-line"></div>
            </div>

            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sw-form-group">
                    <label class="sw-label">Nama Kelas <span>*</span></label>
                    <input type="text" name="nama_kelas" class="sw-input"
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                        placeholder="Contoh: X IPA 1" required>
                </div>

                <div class="sw-form-group">
                    <label class="sw-label">Jurusan <span>*</span></label>
                    <input type="text" name="jurusan" class="sw-input"
                        value="{{ old('jurusan', $kelas->jurusan) }}"
                        placeholder="Contoh: IPA" required>
                </div>

                <div class="sw-footer">
                    <a href="{{ route('admin.kelas.index') }}" class="sw-btn sw-btn-secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                    <button type="submit" class="sw-btn sw-btn-warning">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Update Kelas
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection