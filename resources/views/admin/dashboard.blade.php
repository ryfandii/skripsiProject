@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --brand-primary: #1a56db;
        --brand-primary-light: #e8f0fe;
        --brand-success: #0d9488;
        --brand-success-light: #ccfbf1;
        --brand-warning: #d97706;
        --brand-warning-light: #fef3c7;
        --brand-danger: #dc2626;
        --brand-danger-light: #fee2e2;
        --surface-base: #ffffff;
        --surface-page: #f4f6fa;
        --surface-raised: #ffffff;
        --border-soft: rgba(0,0,0,0.07);
        --border-medium: rgba(0,0,0,0.12);
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-xs: 0 1px 2px rgba(0,0,0,0.04);
        --shadow-sm: 0 1px 4px rgba(0,0,0,0.06), 0 2px 8px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.08), 0 1px 4px rgba(0,0,0,0.04);
    }
*,
*::before,
*::after {
    box-sizing: border-box;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}
    body, .dashboard-wrap * {
        
    }

    .dashboard-wrap {
        background: var(--surface-page);
        min-height: 100vh;
        padding: 28px 32px 48px;
    }

    /* ─── HEADER ─── */
    .db-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .db-header-left .db-eyebrow {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--brand-primary);
        margin-bottom: 4px;
    }

    .db-header-left h1 {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        letter-spacing: -0.5px;
    }

    .db-user-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--surface-base);
        border: 1px solid var(--border-soft);
        border-radius: 40px;
        padding: 6px 14px 6px 8px;
        box-shadow: var(--shadow-xs);
    }

    .db-user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a56db 0%, #6366f1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: white;
        letter-spacing: 0;
    }

    .db-user-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-primary);
    }

    /* ─── STAT CARDS ─── */
    .db-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--surface-base);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-soft);
        padding: 20px 22px;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        gap: 14px;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .stat-card.primary::before { background: var(--brand-primary); }
    .stat-card.success::before { background: var(--brand-success); }
    .stat-card.warning::before { background: var(--brand-warning); }
    .stat-card.danger::before { background: var(--brand-danger); }

    .stat-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .stat-card-label {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--text-secondary);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .stat-icon.primary { background: var(--brand-primary-light); color: var(--brand-primary); }
    .stat-icon.success { background: var(--brand-success-light); color: var(--brand-success); }
    .stat-icon.warning { background: var(--brand-warning-light); color: var(--brand-warning); }
    .stat-icon.danger  { background: var(--brand-danger-light); color: var(--brand-danger); }

    .stat-value {
        font-size: 36px;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -1.5px;
        line-height: 1;
        font-variant-numeric: tabular-nums;
        font-family: 'DM Mono', monospace;
    }

    /* ─── SECTION LABEL ─── */
    .section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin: 0 0 14px;
    }

    /* ─── CARD BASE ─── */
    .db-card {
        background: var(--surface-base);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-soft);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .db-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-soft);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .db-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.2px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .db-card-title .title-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .db-card-title .title-dot.primary { background: var(--brand-primary); }
    .db-card-title .title-dot.teal    { background: var(--brand-success); }

    .db-card-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 20px;
        background: var(--surface-page);
        color: var(--text-secondary);
        border: 1px solid var(--border-soft);
    }

    .db-card-body {
        padding: 20px;
    }

    /* ─── CHARTS GRID ─── */
    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    /* ─── DATA LISTS ─── */
    .data-lists-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .data-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 20px;
        border-bottom: 1px solid var(--border-soft);
        transition: background 0.15s ease;
    }

    .data-row:last-child { border-bottom: none; }

    .data-row:hover { background: var(--surface-page); }

    .data-row-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-row-index {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        font-family: 'DM Mono', monospace;
        min-width: 18px;
    }

    .data-row-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .data-row-sub {
        font-size: 12px;
        color: var(--text-muted);
        background: var(--surface-page);
        border: 1px solid var(--border-soft);
        border-radius: 6px;
        padding: 2px 8px;
    }

    .score-badge {
        font-size: 13px;
        font-weight: 700;
        font-family: 'DM Mono', monospace;
        color: #fff;
        background: var(--brand-success);
        border-radius: var(--radius-sm);
        padding: 3px 10px;
        letter-spacing: 0.5px;
    }

    .score-badge.high   { background: #0d9488; }
    .score-badge.mid    { background: #d97706; }
    .score-badge.low    { background: #dc2626; }

    /* ─── QUICK ACTIONS ─── */
    .quick-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--surface-base);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-soft);
        box-shadow: var(--shadow-sm);
        padding: 18px 24px;
    }

    .qa-left h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 2px;
    }

    .qa-left small {
        font-size: 12px;
        color: var(--text-muted);
    }

    .qa-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-qa {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        border-radius: var(--radius-sm);
        font-size: 13px;
        font-weight: 600;
        border: 1.5px solid;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.15s ease;
        letter-spacing: 0.01em;
        
    }

    .btn-qa:hover { transform: translateY(-1px); filter: brightness(0.95); }

    .btn-qa.primary {
        background: var(--brand-primary);
        border-color: var(--brand-primary);
        color: #fff;
    }

    .btn-qa.success {
        background: var(--brand-success);
        border-color: var(--brand-success);
        color: #fff;
    }

    .btn-qa.outline {
        background: transparent;
        border-color: var(--border-medium);
        color: var(--text-primary);
    }

    /* ─── EMPTY STATE ─── */
    .empty-state {
        padding: 28px 20px;
        text-align: center;
        color: var(--text-muted);
        font-size: 13px;
    }
</style>

<div class="dashboard-wrap">

    {{-- HEADER --}}
    <div class="db-header">
        <div class="db-header-left">
            <div class="db-eyebrow">Panel Admin</div>
            <h1>Dashboard</h1>
        </div>

        <div class="db-user-badge">
            <div class="db-user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <span class="db-user-name">{{ auth()->user()->name }}</span>
        </div>
    </div>

    {{-- STATISTIK --}}
    @php
        $cards = [
            ['title' => 'Total Siswa',  'value' => $jumlahSiswa,  'color' => 'primary', 'icon' => 'fa-solid fa-user-graduate'],
            ['title' => 'Total Guru',   'value' => $jumlahGuru,   'color' => 'success', 'icon' => 'fa-solid fa-chalkboard-teacher'],
            ['title' => 'Total Kelas',  'value' => $jumlahKelas,  'color' => 'warning', 'icon' => 'fa-solid fa-school'],
            ['title' => 'Mata Pelajaran', 'value' => $jumlahMapel, 'color' => 'danger',  'icon' => 'fa-solid fa-book'],
        ];
    @endphp

    <div class="db-stats-grid">
        @foreach($cards as $c)
        <div class="stat-card {{ $c['color'] }}">
            <div class="stat-card-top">
                <span class="stat-card-label">{{ $c['title'] }}</span>
                <div class="stat-icon {{ $c['color'] }}">
                    <i class="{{ $c['icon'] }}"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($c['value']) }}</div>
        </div>
        @endforeach
    </div>

    {{-- CHARTS --}}
    <p class="section-label">Visualisasi Data</p>
    <div class="charts-grid">

        {{-- CHART SISWA PER KELAS --}}
        <div class="db-card">
            <div class="db-card-header">
                <div class="db-card-title">
                    <span class="title-dot primary"></span>
                    Siswa per Kelas
                </div>
                <span class="db-card-badge">Bar chart</span>
            </div>
            <div class="db-card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="chartKelas" role="img" aria-label="Bar chart jumlah siswa per kelas"></canvas>
                </div>
            </div>
        </div>

        {{-- CHART DISTRIBUSI NILAI --}}
        <div class="db-card">
            <div class="db-card-header">
                <div class="db-card-title">
                    <span class="title-dot teal"></span>
                    Distribusi Nilai
                </div>
                <span class="db-card-badge">Pie chart</span>
            </div>
            <div class="db-card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="chartNilai" role="img" aria-label="Pie chart distribusi nilai siswa"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- DATA LISTS --}}
    <p class="section-label">Data Terkini</p>
    <div class="data-lists-grid">

        {{-- SISWA TERBARU --}}
        <div class="db-card">
            <div class="db-card-header">
                <div class="db-card-title">
                    <span class="title-dot primary"></span>
                    Siswa Terbaru
                </div>
            </div>
            @forelse($siswaTerbaru as $i => $siswa)
                <div class="data-row">
                    <div class="data-row-left">
                        <span class="data-row-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="data-row-name">{{ $siswa->nama }}</span>
                    </div>
                    <span class="data-row-sub">{{ $siswa->kelas->nama ?? '—' }}</span>
                </div>
            @empty
                <div class="empty-state">Belum ada data siswa</div>
            @endforelse
        </div>

        {{-- NILAI TERTINGGI --}}
        <div class="db-card">
            <div class="db-card-header">
                <div class="db-card-title">
                    <span class="title-dot teal"></span>
                    Nilai Tertinggi
                </div>
            </div>
            @forelse($nilaiTertinggi as $n)
                <div class="data-row">
                    <div class="data-row-left">
                        <span class="data-row-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="data-row-name">{{ $n->siswa->nama ?? '—' }}</span>
                    </div>
                    @php $score = $n->nilai; @endphp
                    <span class="score-badge {{ $score >= 85 ? 'high' : ($score >= 70 ? 'mid' : 'low') }}">
                        {{ $score }}
                    </span>
                </div>
            @empty
                <div class="empty-state">Belum ada data nilai</div>
            @endforelse
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="quick-actions">
        <div class="qa-left">
            <h5>Aksi Cepat</h5>
            <small>Tambah atau kelola data langsung dari sini</small>
        </div>
        <div class="qa-buttons">
            <a href="{{ route('admin.guru.create') }}" class="btn-qa primary">
                <i class="fa-solid fa-plus" style="font-size:11px;"></i> Tambah Guru
            </a>
            <a href="{{ route('admin.siswa.create') }}" class="btn-qa success">
                <i class="fa-solid fa-plus" style="font-size:11px;"></i> Tambah Siswa
            </a>
            <a href="{{ route('admin.mapel.index') }}" class="btn-qa outline">
                <i class="fa-solid fa-book" style="font-size:11px;"></i> Mata Pelajaran
            </a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const kelasLabels = {!! json_encode($kelasLabels ?? []) !!};
    const kelasData   = {!! json_encode($kelasData ?? []) !!};

    const nilaiLabels = {!! json_encode(array_keys(($nilaiDistribusi ?? collect())->toArray())) !!};
    const nilaiData   = {!! json_encode(array_values(($nilaiDistribusi ?? collect())->toArray())) !!};

    console.log("Kelas:", kelasLabels, kelasData);
    console.log("Nilai:", nilaiLabels, nilaiData);

    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.font.size   = 12;

    // ── CHART KELAS (Bar) ──────────────────────────────────
    if (kelasLabels.length > 0) {
        new Chart(document.getElementById('chartKelas'), {
            type: 'bar',
            data: {
                labels: kelasLabels,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: kelasData,
                    backgroundColor: 'rgba(26, 86, 219, 0.12)',
                    borderColor: 'rgba(26, 86, 219, 0.9)',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: ctx => `  ${ctx.parsed.y} siswa`
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#9ca3af', autoSkip: false, maxRotation: 30 }
                    },
                    y: {
                        grid: { color: 'rgba(0,0,0,0.05)', drawTicks: false },
                        border: { display: false, dash: [4, 4] },
                        ticks: { color: '#9ca3af', padding: 8, precision: 0 },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ── CHART NILAI (Pie) ──────────────────────────────────
    if (nilaiLabels.length > 0) {
        new Chart(document.getElementById('chartNilai'), {
            type: 'pie',
            data: {
                labels: nilaiLabels,
                datasets: [{
                    data: nilaiData,
                    backgroundColor: [
                        'rgba(26, 86, 219, 0.85)',
                        'rgba(13, 148, 136, 0.85)',
                        'rgba(217, 119,  6, 0.85)',
                        'rgba(220,  38, 38, 0.85)',
                        'rgba(99,  102, 241, 0.85)',
                        'rgba(236, 72, 153, 0.85)',
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#6b7280',
                            padding: 14,
                            boxWidth: 10,
                            boxHeight: 10,
                            font: { size: 12, weight: '500' }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: ctx => `  ${ctx.label}: ${ctx.parsed}`
                        }
                    }
                }
            }
        });
    }

});
</script>
@endpush