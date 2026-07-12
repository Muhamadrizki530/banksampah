@extends('layouts.admin')

@section('title', 'Tambah Hadiah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/groceries/create.css') }}">
@endpush

@section('content')


<div class="grocery-wrapper">

    <div class="grocery-header">

        <div>
            <h3><i class="bi bi-gift"></i> Tambah Hadiah</h3>
            <p>Tambahkan hadiah yang dapat ditukarkan menggunakan poin.</p>
        </div>

        <a href="{{ route('admin.groceries.index') }}" class="btn-grocery-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>

    <div class="form-card">

        <form action="{{ route('admin.groceries.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Nama Hadiah</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Contoh : Beras 5 Kg">

                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Foto Hadiah</label>

                <input
                    type="file"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/*"
                    onchange="previewImage(event)">

                <div class="form-hint">Format JPG/PNG, maksimal 2MB.</div>

                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <img id="preview" class="preview-image" alt="Preview foto hadiah">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Masukkan deskripsi hadiah...">{{ old('description') }}</textarea>

                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Poin</label>

                <input
                    type="number"
                    name="point_price"
                    class="form-control @error('point_price') is-invalid @enderror"
                    value="{{ old('point_price') }}"
                    placeholder="5000">

                @error('point_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>

                <input
                    type="number"
                    name="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock') }}"
                    placeholder="10">

                @error('stock')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>

                <select
                    name="status"
                    class="form-select @error('status') is-invalid @enderror">

                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Nonaktif</option>

                </select>

                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">

                <button type="submit" class="btn-grocery-save">
                    <i class="bi bi-check-circle"></i>
                    Simpan Hadiah
                </button>

                <a href="{{ route('admin.groceries.index') }}"
                    class="btn-grocery-cancel">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

<script>
    function previewImage(event) {

        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (!file) return;

        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
</script>

@endsection