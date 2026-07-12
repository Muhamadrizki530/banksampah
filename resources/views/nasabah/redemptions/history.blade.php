@extends('layouts.nasabah')

@section('title', 'Riwayat Penukaran')

@push('styles')
<style>

    .rp-header-icon{
        color:#2563eb;
    }

    .btn-rp-primary{
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        border:none;
        color:#fff;
    }

    .btn-rp-primary:hover{
        background:linear-gradient(135deg,#1d4ed8,#1e40af);
        color:#fff;
    }

    .rp-card{
        border:none;
        box-shadow:0 12px 30px -18px rgba(20,35,26,.22);
        border-radius:20px;
    }

    .table-rp-head{
        background:#eff6ff !important;
        color:#1d4ed8;
    }

    .table-rp-head th{
        border-bottom:none;
        font-size:.78rem;
        text-transform:uppercase;
        letter-spacing:.02em;
        font-weight:700;
        color:#1d4ed8;
    }

    /* =========================================================
       MOBILE: ubah tabel jadi kartu bertumpuk
       ========================================================= */
    @media (max-width: 767.98px){

        .container.py-4{
            padding-top:1rem !important;
            padding-bottom:1rem !important;
        }

        .rp-header{
            flex-direction:column;
            align-items:flex-start !important;
            gap:12px;
        }

        .rp-header h2{
            font-size:1.2rem;
        }

        .rp-header a.btn{
            width:100%;
            text-align:center;
        }

        .rp-card .card-body{
            padding:14px;
        }

        .table-rp thead{
            display:none;
        }

        .table-rp, .table-rp tbody, .table-rp tr, .table-rp td{
            display:block;
            width:100%;
        }

        .table-rp tr{
            background:#fff;
            border:1px solid rgba(20,35,26,.08);
            border-radius:14px;
            margin-bottom:12px;
            padding:6px 14px;
        }

        .table-rp td{
            display:flex;
            justify-content:space-between;
            align-items:center;
            text-align:right;
            padding:8px 0;
            border-bottom:1px solid rgba(20,35,26,.06);
        }

        .table-rp td:last-child{
            border-bottom:none;
        }

        .table-rp td::before{
            content: attr(data-label);
            font-weight:600;
            font-size:.75rem;
            text-transform:uppercase;
            letter-spacing:.02em;
            color:#6c7a72;
            text-align:left;
        }

        .table-rp td[data-label="Aksi"]{
            flex-direction:column;
            align-items:stretch;
            gap:8px;
        }

        .table-rp td[data-label="Aksi"]::before{
            text-align:left;
        }

        .table-rp td[data-label="Aksi"] .btn{
            width:100%;
        }

    }

</style>
@endpush

@section('content')

<div class="container py-4">

    <div class="d-flex rp-header justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-clock-history rp-header-icon me-2"></i>
                Riwayat Penukaran
            </h2>

            <p class="text-muted mb-0">
                Semua riwayat penukaran poin Anda.
            </p>
        </div>

        <a href="{{ route('nasabah.tukar-poin') }}"
           class="btn btn-rp-primary rounded-pill">

            <i class="bi bi-gift-fill me-2"></i>
            Tukar Poin

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    <div class="card rp-card">

        <div class="card-body">

            @if($redemptions->count())

                <div class="table-responsive">

                    <table class="table table-rp table-hover align-middle mb-0">

                        <thead class="table-rp-head">

                            <tr>

                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hadiah</th>
                                <th>Jumlah</th>
                                <th>Poin</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($redemptions as $redemption)

                                <tr>

                                    <td data-label="No">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td data-label="Tanggal">
                                        {{ $redemption->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td data-label="Hadiah">

                                        <strong>
                                            {{ $redemption->grocery->name }}
                                        </strong>

                                    </td>

                                    <td data-label="Jumlah">

                                        {{ $redemption->quantity }}

                                    </td>

                                    <td data-label="Poin" class="fw-bold text-danger">

                                        {{ number_format($redemption->point_used) }}

                                    </td>

                                    <td data-label="Status">

                                        @if($redemption->status == 'success')

                                            <span class="badge bg-success">
                                                Berhasil
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Dibatalkan
                                            </span>

                                        @endif

                                    </td>

                                    <td data-label="Aksi">

                                        <a href="{{ route('nasabah.redemptions.show', $redemption) }}"
                                           class="btn btn-rp-primary btn-sm rounded-pill">

                                            <i class="bi bi-eye-fill me-1"></i>
                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-inbox display-1 text-muted"></i>

                    <h4 class="mt-3">
                        Belum Ada Riwayat
                    </h4>

                    <p class="text-muted">
                        Anda belum pernah melakukan penukaran poin.
                    </p>

                    <a href="{{ route('nasabah.tukar-poin') }}"
                       class="btn btn-rp-primary">

                        Tukar Poin Sekarang

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection