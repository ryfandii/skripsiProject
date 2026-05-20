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

        .sw-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .sw-topbar h3 {
            font-size: 21px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0 0 3px;
            letter-spacing: -.3px;
        }

        .sw-topbar p {
            font-size: 13px;
            color: var(--text-soft);
            margin: 0;
        }

        .sw-badge-ready {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--primary-light);
            border: 1px solid #C7D2FE;
            border-radius: 99px;
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
        }

        .sw-alert-warning {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #92400E;
        }

        .sw-hero-card {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 12px 40px rgba(79, 70, 229, .22);
        }

        .sw-hero-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #4F46E5 0%, #0284C7 100%);
        }

        .sw-hero-blob1 {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            top: -80px;
            right: -60px;
        }

        .sw-hero-blob2 {
            position: absolute;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            bottom: -50px;
            left: 40px;
        }

        .sw-hero-inner {
            position: relative;
            z-index: 2;
            padding: 36px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .sw-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .18);
            border-radius: 99px;
            padding: 4px 12px;
            font-size: 11.5px;
            font-weight: 700;
            color: rgba(255, 255, 255, .9);
            letter-spacing: .4px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .sw-hero-title {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            letter-spacing: -.4px;
            line-height: 1.3;
        }

        .sw-hero-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .sw-hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        .sw-btn-start {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            transition: all .18s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .12);
        }

        .sw-btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .18);
            color: var(--primary-dark);
            text-decoration: none;
        }

        .sw-btn-done {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .2);
            color: rgba(255, 255, 255, .75);
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 12px;
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 700;
            cursor: not-allowed;
        }

        .sw-hero-deco {
            width: 100px;
            height: 100px;
            border-radius: 24px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
        }

        .sw-stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .sw-stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
        }

        .sw-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .si-indigo {
            background: var(--primary-light);
            color: var(--primary);
        }

        .si-blue {
            background: var(--info-light);
            color: var(--info);
        }

        .si-green {
            background: var(--success-light);
            color: var(--success);
        }

        .sw-stat-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 3px;
        }

        .sw-stat-value {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
        }

        .sw-empty {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 64px 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
            margin-bottom: 24px;
        }

        .sw-empty-ring {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--primary-light);
            border: 2px solid #C7D2FE;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary);
        }

        .sw-empty h5 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .sw-empty p {
            font-size: 13.5px;
            color: var(--text-soft);
            margin: 0;
        }

        @media (max-width: 768px) {
            .sw-page {
                padding: 16px;
            }

            .sw-hero-inner {
                padding: 24px;
            }

            .sw-hero-deco {
                display: none;
            }

            .sw-hero-title {
                font-size: 19px;
            }

            .sw-stats-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="sw-page">

        {{-- TOPBAR --}}
        <div class="sw-topbar">
            <div>
                <h3>Ujian Tersedia</h3>
                <p>Daftar ujian yang dapat Anda kerjakan sekarang</p>
            </div>
            <div class="sw-badge-ready">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Siap mengerjakan ujian hari ini?
            </div>
        </div>

        {{-- ALERT WARNING --}}
        @if(session('warning'))
            <div class="sw-alert-warning">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                {{ session('warning') }}
            </div>
        @endif

        {{-- DAFTAR UJIAN --}}
        @forelse($ujians as $u)
            @php $dikerjakan = in_array($u->id, $sudahDikerjakan); @endphp

            <div class="sw-hero-card" style="{{ $dikerjakan ? 'opacity:0.85;box-shadow:0 8px 24px rgba(0,0,0,.1)' : '' }}">
                <div class="sw-hero-bg"
                    style="{{ $dikerjakan ? 'background:linear-gradient(135deg,#374151 0%,#6B7280 100%)' : '' }}"></div>
                <div class="sw-hero-blob1"></div>
                <div class="sw-hero-blob2"></div>
                <div class="sw-hero-inner">
                    <div>
                        {{-- EYEBROW --}}
                        <div class="sw-hero-eyebrow">
                            @if($dikerjakan)
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sudah Dikerjakan
                            @else
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                Ujian Aktif
                            @endif
                        </div>

                        {{-- JUDUL --}}
                        <div class="sw-hero-title">{{ $u->judul }}</div>

                        {{-- CHIPS --}}
                        <div class="sw-hero-chips">
                            <span class="sw-hero-chip">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                {{ $u->durasi }} menit
                            </span>
                            {{-- Ganti chip jenis yang ada di sw-hero-chips --}}
                            @if($u->jenis)
                                <span class="sw-hero-chip"
                                    style="{{ $u->jenis == 'UTS' ? 'background:rgba(2,132,199,.25);border-color:rgba(2,132,199,.4);' : 'background:rgba(217,119,6,.25);border-color:rgba(217,119,6,.4);' }} font-weight:800;">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                    {{ $u->jenis }} — {{ $u->jenis == 'UTS' ? 'Ujian Tengah Semester' : 'Ujian Akhir Semester' }}
                                </span>
                            @endif
                            @if($u->mulai)
                                <span class="sw-hero-chip">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ $u->mulai }}
                                </span>
                            @endif
                            {{-- CHIP NILAI (muncul kalau sudah dikerjakan) --}}
                            @if($dikerjakan && isset($hasilSiswa[$u->id]))
                                <span class="sw-hero-chip" style="background:rgba(255,255,255,.3);font-weight:800;font-size:13px;">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10" />
                                    </svg>
                                    Nilai: {{ $hasilSiswa[$u->id]->nilai }}
                                </span>
                            @endif
                        </div>

                        {{-- TOMBOL --}}
                        @php $berakhir = in_array($u->id, $sudahBerakhir); @endphp
                        @if($dikerjakan || $berakhir)
                            <span class="sw-btn-done"
                                style="{{ $berakhir && !$dikerjakan ? 'background:rgba(220,38,38,.2);border-color:rgba(220,38,38,.3);' : '' }}">
                                @if($berakhir && !$dikerjakan)
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    Waktu Ujian Sudah Berakhir
                                @else
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Sudah Selesai Dikerjakan
                                @endif
                            </span>
                        @else
                            <a href="{{ route('siswa.ujian.kerjakan', $u->id) }}" class="sw-btn-start">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <polygon points="5 3 19 12 5 21 5 3" />
                                </svg>
                                Mulai Ujian Sekarang
                            </a>
                        @endif
                    </div>

                    {{-- DECO ICON --}}
                    <div class="sw-hero-deco">
                        @if($dikerjakan)
                            <svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

        @empty
            <div class="sw-empty">
                <div class="sw-empty-ring">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                </div>
                <h5>Tidak Ada Ujian</h5>
                <p>Saat ini belum ada ujian yang tersedia. Silakan cek kembali nanti.</p>
            </div>
        @endforelse

        {{-- MINI INFO --}}
        <div class="sw-stats-row">
            <div class="sw-stat-card">
                <div class="sw-stat-icon si-indigo">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                </div>
                <div>
                    <div class="sw-stat-label">Total Ujian</div>
                    <div class="sw-stat-value">{{ $ujians->count() }}</div>
                </div>
            </div>
            <div class="sw-stat-card">
                <div class="sw-stat-icon si-blue">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
                <div>
                    <div class="sw-stat-label">Sudah Dikerjakan</div>
                    <div class="sw-stat-value" style="color:var(--info);">{{ count($sudahDikerjakan) }}</div>
                </div>
            </div>
            <div class="sw-stat-card">
                <div class="sw-stat-icon si-green">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M5 12.55a11 11 0 0 1 14.08 0" />
                        <path d="M1.42 9a16 16 0 0 1 21.16 0" />
                        <path d="M8.53 16.11a6 6 0 0 1 6.95 0" />
                        <line x1="12" y1="20" x2="12.01" y2="20" />
                    </svg>
                </div>
                <div>
                    <div class="sw-stat-label">Mode</div>
                    <div class="sw-stat-value" style="font-size:16px;color:var(--success);">Online</div>
                </div>
            </div>
        </div>

    </div>
@endsection