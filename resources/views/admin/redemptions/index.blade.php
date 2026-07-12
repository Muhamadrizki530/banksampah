@extends('layouts.admin')

@section('title', 'Riwayat Penukaran')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/redemptions/index.css') }}">
@endpush

@section('content')

<div class="redemption-wrapper">

    <div class="redemption-header">
        <div>
            <h3>
                <i class="bi bi-clock-history"></i>
                Riwayat Penukaran
            </h3>

            <p>Daftar seluruh riwayat penukaran hadiah oleh nasabah.</p>
        </div>
    </div>

    <div class="redemption-card">

        <table class="table-redemption">

            <thead>
                <tr>
                    <th width="60">No</th>
                    <th width="380">Nasabah</th>
                    <th width="180">Hadiah</th>
                    <th width="180">Poin Digunakan</th>
                    <th width="170">Status</th>
                    <th width="180">Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($redemptions as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <div class="user-info">

                            <div class="user-avatar">
                                {{ strtoupper(substr($item->user->name,0,1)) }}
                            </div>

                            <div>
                                <div class="user-name">
                                    {{ $item->user->name }}
                                </div>

                                <div class="user-email">
                                    {{ $item->user->email }}
                                </div>
                            </div>

                        </div>
                    </td>

                    <td>
                        {{ $item->grocery->name }}
                    </td>

                    <td>
                        <span class="badge-point">
                            {{ number_format($item->point_used) }} Poin
                        </span>
                    </td>

                    <td>
                        <span class="badge-status badge-approved">
                            <i class="bi bi-check-circle-fill"></i>
                            Berhasil
                        </span>
                    </td>

                    <td>
                        {{ $item->created_at->format('d M Y H:i') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6">

                        <div class="empty-state">

                            <i class="bi bi-clock-history"></i>

                            <h5>
                                Belum Ada Riwayat Penukaran
                            </h5>

                            <p>
                                Riwayat penukaran hadiah oleh nasabah akan muncul di halaman ini.
                            </p>

                        </div>

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection