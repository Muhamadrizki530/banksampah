@extends('layouts.nasabah')

@section('title', 'Statistik')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/nasabah/statistik/index.css') }}">
@endpush

@section('content')

{{-- ========================= HEADER ========================= --}}
<div class="stat-header">
    <div class="stat-header-icon">
        <i class="bi bi-bar-chart-line"></i>
    </div>
    <div>
        <h1 class="stat-header-title">Statistik</h1>
        <p class="stat-header-subtitle">
            Lihat perkembangan aktivitas penyetoran sampah dan poin Anda.
        </p>
    </div>
</div>

{{-- ========================= 4 STATISTIK CARD ========================= --}}
<div class="row g-3 stat-cards-row">

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon icon-blue">
                <i class="bi bi-arrow-left-right"></i>
            </div>
            <div class="stat-card-body">
                <span class="stat-card-label">Total Transaksi</span>
                <h3 class="stat-card-value">
                    {{ number_format($totalTransaksi ?? 0) }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon icon-green">
                <i class="bi bi-trash3"></i>
            </div>
            <div class="stat-card-body">
                <span class="stat-card-label">Total Berat Sampah</span>
                <h3 class="stat-card-value">
                    {{ number_format($totalBerat ?? 0, 1) }} <small>Kg</small>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon icon-yellow">
                <i class="bi bi-stars"></i>
            </div>
            <div class="stat-card-body">
                <span class="stat-card-label">Total Poin Didapat</span>
                <h3 class="stat-card-value">
                    {{ number_format($totalPoin ?? 0) }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon icon-purple">
                <i class="bi bi-trophy"></i>
            </div>
            <div class="stat-card-body">
                <span class="stat-card-label">Ranking Saat Ini</span>
                <h3 class="stat-card-value">
                    {{ $rankSekarang ?? '-' }}
                </h3>
            </div>
        </div>
    </div>

</div>

{{-- ========================= GRAFIK AKTIVITAS + JENIS SAMPAH ========================= --}}
<div class="row g-3 stat-charts-row">

    <div class="col-lg-8">
        <div class="chart-card">
            <h5 class="chart-card-title">Aktivitas Setoran Bulanan</h5>
            <div class="chart-wrapper">
                <canvas id="monthlyActivityChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="chart-card">
            <h5 class="chart-card-title">Grafik Jenis Sampah</h5>
            <div class="chart-wrapper chart-wrapper-pie">
                <canvas id="wasteTypeChart"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- ========================= PROGRESS RANK ========================= --}}
<div class="row g-3 stat-progress-row">
    <div class="col-12">
        <div class="progress-card">
            <h5 class="chart-card-title">Progress Rank</h5>

            <div class="progress-card-body">
                <div class="progress-rank-badge">
                    {{ $rankSekarang ?? 'Bronze' }}
                </div>

                <div class="progress-rank-bar-wrapper">
                    <div class="progress rank-progress">
                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="width: {{ $rankProgressPercentage ?? 0 }}%;"
                            aria-valuenow="{{ $rankProgressPercentage ?? 0 }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                    <span class="progress-rank-percentage">
                        {{ $rankProgressPercentage ?? 0 }}%
                    </span>
                </div>
            </div>

            @if(isset($rankBerikutnya) && isset($poinMenujuRank))
            <p class="progress-rank-note">
                <i class="bi bi-info-circle me-1"></i>
                {{ number_format($poinMenujuRank) }} poin lagi menuju
                <strong>{{ $rankBerikutnya }}</strong>.
            </p>
            @else
            <p class="progress-rank-note">
                <i class="bi bi-trophy-fill me-1"></i>
                Anda telah mencapai rank tertinggi.
            </p>
            @endif

        </div>
    </div>
</div>

{{-- ========================= RIWAYAT RINGKAS ========================= --}}
<div class="row g-3 stat-history-row">
    <div class="col-12">
        <div class="history-card">
            <div class="history-card-header">
                <h5 class="chart-card-title mb-0">Riwayat Ringkas</h5>
                @if(isset($riwayatRoute))
                <a href="{{ $riwayatRoute }}" class="history-see-all">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
                @endif
            </div>

            @if(isset($riwayatRingkas) && count($riwayatRingkas) > 0)
            <div class="table-responsive">
                <table class="table history-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Sampah</th>
                            <th>Berat</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatRingkas->take(5) as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                            <td>
                                <span class="badge badge-waste">
                                    {{ $item->jenis_sampah }}
                                </span>
                            </td>
                            <td>{{ number_format($item->berat, 1) }} Kg</td>
                            <td class="fw-semibold text-primary-custom">
                                +{{ number_format($item->poin) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            {{-- ========================= EMPTY STATE ========================= --}}
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <h6 class="empty-state-title">Belum Ada Transaksi</h6>
                <p class="empty-state-text">
                    Riwayat penyetoran sampah Anda akan muncul di sini setelah Anda melakukan transaksi pertama.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ===================== DATA ===================== */

        const monthlyLabels = @json($monthlyLabels ?? []);
        const monthlyData = @json($monthlyData ?? []);

        const wasteLabels = @json($wasteTypeLabels ?? []);
        const wasteData = @json($wasteTypeData ?? []);

        /* ===================== DEFAULT DATA ===================== */

        const labels = monthlyLabels.length ?
            monthlyLabels :
            ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        const data = monthlyData.length ?
            monthlyData :
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        const pieLabels = wasteLabels.length ?
            wasteLabels :
            ['Plastik', 'Kertas', 'Logam', 'Kaca', 'Organik', 'Elektronik', 'Tekstil'];

        const pieData = wasteData.length ?
            wasteData :
            [0, 0, 0, 0, 0, 0, 0];

        /* ===================== LINE CHART ===================== */

        const monthlyCtx = document.getElementById('monthlyActivityChart');

        if (monthlyCtx) {

            new Chart(monthlyCtx, {

                type: 'line',

                data: {

                    labels: labels,

                    datasets: [{

                        label: 'Jumlah Setoran',

                        data: data,

                        borderColor: '#2563eb',

                        backgroundColor: 'rgba(37,99,235,.08)',

                        borderWidth: 2.5,

                        tension: .35,

                        fill: true,

                        pointRadius: 4,

                        pointBackgroundColor: '#2563eb',

                        pointBorderColor: '#ffffff',

                        pointBorderWidth: 2

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            display: false
                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            grid: {
                                color: '#eef1f6'
                            },

                            ticks: {
                                color: '#64748b'
                            }

                        },

                        x: {

                            grid: {
                                display: false
                            },

                            ticks: {
                                color: '#64748b'
                            }

                        }

                    }

                }

            });

        }

        /* ===================== PIE CHART ===================== */

        const wasteCtx = document.getElementById('wasteTypeChart');

        if (wasteCtx) {

            new Chart(wasteCtx, {

                type: 'pie',

                data: {

                    labels: pieLabels,

                    datasets: [{

                        data: pieData,

                        backgroundColor: [

                            '#2563eb',
                            '#22c55e',
                            '#eab308',
                            '#a855f7',
                            '#0ea5e9',
                            '#f97316',
                            '#ec4899'

                        ],

                        borderColor: '#ffffff',

                        borderWidth: 2

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                boxWidth: 10,

                                padding: 14,

                                color: '#475569',

                                font: {

                                    family: 'Poppins',

                                    size: 11

                                }

                            }

                        }

                    }

                }

            });

        }

    });
</script>

@endpush