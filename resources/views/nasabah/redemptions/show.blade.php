@extends('layouts.nasabah')

@section('title', 'Struk Penukaran Poin')

@section('content')

@php
$trxNumber = 'RDM-' .
$redemption->created_at->format('Ymd') .
'-' .
str_pad($redemption->id, 6, '0', STR_PAD_LEFT);
@endphp

<div class="container py-4">

    <div class="card border-0 shadow rounded-4">

        <div class="card-header bg-success text-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <i class="bi bi-gift-fill fs-2 me-3"></i>

                    <div>
                        <h3 class="mb-0 fw-bold">
                            Struk Penukaran Poin
                        </h3>

                        <small>
                            Bank Sampah
                        </small>
                    </div>

                </div>

                <span class="badge bg-light text-success fs-6 px-3 py-2">
                    Berhasil
                </span>

            </div>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="border rounded-4 p-3 h-100">

                        <h5 class="fw-bold mb-3">
                            Informasi Penukaran
                        </h5>

                        <table class="table table-borderless mb-0">

                            <tr>
                                <td>No. Transaksi</td>
                                <td class="text-end fw-bold">
                                    {{ $trxNumber }}
                                </td>
                            </tr>

                            <tr>
                                <td>Tanggal</td>
                                <td class="text-end">
                                    {{ $redemption->created_at->format('d F Y') }}
                                </td>
                            </tr>

                            <tr>
                                <td>Jam</td>
                                <td class="text-end">
                                    {{ $redemption->created_at->format('H:i') }}
                                </td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td class="text-end">
                                    <span class="badge bg-success">
                                        Berhasil
                                    </span>
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="border rounded-4 p-3 h-100">

                        <h5 class="fw-bold mb-3">
                            Data Nasabah
                        </h5>

                        <table class="table table-borderless mb-0">

                            <tr>
                                <td>Nama</td>
                                <td class="text-end fw-bold">
                                    {{ $redemption->user->name }}
                                </td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td class="text-end">
                                    {{ $redemption->user->email }}
                                </td>
                            </tr>

                            <tr>
                                <td>Poin Sebelum</td>
                                <td class="text-end fw-bold">
                                    {{ number_format($redemption->point_before) }}
                                </td>
                            </tr>

                            <tr>
                                <td>Poin Digunakan</td>
                                <td class="text-end fw-bold text-danger">
                                    -{{ number_format($redemption->point_used) }}
                                </td>
                            </tr>

                            <tr>
                                <td>Sisa Poin</td>
                                <td class="text-end fw-bold text-success">
                                    {{ number_format($redemption->point_after) }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">
                Detail Penukaran
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>Hadiah</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Poin / Item</th>
                            <th class="text-end">Total Poin</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                <strong>
                                    {{ $redemption->grocery->name }}
                                </strong>
                            </td>

                            <td class="text-center">
                                {{ $redemption->quantity }}
                            </td>

                            <td class="text-center">
                                {{ number_format($redemption->grocery->point_price) }}
                            </td>

                            <td class="text-end fw-bold text-danger">
                                {{ number_format($redemption->point_used) }}
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="row mt-4">

                <div class="col-md-8">

                    <div class="alert alert-light border">

                        <h6 class="fw-bold">
                            Catatan
                        </h6>

                        <p class="mb-0 text-muted">
                            Terima kasih telah melakukan penukaran poin di Bank Sampah.
                            Semoga hadiah yang diterima bermanfaat dan tetap semangat
                            menjaga lingkungan dengan menabung sampah.
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card bg-danger text-white text-center">

                        <div class="card-body">

                            <small>
                                TOTAL POIN DIGUNAKAN
                            </small>

                            <h2 class="fw-bold my-2">
                                {{ number_format($redemption->point_used) }}
                            </h2>

                            <span class="badge bg-light text-danger">
                                Poin Berkurang
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between mt-4">

                <a href="{{ route('nasabah.riwayat-penukaran') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali

                </a>

                <button onclick="window.print()"
                    class="btn btn-success">

                    <i class="bi bi-printer me-2"></i>
                    Print Struk

                </button>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    // Halaman ini adalah tempat user mendarat setelah Beli / Tukar Semua berhasil.
    // Kosongkan keranjang di localStorage supaya tidak menampilkan item yang sudah dibeli.
    localStorage.removeItem('bsl_cart_items');
</script>
@endpush