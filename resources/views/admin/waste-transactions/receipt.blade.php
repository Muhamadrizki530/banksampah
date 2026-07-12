@extends('layouts.print')

@section('title','Struk Transaksi')

@section('content')

@php
$trxNumber = 'TRX-' .
$wasteTransaction->created_at->format('Ymd') .
'-' .
str_pad($wasteTransaction->id, 6, '0', STR_PAD_LEFT);
@endphp

<div class="receipt">

    <div class="receipt-header">

        <div class="brand">

            <div class="brand-icon">
                <i class="bi bi-recycle"></i>
            </div>

            <div>
                <h3>Bank Sampah</h3>
                <p>Struk Transaksi Setor Sampah</p>
            </div>

        </div>

        <div class="status">

            <i class="bi bi-check-circle-fill me-1"></i>

            Transaksi Berhasil

        </div>

    </div>

    <div class="receipt-body">

        <div class="info-grid">

            <div class="info-box">

                <h5>Informasi Transaksi</h5>

                <div class="info-row">
                    <span>No. Transaksi</span>
                    <strong>{{ $trxNumber }}</strong>
                </div>

                <div class="info-row">
                    <span>Tanggal</span>
                    <strong>{{ $wasteTransaction->created_at->format('d F Y') }}</strong>
                </div>

                <div class="info-row">
                    <span>Jam</span>
                    <strong>{{ $wasteTransaction->created_at->format('H:i') }}</strong>
                </div>

            </div>

            <div class="info-box">

                <h5>Data Nasabah</h5>

                <div class="info-row">
                    <span>Nama</span>
                    <strong>{{ $wasteTransaction->user->name }}</strong>
                </div>

                <div class="info-row">
                    <span>Email</span>
                    <strong>{{ $wasteTransaction->user->email }}</strong>
                </div>

                <div class="info-row">
                    <span>Poin Sebelum</span>
                    <strong>{{ number_format($wasteTransaction->point_before) }}</strong>
                </div>

                <div class="info-row">
                    <span>Poin Didapat</span>
                    <strong>+{{ number_format($wasteTransaction->total_point) }}</strong>
                </div>

                <div class="info-row">
                    <span>Poin Sesudah</span>
                    <strong>{{ number_format($wasteTransaction->point_after) }}</strong>
                </div>

            </div>

        </div>

        <h5 class="section-title">

            Detail Sampah

        </h5>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Jenis Sampah</th>
                        <th>Kategori</th>
                        <th class="text-center">Berat</th>
                        <th class="text-center">Poin / Kg</th>
                        <th class="text-end">Total Poin</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($batchItems as $item)
                    <tr>

                        <td>
                            <strong>
                                {{ $item->wasteType->name }}
                            </strong>
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                {{ $item->wasteType->category }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ number_format($item->weight,2) }} Kg
                        </td>

                        <td class="text-center">
                            {{ number_format($item->wasteType->point_per_kg) }}
                        </td>

                        <td class="text-end fw-bold text-primary">
                            {{ number_format($item->total_point) }}
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
        <div class="summary">

            <div class="note-box">

                <h6 class="fw-bold mb-2">

                    Catatan

                </h6>

                <p class="text-muted mb-0">

                    Terima kasih telah berpartisipasi dalam program Bank Sampah.
                    Setiap setoran sampah yang Anda lakukan membantu menjaga
                    kebersihan lingkungan serta menambah poin yang dapat
                    ditukarkan dengan hadiah.

                </p>

            </div>

            <div class="point-box">

                <small>

                    TOTAL POIN

                </small>

                <h1>

                    {{ number_format($totalPoint) }}

                </h1>

                <span class="badge bg-success">

                    Berhasil Ditambahkan

                </span>

            </div>

        </div>

        <div class="signature">

            <div>

                <p>

                    Mengetahui,

                </p>

                <h6 class="fw-bold">

                    Admin Bank Sampah

                </h6>

            </div>

            <div>

                <p>

                    Penerima,

                </p>

                <h6 class="fw-bold">

                    {{ $wasteTransaction->user->name }}

                </h6>

            </div>

        </div>

        <div class="receipt-action">

            <a href="{{ route('admin.waste-transactions.index') }}"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </a>

            <div class="d-flex gap-2">

                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-primary">

                    <i class="bi bi-printer me-2"></i>

                    Print Struk

                </button>

                <a href="{{ route('admin.waste-transactions.pdf', $wasteTransaction) }}"
                    class="btn btn-success">

                    <i class="bi bi-file-earmark-pdf me-2"></i>

                    Download PDF

                </a>

            </div>

        </div>

    </div>

</div>

@endsection