@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/nasabah/create.css') }}">
@endpush

@section('content')



<div class="form-nasabah-wrapper">

    <div class="nasabah-form-header">
        <h3><i class="bi bi-person-plus"></i>Tambah Nasabah</h3>

        <a href="{{ route('admin.nasabah.index') }}" class="btn-nasabah-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.nasabah.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama nasabah" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>

            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="form-actions">

            <button type="submit" class="btn-nasabah-save">
                <i class="bi bi-check-circle"></i> Simpan
            </button>

            <a href="{{ route('admin.nasabah.index') }}" class="btn-nasabah-back">
                <i class="bi bi-arrow-left"></i> Batal
            </a>

        </div>

    </form>

</div>

@endsection