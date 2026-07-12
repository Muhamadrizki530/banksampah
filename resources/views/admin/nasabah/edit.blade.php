@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/nasabah/edit.css') }}">
@endpush
@section('content')



<div class="form-wrapper">

    <div class="form-title">
        <i class="bi bi-pencil-square"></i>
        <h3>Edit Data Nasabah</h3>
    </div>

    <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="form-label">Nama Lengkap</label>
            <input type="text"
       name="nama"
       class="form-control"
       value="{{ old('nama', $nasabah->name) }}"
       required>
        </div>

        <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $nasabah->email) }}"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Nomor HP</label>
            <input type="text"
                   name="no_hp"
                   class="form-control"
                   value="{{ old('no_hp', $nasabah->phone) }}"
                   required>
        </div>
<div class="mb-4">
    <label class="form-label">Jenis Kelamin</label>

    <select name="jenis_kelamin" class="form-control" required>
        <option value="Laki-laki"
            {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
            Laki-laki
        </option>

        <option value="Perempuan"
            {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
            Perempuan
        </option>
    </select>
</div>
        <div class="mb-4">
            <label class="form-label">Alamat</label>
            <textarea name="alamat"
                      rows="4"
                      class="form-control"
                      required>{{ old('alamat', $nasabah->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-update">
            <i class="bi bi-check-circle"></i>
            Update Data
        </button>

        <a href="{{ route('admin.nasabah.index') }}" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </form>

</div>

@endsection