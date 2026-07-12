@extends('layouts.nasabah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/nasabah/index.css') }}">
@endpush

@section('content')

<div class="bsl-dashboard">
    <div class="container-xl py-4">

        {{-- ============ 1. HEADER ============ --}}
        <header class="bsl-header d-flex align-items-center justify-content-between mb-4">
            <div>
                
                <p class="bsl-date mb-0">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
        </header>


        {{-- ============ 2. HERO CARD ============ --}}
        <section class="bsl-hero mb-4">
            <div class="bsl-hero-glow"></div>
            <div class="row align-items-center g-4 position-relative">
                <div class="col-lg-7">
                    <span class="bsl-hero-label">Total Poin Anda</span>
                    <div class="bsl-hero-points">
                        {{ number_format(Auth::user()->current_point) }}
                        <span class="unit">pts</span>
                    </div>

                    <div class="d-flex align-items-center gap-2 mt-2 mb-3">
                        <span class="bsl-rank-badge">
                            <i class="bi bi-award-fill me-1"></i>{{ Auth::user()->rank }}
                        </span>
                        <span class="bsl-hero-weight">
                            <i class="bi bi-basket3-fill me-1"></i>
                            {{ number_format($totalWeight, 1) }} kg disetor
                        </span>
                    </div>

                    @if($nextRank)
                    <div class="bsl-progress-wrap">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Menuju rank <strong>{{ $nextRank }}</strong></small>
                            <small>{{ $pointsToNextRank }} poin lagi</small>
                        </div>
                        <div class="progress bsl-progress">
                            <div class="progress-bar" role="progressbar"
                                data-progress="{{ $rankProgress }}"
                                style="width:0%"
                                aria-valuenow="{{ $rankProgress }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bsl-progress-wrap">
                        <small><i class="bi bi-trophy-fill me-1"></i>Anda sudah mencapai rank tertinggi 🎉</small>
                    </div>
                    @endif
                </div>

                <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                    <div class="bsl-hero-illustration">
                        <i class="bi bi-recycle"></i>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============ 3. QUICK MENU ============ --}}
        <section class="mb-4">
            <div class="row g-3 row-cols-2 row-cols-md-3">

                <div class="col">
                    <a href="{{ route('nasabah.tukar-poin') }}" class="bsl-menu-card">
                        <div class="bsl-menu-icon bg-menu-2">
                            <i class="bi bi-gift-fill"></i>
                        </div>
                        <span>Tukar Poin</span>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('nasabah.riwayat-penukaran') }}" class="bsl-menu-card">
                        <div class="bsl-menu-icon bg-menu-3">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <span>Riwayat Penukaran</span>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('nasabah.statistik') }}" class="bsl-menu-card">
                        <div class="bsl-menu-icon bg-menu-5">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <span>Statistik</span>
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('profile.edit') }}" class="bsl-menu-card">
                        <div class="bsl-menu-icon bg-menu-6">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <span>Profil</span>
                    </a>
                </div>

                <div class="col">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bsl-menu-card border-0 bg-transparent w-100">
                            <div class="bsl-menu-icon bg-danger text-white">
                                <i class="bi bi-box-arrow-right"></i>
                            </div>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </section>
        {{-- ============ 4. BANNER INFORMASI ============ --}}
        @if(isset($announcements) && count($announcements))
        <section class="mb-4 d-flex flex-column gap-2">
            @foreach($announcements as $announcement)
            <div class="bsl-banner bsl-banner-{{ $announcement['variant'] ?? 'success' }}">
                <div class="bsl-banner-icon">
                    <i class="bi {{ $announcement['icon'] ?? 'bi-megaphone-fill' }}"></i>
                </div>
                <div class="bsl-banner-text">
                    {{ $announcement['text'] }}
                </div>
                <button type="button" class="btn-close bsl-banner-close" aria-label="Tutup"></button>
            </div>
            @endforeach
        </section>
        @endif

        <div class="row g-4">
            {{-- ============ 5. AKTIVITAS TERBARU ============ --}}
            <div class="col-lg-7">
                <div class="bsl-card h-100">
                    <div class="bsl-card-head">
                        <h2 class="bsl-card-title">Aktivitas Terbaru</h2>
                        <a href="#" class="bsl-see-all">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="bsl-timeline">
                        @forelse($activities ?? [] as $activity)
                        <div class="bsl-timeline-item">
                            <div class="bsl-timeline-icon {{ $activity['type'] === 'tukar' ? 'is-out' : 'is-in' }}">
                                <i class="bi {{ $activity['type'] === 'tukar' ? 'bi-gift-fill' : 'bi-recycle' }}"></i>
                            </div>
                            <div class="bsl-timeline-body">
                                <div class="bsl-timeline-title">{{ $activity['title'] }}</div>
                                <div class="bsl-timeline-sub">
                                    {{ $activity['subtitle'] }} &middot;
                                    {{ \Carbon\Carbon::parse($activity['date'])->translatedFormat('d M Y') }}
                                </div>
                            </div>
                            <div class="bsl-timeline-point {{ $activity['type'] === 'tukar' ? 'text-danger' : 'text-success' }}">
                                {{ $activity['type'] === 'tukar' ? '-' : '+' }}{{ abs($activity['point']) }}
                            </div>
                        </div>
                        @empty
                        <div class="bsl-empty">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada aktivitas.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ============ 6. STATISTIK SINGKAT ============ --}}
            <div class="col-lg-5">
                <div class="row g-4 h-100">
                    <div class="col-sm-6 col-lg-12">
                        <div class="bsl-stat-card">
                            <div class="bsl-stat-icon"><i class="bi bi-arrow-down-circle-fill"></i></div>
                            <div>
                                <small>Total Transaksi</small>
                                <h3>{{ $totalTransactions }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="bsl-stat-card">
                            <div class="bsl-stat-icon variant-b"><i class="bi bi-arrow-up-circle-fill"></i></div>
                            <div>
                                <small>Total Penukaran</small>
                                <h3>{{ $totalRedeems }}</h3>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>

    {{-- ============ 8. FOOTER ============ --}}
    <footer class="bsl-footer">
        <div class="container-xl d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} Bank Sampah. Dikelola oleh warga, untuk warga.</span>
            <span class="d-flex align-items-center gap-1">
                <i class="bi bi-shield-check"></i> Data poin Anda aman &amp; tercatat otomatis
            </span>
        </div>
    </footer>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/nasabah-dashboard.js') }}"></script>
@endpush