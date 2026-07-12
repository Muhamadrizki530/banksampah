@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/nasabah/index.css') }}">
@endpush
@section('content')



<div class="nasabah-wrapper">

    <div class="nasabah-header">
        <h3><i class="bi bi-people"></i> Data Nasabah</h3>

        <a href="{{ route('admin.nasabah.create') }}" class="btn-nasabah-add">
            <i class="bi bi-plus-lg"></i> Tambah Nasabah
        </a>
    </div>

    @if(session('success'))
        <div class="alert-nasabah-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="nasabah-card">
        <table class="table-nasabah">

            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Pengguna</th>
                    <th>No HP</th>
                    <th>Poin</th>
                    <th>Total</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($nasabah as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td style="min-width:280px;">
                            <div class="nasabah-name">

                                <div class="nasabah-avatar">
                                    {{ strtoupper(substr($item->name,0,1)) }}
                                </div>

                                <div>
                                    <div class="nasabah-fullname">{{ $item->name }}</div>
                                    <div class="nasabah-email">{{ $item->email }}</div>
                                </div>

                            </div>
                        </td>

                        <td>
                            {{ $item->phone }}
                        </td>

                        <td>
                            <span class="badge-point">
                                {{ number_format($item->current_point) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge-total">
                                {{ number_format($item->total_point) }}
                            </span>
                        </td>

                        <td>
                            <div style="display:flex; align-items:center; gap:6px;">

                                <a href="{{ route('admin.nasabah.edit',$item->id) }}"
                                    class="action-icon-btn edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form
                                    action="{{ route('admin.nasabah.destroy',$item->id) }}"
                                    method="POST"
                                    style="display:inline-flex;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Hapus data?')"
                                        class="action-icon-btn delete"
                                        style="border:1px solid #fecaca;">

                                        <i class="bi bi-trash3"></i>

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
                                Belum ada data nasabah
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection