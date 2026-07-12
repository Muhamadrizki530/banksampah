@extends('layouts.admin')

@section('title', 'Data Hadiah')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/groceries/index.css') }}">
@endpush
@section('content')


<div class="grocery-wrapper">

    <div class="grocery-header">

        <div>
            <h3><i class="bi bi-gift"></i> Data Hadiah</h3>
            <p>Kelola hadiah yang dapat ditukarkan dengan poin.</p>
        </div>

        <a href="{{ route('admin.groceries.create') }}" class="btn-grocery-add">
            <i class="bi bi-plus-lg"></i>
            Tambah Hadiah
        </a>

    </div>

    <div class="grocery-card">

        <table class="table-grocery">

            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Hadiah</th>
                    <th>Harga Poin</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($groceries as $item)
                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <div class="grocery-name">{{ $item->name }}</div>
                    </td>

                    <td>
                        <span class="badge-point">
                            {{ number_format($item->point_price) }} Poin
                        </span>
                    </td>

                    <td>
                        <span class="badge-stock">
                            {{ $item->stock }}
                        </span>
                    </td>

                    <td>
                        @if($item->status)
                        <span class="badge-status badge-active">
                            <i class="bi bi-check-circle"></i> Aktif
                        </span>
                        @else
                        <span class="badge-status badge-inactive">
                            <i class="bi bi-x-circle"></i> Nonaktif
                        </span>
                        @endif
                    </td>

                    <td>
                        <div style="display:flex; align-items:center; gap:6px;">

                            <a href="{{ route('admin.groceries.edit',$item->id) }}" class="action-btn edit-btn">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.groceries.destroy',$item->id) }}"
                                method="POST"
                                style="display:inline-flex;">

                                @csrf
                                @method('DELETE')

                                <button class="action-btn delete-btn"
                                    onclick="return confirm('Hapus hadiah ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h5 style="color:#1e293b;font-weight:700;font-size:15px;margin-top:5px;">Belum Ada Data Hadiah</h5>
                            <p style="font-size:13.5px;margin-top:4px;">
                                Klik tombol <b>Tambah Hadiah</b> untuk menambahkan data.
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