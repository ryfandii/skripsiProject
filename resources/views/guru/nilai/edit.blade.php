@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
:root{--primary:#2563eb;--primary-light:#eff6ff;--primary-border:#bfdbfe;--primary-dark:#1d4ed8;--success:#16a34a;--text-primary:#0f172a;--text-secondary:#475569;--surface:#ffffff;--surface-secondary:#f8fafc;--border:#e2e8f0;--shadow-md:0 4px 20px rgba(0,0,0,0.08);--radius-md:10px;--radius-lg:14px;--radius-xl:18px;}
*{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box;}
.page-wrapper{animation:fadeUp 0.4s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.section-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-xl);box-shadow:var(--shadow-md);overflow:hidden;max-width:540px;margin:0 auto;}
.card-header{padding:20px 24px;border-bottom:1px solid var(--border);background:var(--surface-secondary);}
.card-title{font-size:16px;font-weight:700;color:var(--text-primary);margin:0 0 2px;}
.card-sub{font-size:13px;color:var(--text-secondary);margin:0;}
.card-body{padding:24px;}
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:13px;font-weight:600;color:var(--text-primary);margin-bottom:6px;}
.form-label span{font-size:11.5px;font-weight:400;color:var(--text-secondary);margin-left:6px;}
.form-control{width:100%;padding:10px 14px;font-size:13.5px;font-family:'Plus Jakarta Sans',sans-serif;border:1px solid var(--border);border-radius:var(--radius-md);color:var(--text-primary);outline:none;transition:border-color .2s;}
.form-control:focus{border-color:var(--primary);}
.form-footer{display:flex;gap:10px;align-items:center;padding-top:4px;}
.btn-save{display:inline-flex;align-items:center;gap:7px;padding:10px 22px;font-size:13.5px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--primary);color:#fff;border:none;border-radius:var(--radius-md);cursor:pointer;transition:all .15s;box-shadow:0 2px 8px rgba(37,99,235,0.25);}
.btn-save:hover{background:var(--primary-dark);transform:translateY(-1px);}
.btn-back{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;font-size:13px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;background:var(--surface-secondary);color:var(--text-secondary);border:1px solid var(--border);border-radius:var(--radius-md);text-decoration:none;transition:all .15s;}
.btn-back:hover{background:var(--border);color:var(--text-primary);text-decoration:none;}
.siswa-info{display:flex;align-items:center;gap:12px;background:var(--primary-light);border:1px solid var(--primary-border);border-radius:var(--radius-lg);padding:12px 16px;margin-bottom:22px;}
.siswa-avatar{width:40px;height:40px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;flex-shrink:0;}
.siswa-name{font-size:14px;font-weight:700;color:var(--text-primary);}
.siswa-kelas{font-size:12px;color:var(--text-secondary);margin-top:2px;}
</style>

<div class="container-fluid px-4 py-3 page-wrapper">
    <div class="section-card">
        <div class="card-header">
            <h5 class="card-title">Edit Nilai Siswa</h5>
            <p class="card-sub">Ubah nilai tugas, UTS, dan UAS</p>
        </div>
        <div class="card-body">
            {{-- Info siswa --}}
            <div class="siswa-info">
                <div class="siswa-avatar">{{ strtoupper(substr($nilai->siswa->nama ?? 'S', 0, 2)) }}</div>
                <div>
                    <div class="siswa-name">{{ $nilai->siswa->nama ?? '—' }}</div>
                    <div class="siswa-kelas">{{ $nilai->siswa->kelas->nama_kelas ?? '—' }} · {{ $nilai->mapel->nama_mapel ?? '—' }}</div>
                </div>
            </div>

            <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nilai Tugas <span>(rata-rata semua tugas)</span></label>
                    <input type="number" name="nilai_tugas" class="form-control"
                        value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}"
                        min="0" max="100" step="0.01" placeholder="0 – 100">
                </div>

                <div class="form-group">
                    <label class="form-label">Nilai UTS</label>
                    <input type="number" name="nilai_uts" class="form-control"
                        value="{{ old('nilai_uts', $nilai->nilai_uts) }}"
                        min="0" max="100" step="0.01" placeholder="0 – 100">
                </div>

                <div class="form-group">
                    <label class="form-label">Nilai UAS</label>
                    <input type="number" name="nilai_uas" class="form-control"
                        value="{{ old('nilai_uas', $nilai->nilai_uas) }}"
                        min="0" max="100" step="0.01" placeholder="0 – 100">
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-save">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('guru.nilai.index') }}" class="btn-back">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection