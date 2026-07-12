@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/waste-transactions/index.css') }}">
@endpush
@section('content')



<div class="waste-wrapper">

    <div class="waste-header">

        <div class="header-title">
            <h3>♻️ Data Transaksi Sampah</h3>
            <p>Kelola seluruh transaksi penyetoran sampah dari nasabah.</p>
        </div>

        <a href="{{ route('admin.waste-transactions.create') }}" class="btn-waste-add">
            <i class="bi bi-plus-lg"></i>
            Tambah Transaksi
        </a>

    </div>

    @if(session('success'))
        <div class="alert-waste-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif


    <div class="waste-card">
        <table class="table-waste">

            <thead>
    <tr>
        <th>No</th>
        <th>Nasabah</th>
        <th>Jenis Sampah</th>
        <th>Berat</th>
        <th>Total Poin</th>
        <th>Tanggal</th>
        <th class="action-column">Aksi</th>
    </tr>
</thead>

          <tbody>

@forelse($transactions as $batchNumber => $items)

@php
    $first = $items->first();
    $totalWeight = $items->sum('weight');
    $totalPoint = $items->sum('total_point');
@endphp

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>
        <div class="waste-user">
            <div class="waste-avatar">
                {{ strtoupper(substr($first->user->name,0,1)) }}
            </div>
            <span>{{ $first->user->name }}</span>
        </div>
    </td>

    <td>
        @foreach($items as $item)
            <span class="badge-jenis">
                {{ $item->wasteType->name }}
            </span>
        @endforeach
    </td>

    <td>
        {{ number_format($totalWeight, 2) }} Kg
    </td>

    <td class="text-point">
        {{ number_format($totalPoint) }} pts
    </td>

    <td class="text-date">
        {{ $first->created_at->format('d-m-Y') }}
    </td>

    <td>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.waste-transactions.receipt', $first) }}"
               class="btn btn-sm btn-primary">

                <i class="bi bi-receipt"></i>

            </a>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="7">

        <div class="empty-state">

            <i class="bi bi-inbox"></i>

            Belum ada transaksi

        </div>

    </td>

</tr>

@endforelse

</tbody>

        </table>
    </div>
    </div>

@endsection