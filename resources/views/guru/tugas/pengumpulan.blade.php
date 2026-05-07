@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --primary:       #4F46E5;
    --primary-dark:  #3730A3;
    --primary-light: #EEF2FF;
    --success:       #059669;
    --success-light: #ECFDF5;
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
    --radius-lg:     16px;
}

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.sw-page { padding: 28px 32px; background: var(--bg); min-height: 100vh; }

/* ── TOPBAR ── */
.sw-topbar { margin-bottom: 24px; }
.sw-topbar h3 { font-size: 21px; font-weight: 800; color: var(--text-dark); margin: 0 0 4px; letter-spacing: -.3px; }
.sw-topbar p  { font-size: 13px; color: var(--text-soft); margin: 0; }

/* ── HEADER CARD ── */
.sw-header-card {
    background: linear-gradient(135deg, #1E3A6E 0%, #3730A3 55%, #4F46E5 100%);
    border-radius: var(--radius-lg);
    padding: 24px 28px;
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 24px;
    position: relative; overflow: hidden;
}
.sw-header-card::before {
    content: ''; position: absolute;
    right: -40px; top: -40px;
    width: 180px; height: 180px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.08);
}
.sw-header-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.2);
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.sw-header-title { font-size: 19px; font-weight: 800; color: #fff; margin: 0 0 6px; line-height: 1.3; }
.sw-header-chips { display: flex; gap: 8px; flex-wrap: wrap; }
.sw-header-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
    border-radius: 99px; padding: 4px 12px;
    font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,.9);
}

/* ── SUMMARY STATS ── */
.sw-stats { display: flex; gap: 14px; margin-bottom: 24px; flex-wrap: wrap; }
.sw-stat {
    flex: 1; min-width: 130px;
    background: var(--surface);
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    padding: 16px 18px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.sw-stat-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.sw-stat-icon.primary { background: var(--primary-light); color: var(--primary); }
.sw-stat-icon.success { background: var(--success-light); color: var(--success); }
.sw-stat-icon.warning { background: var(--warning-light); color: var(--warning); }
.sw-stat-val { font-size: 22px; font-weight: 800; color: var(--text-dark); line-height: 1; }
.sw-stat-lbl { font-size: 11.5px; font-weight: 600; color: var(--text-soft); margin-top: 3px; }

/* ── MAIN CARD ── */
.sw-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    overflow: hidden;
}
.sw-card-hd {
    padding: 16px 22px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
    display: flex; align-items: center; justify-content: space-between;
}
.sw-card-hd-left { display: flex; align-items: center; gap: 10px; }
.sw-card-hd-icon {
    width: 34px; height: 34px; border-radius: 9px;
    background: var(--primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
}
.sw-card-hd h6 { font-size: 14px; font-weight: 700; color: #3730A3; margin: 0; }
.sw-card-hd p  { font-size: 11.5px; color: #6D6AA4; margin: 2px 0 0; }

/* ── TABLE ── */
.sw-table-wrap { overflow-x: auto; }
table.sw-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }

table.sw-table thead tr {
    background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
    border-bottom: 2px solid #DDD6FE;
}
table.sw-table thead th {
    padding: 12px 16px; font-weight: 700;
    font-size: 11.5px; color: #5B21B6;
    text-transform: uppercase; letter-spacing: .6px;
    white-space: nowrap; border: none;
}
table.sw-table tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
table.sw-table tbody tr:last-child { border-bottom: none; }
table.sw-table tbody tr:hover { background: #FAFAFF; }
table.sw-table td { padding: 14px 16px; border: none; vertical-align: middle; color: var(--text-mid); }

/* ── AVATAR ── */
.sw-avatar-row { display: flex; align-items: center; gap: 10px; }
.sw-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--primary-light); border: 2px solid #C7D2FE;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: var(--primary);
    flex-shrink: 0;
}
.sw-avatar-name { font-weight: 700; color: var(--text-dark); font-size: 13.5px; }

/* ── DOWNLOAD LINK ── */
.sw-dl-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--primary-light); border: 1px solid #C7D2FE;
    border-radius: 8px; padding: 6px 12px;
    font-size: 12px; font-weight: 600; color: var(--primary);
    text-decoration: none; transition: all .15s;
    white-space: nowrap;
}
.sw-dl-btn:hover { background: var(--primary); color: #fff; }

/* ── TIME ── */
.sw-time { font-size: 12.5px; color: var(--text-soft); white-space: nowrap; }

/* ── BADGES ── */
.sw-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 99px;
    font-size: 11.5px; font-weight: 600;
}
.sw-badge-success { background: var(--success-light); color: var(--success); }
.sw-badge-warning { background: var(--warning-light); color: var(--warning); }
.sw-badge span { width: 6px; height: 6px; border-radius: 50%; }
.sw-badge-success span { background: var(--success); }
.sw-badge-warning span { background: var(--warning); }

/* ── INLINE FORM INPUTS ── */
.sw-nilai-input {
    width: 72px; padding: 7px 10px;
    border: 1.5px solid var(--border);
    border-radius: 8px; font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: var(--neutral-light);
    outline: none; text-align: center;
    transition: all .15s;
}
.sw-nilai-input:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

.sw-komentar-input {
    width: 100%; min-width: 160px; padding: 7px 12px;
    border: 1.5px solid var(--border);
    border-radius: 8px; font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark); background: var(--neutral-light);
    outline: none; transition: all .15s;
}
.sw-komentar-input:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(79,70,229,.1); }

/* ── SAVE BUTTON ── */
.sw-save-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 8px; border: none;
    background: var(--success); color: #fff;
    font-size: 12.5px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .18s;
    white-space: nowrap;
}
.sw-save-btn:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(5,150,105,.3); }

/* ── EMPTY ── */
.sw-empty { padding: 50px 20px; text-align: center; color: var(--text-soft); }
.sw-empty-icon { font-size: 36px; opacity: .3; margin-bottom: 10px; }
.sw-empty p { font-size: 14px; margin: 0; }

@media (max-width: 768px) { .sw-page { padding: 14px; } }

.btn-hitung-rata {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: 10px; border: none;
    background: #059669; color: #fff;
    font-size: 13.5px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: all .18s;
}
.btn-hitung-rata:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(5,150,105,.3); }
.badge-predikat {
    display: inline-flex; align-items: center;
    padding: 4px 12px; border-radius: 99px;
    font-size: 11.5px; font-weight: 700;
}
.badge-predikat.a { background: #DCFCE7; color: #166534; }
.badge-predikat.b { background: #EEF2FF; color: #3730A3; }
.badge-predikat.c { background: #FFFBEB; color: #92400E; }
.badge-predikat.d { background: #FEF2F2; color: #991B1B; }
.nilai-chip {
    display: inline-flex; padding: 5px 16px;
    border-radius: 99px; font-size: 15px; font-weight: 800;
}
.nilai-chip.a { background: #DCFCE7; color: #166534; }
.nilai-chip.b { background: #EEF2FF; color: #3730A3; }
.nilai-chip.c { background: #FFFBEB; color: #92400E; }
.nilai-chip.d { background: #FEF2F2; color: #991B1B; }
</style>

<div class="sw-page">

    {{-- TOPBAR --}}
    <div class="sw-topbar">
        <h3>Pengumpulan Tugas</h3>
        <p>Nilai dan berikan komentar untuk setiap siswa</p>
    </div>

    {{-- HEADER CARD --}}
    <div class="sw-header-card">
        <div class="sw-header-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        </div>
        <div style="position:relative;z-index:1;">
            <div class="sw-header-title">{{ $tugas->judul }}</div>
            <div class="sw-header-chips">
                <div class="sw-header-chip">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    {{ $tugas->pengumpulan->count() }} Pengumpulan
                </div>
                <div class="sw-header-chip">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    {{ $tugas->pengumpulan->whereNotNull('nilai')->count() }} Sudah Dinilai
                </div>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="sw-stats">
        <div class="sw-stat">
            <div class="sw-stat-icon primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $tugas->pengumpulan->count() }}</div>
                <div class="sw-stat-lbl">Total Kumpul</div>
            </div>
        </div>
        <div class="sw-stat">
            <div class="sw-stat-icon success">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $tugas->pengumpulan->where('status', '!=', 'telat')->count() }}</div>
                <div class="sw-stat-lbl">Tepat Waktu</div>
            </div>
        </div>
        <div class="sw-stat">
            <div class="sw-stat-icon warning">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $tugas->pengumpulan->where('status', 'telat')->count() }}</div>
                <div class="sw-stat-lbl">Telat</div>
            </div>
        </div>
        <div class="sw-stat">
            <div class="sw-stat-icon primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </div>
            <div>
                <div class="sw-stat-val">{{ $tugas->pengumpulan->whereNotNull('nilai')->count() }}</div>
                <div class="sw-stat-lbl">Sudah Dinilai</div>
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="sw-card">
        <div class="sw-card-hd">
            <div class="sw-card-hd-left">
                <div class="sw-card-hd-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                </div>
                <div>
                    <h6>Daftar Pengumpulan</h6>
                    <p>Isi nilai dan komentar lalu klik Simpan</p>
                </div>
            </div>
        </div>

        <div class="sw-table-wrap">
            <table class="sw-table">
                <thead>
                    <tr>
                        <th style="width:36px">#</th>
                        <th>Nama Siswa</th>
                        <th>File</th>
                        <th>Waktu Kumpul</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width:90px">Nilai</th>
                        <th>Komentar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tugas->pengumpulan as $p)
                    <tr>
                        <td style="color:var(--text-soft);font-size:12px;">{{ $loop->iteration }}</td>

                        <td>
                            <div class="sw-avatar-row">
                                <div class="sw-avatar">
                                    {{ strtoupper(substr($p->siswa->nama ?? 'S', 0, 1)) }}
                                </div>
                                <div class="sw-avatar-name">{{ $p->siswa->nama ?? '-' }}</div>
                            </div>
                        </td>

                        <td>
                            <a href="{{ asset('storage/' . $p->file) }}" target="_blank" class="sw-dl-btn">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download
                            </a>
                        </td>

                        <td>
                            <div class="sw-time">
                                {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}<br>
                                <span style="font-size:11.5px">{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }}</span>
                            </div>
                        </td>

                        <td style="text-align:center">
                            @if($p->status == 'telat')
                                <span class="sw-badge sw-badge-warning"><span></span>Telat</span>
                            @else
                                <span class="sw-badge sw-badge-success"><span></span>Tepat Waktu</span>
                            @endif
                        </td>

                        {{-- INLINE FORM --}}
                        <form method="POST" action="{{ route('guru.tugas.nilai', $p->id) }}" style="display:contents">
                            @csrf

                            <td style="text-align:center">
                                <input type="number" name="nilai"
                                    value="{{ $p->nilai }}"
                                    class="sw-nilai-input"
                                    min="0" max="100"
                                    placeholder="—">
                            </td>

                            <td>
                                <input type="text" name="komentar"
                                    value="{{ $p->komentar }}"
                                    class="sw-komentar-input"
                                    placeholder="Tambah komentar...">
                            </td>

                            <td style="text-align:center">
                                <button type="submit" class="sw-save-btn">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                    Simpan
                                </button>
                            </td>

                        </form>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="sw-empty">
                                <div class="sw-empty-icon">📭</div>
                                <p>Belum ada siswa yang mengumpulkan tugas ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- TOMBOL HITUNG RATA-RATA --}}
<!-- <div style="margin-top:20px;text-align:right">
    <button onclick="hitungRataRata()" class="btn-hitung-rata">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        Hitung Rata-Rata Nilai
    </button>
</div> -->

{{-- TABEL RATA-RATA --}}
<div id="rata-section" style="display:none;margin-top:20px">
    <div class="sw-card">
        <div class="sw-card-hd">
            <div class="sw-card-hd-left">
                <div class="sw-card-hd-icon" style="background:#059669">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                </div>
                <div>
                    <h6 style="color:#065F46">Rekap Nilai Rata-Rata Siswa</h6>
                    <p>Rata-rata dihitung dari semua tugas yang sudah dinilai guru</p>
                </div>
            </div>
        </div>
        <div class="sw-table-wrap">
            <table class="sw-table">
                <thead style="background:linear-gradient(135deg,#F0FDF4,#DCFCE7)">
                    <tr>
                        <th style="color:#166534">#</th>
                        <th style="color:#166534">Nama Siswa</th>
                        <th style="color:#166534;text-align:center">Tugas Dikumpul</th>
                        <th style="color:#166534;text-align:center">Tugas Dinilai</th>
                        <th style="color:#166634;text-align:center">Rata-Rata Nilai</th>
                        <th style="color:#166534;text-align:center">Predikat</th>
                    </tr>
                </thead>
                <tbody id="rata-tbody"></tbody>
            </table>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 22px;border-top:1px solid var(--border);background:var(--neutral-light);font-size:13px;color:var(--text-soft)">
            <span>Rata-rata keseluruhan kelas</span>
            <strong id="rata-kelas" style="font-size:16px;color:var(--text-dark)">—</strong>
        </div>
    </div>
</div>

</div>


<script>
const pengumpulanData = @json($pengumpulanJson);

function hitungRataRata() {
    const tbody = document.getElementById('rata-tbody');
    tbody.innerHTML = '';

    let totalKelas = 0;
    let jumlahDinilai = 0;

    pengumpulanData.forEach((p, i) => {
        const nilai = p.nilai !== null ? parseFloat(p.nilai) : null;
        const avgText = nilai !== null ? Math.round(nilai) : '—';
        const cls = nilai !== null ? getKelas(nilai) : '';

        if (nilai !== null) {
            totalKelas += nilai;
            jumlahDinilai++;
        }

        tbody.innerHTML += `
          <tr>
            <td style="color:var(--text-soft);font-size:12px">${i+1}</td>
            <td>
              <div class="sw-avatar-row">
                <div class="sw-avatar">${p.inisial}</div>
                <span style="font-weight:700">${p.nama}</span>
              </div>
            </td>
            <td style="text-align:center">1 tugas</td>
            <td style="text-align:center">
              ${nilai !== null
                ? '<span style="color:var(--success);font-weight:600">✔ Sudah dinilai</span>'
                : '<span style="color:var(--text-soft)">Belum dinilai</span>'}
            </td>
            <td style="text-align:center">
              ${nilai !== null
                ? `<span class="nilai-chip ${cls}">${avgText}</span>`
                : '<span style="color:var(--text-muted)">—</span>'}
            </td>
            <td style="text-align:center">
              ${nilai !== null
                ? `<span class="badge-predikat ${cls}">${getPredikat(nilai)}</span>`
                : '—'}
            </td>
          </tr>`;
    });

    const rataKelas = jumlahDinilai > 0
        ? Math.round(totalKelas / jumlahDinilai)
        : '—';

    document.getElementById('rata-kelas').textContent =
        jumlahDinilai > 0 ? rataKelas + ' / 100' : 'Belum ada nilai';

    document.getElementById('rata-section').style.display = 'block';
    document.getElementById('rata-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function getKelas(n) {
    if (n >= 88) return 'a';
    if (n >= 75) return 'b';
    if (n >= 60) return 'c';
    return 'd';
}

function getPredikat(n) {
    if (n >= 88) return 'A — Sangat Baik';
    if (n >= 75) return 'B — Baik';
    if (n >= 60) return 'C — Cukup';
    return 'D — Kurang';
}
</script>
@endsection