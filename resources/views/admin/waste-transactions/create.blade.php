@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/waste-transactions/create.css') }}">
@endpush
@section('content')



<div class="waste-wrapper">

    <div class="waste-header">

        <div class="header-title">
            <h3>♻️ Tambah Transaksi Sampah</h3>
            <p>Catat penyetoran sampah baru dari nasabah. Bisa lebih dari satu jenis sampah sekaligus.</p>
        </div>

        <a href="{{ route('admin.waste-transactions.index') }}" class="btn-waste-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>

    <div class="form-card">

        <form action="{{ route('admin.waste-transactions.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Nasabah</label>

                <select
                    name="user_id"
                    class="form-select @error('user_id') is-invalid @enderror">

                    <option value="">-- Pilih Nasabah --</option>

                    @foreach($users as $nasabah)
                    <option value="{{ $nasabah->id }}" {{ old('user_id') == $nasabah->id ? 'selected' : '' }}>
                        {{ $nasabah->name }}
                    </option>
                    @endforeach

                </select>

                @error('user_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <label style="display:block;margin-bottom:8px;color:#1e293b;font-weight:600;font-size:14px;">
                Daftar Sampah
            </label>

            <div id="item-rows">
                {{-- Row pertama (default) --}}
                <div class="item-row">
                    <div class="form-group">
                        <select name="items[0][waste_type_id]" class="form-select">
                            <option value="">-- Pilih Jenis Sampah --</option>
                            @foreach($wasteTypes as $wasteType)
                            <option value="{{ $wasteType->id }}">
                                {{ $wasteType->name }} ({{ number_format($wasteType->point_per_kg) }} Poin/Kg)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="items[0][weight]"
                            class="form-control"
                            placeholder="Berat (Kg)">
                    </div>

                    <button type="button" class="btn-remove-item" onclick="removeRow(this)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>

            @error('items')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="button" class="btn-add-item" onclick="addRow()">
                <i class="bi bi-plus-circle"></i>
                Tambah Jenis Sampah
            </button>

            <div class="form-hint" style="margin-bottom:20px;">
                Total poin akan dihitung otomatis berdasarkan berat dan jenis sampah dari setiap baris.
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-waste-save">
                    <i class="bi bi-check-circle"></i>
                    Simpan Transaksi
                </button>

                <a href="{{ route('admin.waste-transactions.index') }}" class="btn-waste-cancel">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<script>
    let rowIndex = 1;

    const wasteTypeOptions = `
    <option value="">-- Pilih Jenis Sampah --</option>
    @foreach($wasteTypes as $wasteType)
        <option value="{{ $wasteType->id }}">{{ $wasteType->name }} ({{ number_format($wasteType->point_per_kg) }} Poin/Kg)</option>
    @endforeach
`;

    function addRow() {
        const container = document.getElementById('item-rows');

        const row = document.createElement('div');
        row.className = 'item-row';
        row.innerHTML = `
        <div class="form-group">
            <select name="items[${rowIndex}][waste_type_id]" class="form-select">
                ${wasteTypeOptions}
            </select>
        </div>

        <div class="form-group">
            <input
                type="number"
                step="0.01"
                min="0"
                name="items[${rowIndex}][weight]"
                class="form-control"
                placeholder="Berat (Kg)">
        </div>

        <button type="button" class="btn-remove-item" onclick="removeRow(this)" title="Hapus">
            <i class="bi bi-trash"></i>
        </button>
    `;

        container.appendChild(row);
        rowIndex++;
    }

    function removeRow(btn) {
        const container = document.getElementById('item-rows');
        if (container.children.length > 1) {
            btn.closest('.item-row').remove();
        }
    }
</script>

@endsection