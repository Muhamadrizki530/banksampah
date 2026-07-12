@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/waste-types/index.css') }}">
@endpush
@section('content')

<div class="waste-wrapper">

    <div class="waste-header">

        <div class="header-title">
            <h3>
                <i class="bi bi-recycle"></i>
                Jenis Sampah
            </h3>
            <p>Kelola kategori sampah dan poin per kilogram.</p>
        </div>

        <a href="{{ route('admin.waste-types.create') }}" class="btn-waste-add">
            <i class="bi bi-plus-lg"></i>
            Tambah Jenis Sampah
        </a>

    </div>

    @if(session('success'))
        <div class="alert-waste-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="waste-card">

        <table class="table-waste">

            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Nama Sampah</th>
                    <th width="170">Poin / Kg</th>
                    <th width="150">Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @php
                    $icons = [
                        'Plastik' => 'bi bi-recycle',
                        'Kertas' => 'bi bi-file-earmark',
                        'Logam' => 'bi bi-gear',
                        'Kaca' => 'bi bi-cup',
                        'Tekstil' => 'bi bi-bag',
                        'Elektronik' => 'bi bi-cpu',
                        'Organik' => 'bi bi-tree',
                        'Minyak Jelantah' => 'bi bi-droplet',
                    ];
                @endphp

                @forelse($wasteTypes as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="waste-name-cell">

                                <div class="waste-icon">
                                    <i class="{{ $icons[$item->category] ?? 'bi bi-recycle' }}"></i>
                                </div>

                                <div>
                                    <div class="waste-name">{{ $item->name }}</div>
                                    <div class="waste-category">{{ $item->category }}</div>
                                </div>

                            </div>
                        </td>

                        <td>
                            <span class="badge-point">
                                {{ number_format($item->point_per_kg) }} Poin
                            </span>
                        </td>

                        <td>
                            @if($item->status)
                                <span class="badge-status badge-active">
                                    <i class="bi bi-check-circle"></i>
                                    Aktif
                                </span>
                            @else
                                <span class="badge-status badge-inactive">
                                    <i class="bi bi-x-circle"></i>
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td>

                            <div style="display:flex;gap:6px;align-items:center;">

                                <a href="{{ route('admin.waste-types.edit',$item->id) }}"
                                   class="action-btn edit-btn">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.waste-types.destroy',$item->id) }}"
                                      method="POST"
                                      style="display:inline-flex;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete-btn"
                                            onclick="return confirm('Hapus jenis sampah ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>Belum Ada Jenis Sampah</h5>
                                <p>
                                    Klik tombol <b>Tambah Jenis Sampah</b>
                                    untuk menambahkan data.
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