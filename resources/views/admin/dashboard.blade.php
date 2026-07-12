@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard/dashboard.css') }}">
@endpush
@section('content')

<div class="waste-wrapper">

    <div class="waste-header">
        <div class="header-title">
            <h3>👋 Dashboard</h3>
            <p>Halo, {{ Auth::user()->name }} — Selamat datang kembali.</p>
        </div>
        <div class="header-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="stats-grid">

        <div class="stat-card c-blue">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-title">Total Nasabah</div>
            <div class="stat-value">{{ number_format($totalUsers) }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-recycle"></i></div>
            <div class="stat-title">Jenis Sampah</div>
            <div class="stat-value">{{ number_format($totalWasteTypes) }}</div>
        </div>

        <div class="stat-card c-amber">
            <div class="stat-icon"><i class="bi bi-arrow-left-right"></i></div>
            <div class="stat-title">Total Transaksi</div>
            <div class="stat-value">{{ number_format($totalTransactions) }}</div>
        </div>

        <div class="stat-card c-violet">
            <div class="stat-icon"><i class="bi bi-star-fill"></i></div>
            <div class="stat-title">Total Poin</div>
            <div class="stat-value">{{ number_format($totalPoints) }}</div>
        </div>

    </div>

    <div class="dashboard-grid">

        <div class="waste-card">
            <div class="waste-card-header">
                <div class="title"><i class="bi bi-clock-history"></i> Aktivitas Terbaru</div>
                <div class="subtitle">{{ $recentTransactions->count() }} transaksi</div>
            </div>
            <div style="overflow-x:auto;">
                <table class="table-waste">
                    <thead>
                        <tr>
                            <th>Nasabah</th>
                            <th>Sampah</th>
                            <th>Berat</th>
                            <th>Poin</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                        <tr>
                            <td>
                                <div class="waste-user">
                                    <div class="waste-avatar">
                                        {{ strtoupper(substr($transaction->user->name,0,1)) }}
                                    </div>
                                    <span class="user-name">{{ $transaction->user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $transaction->wasteType->name }}</td>
                            <td>{{ $transaction->weight }} Kg</td>
                            <td class="text-point">+{{ number_format($transaction->total_point) }}</td>
                            <td class="text-date">{{ $transaction->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada transaksi.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="waste-card">
            <div class="waste-card-header">
                <div class="title"><i class="bi bi-trophy-fill"></i> Top Nasabah</div>
            </div>
            <ul class="top-user-list">
                @forelse($topUsers as $index => $user)
                <li class="top-user-item">
                    <div class="waste-user">
                        <div class="waste-avatar rank-avatar">
                            {{ strtoupper(substr($user->name,0,1)) }}
                            @if($index < 3)
                                <span class="rank-badge rank-{{ $index + 1 }}">{{ $index + 1 }}</span>
                                @endif
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-email">{{ $user->email }}</div>
                        </div>
                    </div>
                    <span class="badge-point">
                        <i class="bi bi-star-fill" style="font-size:10px;"></i>
                        {{ number_format($user->current_point) }}
                    </span>
                </li>
                @empty
                <li>
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada data.</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>

    </div>

    <div class="waste-card">
        <div class="waste-card-header">
            <div class="title"><i class="bi bi-lightning-charge-fill"></i> Menu Cepat</div>
        </div>
        <div style="padding:22px;">
            <div class="quick-menu-grid">
                <a href="{{ route('admin.nasabah.index') }}" class="btn-quick quick-primary">
                    <div class="icon-wrap"><i class="bi bi-people-fill"></i></div>
                    Nasabah
                </a>
                <a href="{{ route('admin.waste-types.index') }}" class="btn-quick quick-success">
                    <div class="icon-wrap"><i class="bi bi-recycle"></i></div>
                    Sampah
                </a>
                <a href="{{ route('admin.waste-transactions.index') }}" class="btn-quick quick-warning">
                    <div class="icon-wrap"><i class="bi bi-arrow-left-right"></i></div>
                    Transaksi
                </a>
                <a href="{{ route('admin.groceries.index') }}" class="btn-quick quick-danger">
                    <div class="icon-wrap"><i class="bi bi-gift-fill"></i></div>
                    Hadiah
                </a>
            </div>
        </div>
    </div>

</div>

@endsection