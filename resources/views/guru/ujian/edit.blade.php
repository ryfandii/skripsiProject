@extends('layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #4F46E5;
            --primary-dark: #3730A3;
            --primary-light: #EEF2FF;
            --success: #059669;
            --success-light: #ECFDF5;
            --warning: #D97706;
            --warning-light: #FFFBEB;
            --danger: #DC2626;
            --danger-light: #FEF2F2;
            --info: #0284C7;
            --info-light: #F0F9FF;
            --bg: #F3F4F8;
            --surface: #FFFFFF;
            --border: #E5E7EB;
            --text-dark: #111827;
            --text-mid: #374151;
            --text-soft: #6B7280;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 18px;
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }

        #content {
            padding: 0 !important;
            background: var(--bg) !important;
        }

        #content-wrapper {
            background: var(--bg) !important;
        }

        .sw-page {
            padding: 28px 32px;
            background: var(--bg);
            min-height: calc(100vh - 70px);
        }

        /* ── BACK NAV ── */
        .back-nav {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-soft);
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 22px;
            transition: color .15s;
        }

        .back-nav:hover {
            color: var(--primary);
            text-decoration: none;
        }

        .back-nav svg {
            width: 16px;
            height: 16px;
        }

        /* ── PAGE HEADER ── */
        .sw-ph {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 26px;
        }

        .sw-ph-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--warning-light);
            border: 1px solid #FDE68A;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--warning);
            flex-shrink: 0;
        }

        .sw-ph-icon svg {
            width: 22px;
            height: 22px;
        }

        .sw-ph-title {
            font-size: 21px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0 0 3px;
            letter-spacing: -.3px;
        }

        .sw-ph-sub {
            font-size: 13px;
            color: var(--text-soft);
            margin: 0;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .fc-hd {
            padding: 15px 24px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, #F5F3FF 0%, #EEF2FF 100%);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fc-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-indigo {
            background: var(--primary);
        }

        .dot-green {
            background: var(--success);
        }

        .dot-orange {
            background: var(--warning);
        }

        .fc-label {
            font-size: 12px;
            font-weight: 700;
            color: #5B21B6;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .fc-body {
            padding: 24px;
        }

        /* ── FORM ELEMENTS ── */
        .row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .row-full {
            margin-bottom: 18px;
        }

        .form-label-sw {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 7px;
        }

        .form-label-sw .req {
            color: var(--danger);
            margin-left: 2px;
        }

        .form-control-sw {
            width: 100%;
            padding: 10px 14px;
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
        }

        .form-control-sw:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, .12);
        }

        .form-control-sw:hover:not(:focus) {
            border-color: #CBD5E1;
        }

        .form-control-sw::placeholder {
            color: #9CA3AF;
        }

        select.form-control-sw {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 36px;
            cursor: pointer;
        }

        .form-hint {
            font-size: 11.5px;
            color: var(--text-soft);
            margin-top: 5px;
        }

        /* ── JENIS RADIO ── */
        .jenis-wrap {
            display: flex;
            gap: 10px;
        }

        .jenis-opt {
            flex: 1;
            position: relative;
        }

        .jenis-opt input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .jenis-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 0;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-soft);
            cursor: pointer;
            transition: all .15s;
            background: var(--surface);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .jenis-opt input:checked+.jenis-btn.uts {
            background: var(--info-light);
            border-color: #BAE6FD;
            color: var(--info);
        }

        .jenis-opt input:checked+.jenis-btn.uas {
            background: var(--warning-light);
            border-color: #FDE68A;
            color: var(--warning);
        }

        /* ── FOOTER ── */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-top: 1px solid var(--border);
            background: #FAFAFA;
            flex-wrap: wrap;
            gap: 12px;
        }

        .sw-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1;
        }

        .sw-btn-cancel {
            background: var(--surface);
            color: var(--text-mid);
            border: 1px solid var(--border);
        }

        .sw-btn-cancel:hover {
            background: #F1F5F9;
            color: var(--text-dark);
            text-decoration: none;
        }

        .sw-btn-save {
            background: var(--warning);
            color: #fff;
            box-shadow: 0 4px 14px rgba(217, 119, 6, .3);
        }

        .sw-btn-save:hover {
            background: #B45309;
            color: #fff;
            box-shadow: 0 6px 20px rgba(217, 119, 6, .4);
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .sw-page {
                padding: 16px;
            }

            .row-grid {
                grid-template-columns: 1fr;
            }

            .jenis-wrap {
                flex-direction: column;
            }
        }
    </style>

    <div class="sw-page">

        {{-- BACK LINK --}}
        <a href="{{ route('guru.ujian.index') }}" class="back-nav">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Ujian
        </a>

        {{-- PAGE HEADER --}}
        <div class="sw-ph">
            <div class="sw-ph-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </div>
            <div>
                <h2 class="sw-ph-title">Edit Ujian</h2>
                <p class="sw-ph-sub">Perbarui informasi dan pengaturan ujian</p>
            </div>
        </div>

        <form action="{{ route('guru.ujian.update', $ujian->id) }}" method="POST" id="formEditUjian">
            @if ($errors->any())
                <div style="
                            background:#FEF2F2;
                            border:1px solid #FECACA;
                            color:#B91C1C;
                            padding:14px;
                            border-radius:10px;
                            margin-bottom:18px;
                        ">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            @method('PUT')

            {{-- CARD 1: INFORMASI UJIAN --}}
            <div class="form-card">
                <div class="fc-hd">
                    <div class="fc-dot dot-indigo"></div>
                    <span class="fc-label">Informasi Ujian</span>
                </div>
                <div class="fc-body">

                    <div class="row-full">
                        <label class="form-label-sw">
                            Judul Ujian <span class="req">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control-sw" value="{{ old('judul', $ujian->judul) }}"
                            placeholder="Masukkan judul ujian" required>
                    </div>

                    <div class="row-grid">
                        <div>
                            <label class="form-label-sw">
                                Mata Pelajaran <span class="req">*</span>
                            </label>
                            <select name="mapel_id" class="form-control-sw" required>
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id }}" {{ $ujian->mapel_id == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label-sw">
                                Kelas <span class="req">*</span>
                            </label>
                            <div
                                style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;padding:12px 14px;display:flex;flex-wrap:wrap;gap:10px;">
                                @foreach($kelas as $k)
                                    <label
                                        style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;font-weight:600;color:#374151;background:#fff;border:1.5px solid #E5E7EB;border-radius:8px;padding:6px 12px;transition:all .15s;"
                                        onmouseover="this.style.borderColor='#6366f1'" onmouseout="this.style.borderColor=''">
                                        <input type="checkbox" name="kelas_ids[]" value="{{ $k->id }}" {{ in_array($k->id, $selectedKelas) ? 'checked' : '' }}
                                            style="accent-color:#4F46E5;width:15px;height:15px;">
                                        {{ $k->nama_kelas }}
                                    </label>
                                @endforeach
                            </div>
                            <p class="form-hint">✓ Centang semua kelas yang akan menerima ujian ini</p>
                        </div>
                    </div>

                    <div class="row-full">
                        <label class="form-label-sw">
                            Durasi <span class="req">*</span>
                        </label>
                        <input type="number" name="durasi" class="form-control-sw"
                            value="{{ old('durasi', $ujian->durasi) }}" placeholder="Contoh: 90" required>
                        <p class="form-hint">Dalam satuan menit</p>
                    </div>

                </div>
            </div>

            {{-- CARD 2: JADWAL --}}
            <div class="form-card">
                <div class="fc-hd">
                    <div class="fc-dot dot-green"></div>
                    <span class="fc-label">Jadwal Pelaksanaan</span>
                </div>
                <div class="fc-body">

                    <div class="row-grid">
                        <div>
                            <label class="form-label-sw">
                                Waktu Mulai <span class="req">*</span>
                            </label>
                            <input type="datetime-local" name="mulai" class="form-control-sw"
                                value="{{ date('Y-m-d\TH:i', strtotime($ujian->mulai)) }}" required>
                        </div>
                        <div>
                            <label class="form-label-sw">
                                Waktu Selesai <span class="req">*</span>
                            </label>
                            <input type="datetime-local" name="selesai" class="form-control-sw"
                                value="{{ date('Y-m-d\TH:i', strtotime($ujian->selesai)) }}" required>
                        </div>
                    </div>

                </div>
            </div>

            {{-- CARD 3: JENIS UJIAN --}}
            <div class="form-card">
                <div class="fc-hd">
                    <div class="fc-dot dot-orange"></div>
                    <span class="fc-label">Jenis Ujian</span>
                </div>
                <div class="fc-body">

                    <label class="form-label-sw">Pilih Jenis <span class="req">*</span></label>
                    <div class="jenis-wrap">
                        <label class="jenis-opt">
                            <input type="radio" name="jenis" value="UTS" {{ $ujian->jenis == 'UTS' ? 'checked' : '' }}>
                            <div class="jenis-btn uts">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.2">
                                    <path d="M9 11l3 3L22 4" />
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                </svg>
                                UTS — Ujian Tengah Semester
                            </div>
                        </label>
                        <label class="jenis-opt">
                            <input type="radio" name="jenis" value="UAS" {{ $ujian->jenis == 'UAS' ? 'checked' : '' }}>
                            <div class="jenis-btn uas">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                UAS — Ujian Akhir Semester
                            </div>
                        </label>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('guru.ujian.index') }}" class="sw-btn sw-btn-cancel">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batalkan
                    </a>
                    <button type="submit" class="sw-btn sw-btn-save" id="btnUpdate">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Ujian
                    </button>
                </div>

            </div>

        </form>

    </div>

    <script>
        document.getElementById('formEditUjian').addEventListener('submit', function () {

            const btn = document.getElementById('btnUpdate');

            btn.disabled = true;

            btn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="14"
                 height="14"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2"
                 style="animation:spin .8s linear infinite">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Menyimpan...
        `;
        });

        const s = document.createElement('style');
        s.textContent = '@keyframes spin{to{transform:rotate(360deg)}}';
        document.head.appendChild(s);
    </script>

@endsection