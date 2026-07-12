@extends('layouts.admin')

@section('content')

<style>
body{
    background:#f5f7fb;
    font-family:'Poppins',sans-serif;
}

/* Wrapper */
.waste-wrapper{
    background:#fff;
    border-radius:22px;
    padding:30px;
    box-shadow:0 10px 35px rgba(15,23,42,.06);
    max-width:720px;
    margin:0 auto;
}

/* Header */
.waste-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
    gap:15px;
}

.header-title h3{
    margin:0;
    font-size:26px;
    font-weight:700;
    color:#1e293b;
    display:flex;
    align-items:center;
    gap:10px;
}

.header-title h3 i{
    color:#16a34a;
}

.header-title p{
    margin-top:5px;
    color:#64748b;
    font-size:14px;
}

/* Back button */
.btn-waste-back{
    background:#fff;
    color:#334155;
    border:1px solid #e2e8f0;
    border-radius:12px;
    padding:11px 20px;
    font-weight:600;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.25s;
}

.btn-waste-back:hover{
    background:#f8fafc;
    border-color:#cbd5e1;
    color:#1e293b;
}

/* Form card */
.form-card{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:18px;
    padding:28px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#1e293b;
    font-weight:600;
    font-size:14px;
}

.form-control,
.form-select{
    width:100%;
    padding:12px 15px;
    border-radius:12px;
    border:1px solid #e2e8f0;
    background:#f8fafc;
    color:#1e293b;
    font-family:'Poppins',sans-serif;
    font-size:14px;
    transition:.2s;
}

.form-control::placeholder{
    color:#94a3b8;
}

.form-control:focus,
.form-select:focus{
    outline:none;
    border-color:#22c55e;
    box-shadow:0 0 0 4px rgba(34,197,94,.12);
    background:#fff;
}

.form-control.is-invalid,
.form-select.is-invalid{
    border-color:#f87171;
}

.text-danger{
    color:#ef4444;
    font-size:13px;
    margin-top:6px;
    display:block;
}

.form-hint{
    color:#94a3b8;
    font-size:12.5px;
    margin-top:6px;
}

/* Save button */
.btn-waste-save{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:#fff;
    border:none;
    border-radius:12px;
    padding:12px 24px;
    font-weight:600;
    text-decoration:none;
    transition:.25s;
    display:inline-flex;
    align-items:center;
    gap:8px;
}

.btn-waste-save:hover{
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 12px 20px rgba(34,197,94,.25);
}

.btn-waste-cancel{
    background:#fff;
    color:#64748b;
    border:1px solid #e2e8f0;
    border-radius:12px;
    padding:12px 22px;
    font-weight:600;
    text-decoration:none;
    transition:.2s;
}

.btn-waste-cancel:hover{
    background:#f8fafc;
    color:#334155;
    border-color:#cbd5e1;
}

.form-actions{
    display:flex;
    gap:10px;
    margin-top:6px;
}
</style>

<div class="waste-wrapper">

    <div class="waste-header">

        <div class="header-title">
            <h3><i class="bi bi-recycle"></i> Edit Jenis Sampah</h3>
            <p>Perbarui data kategori sampah dan poin per kilogram.</p>
        </div>

        <a href="{{ route('admin.waste-types.index') }}" class="btn-waste-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>

    <div class="form-card">

        <form action="{{ route('admin.waste-types.update', $wasteType->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Sampah</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Contoh : Botol Plastik"
                    value="{{ old('name', $wasteType->name) }}">

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Sampah</label>

                <select
                    name="category"
                    class="form-select @error('category') is-invalid @enderror">

                    <option value="">-- Pilih Jenis Sampah --</option>

                    @foreach(['Plastik', 'Kertas', 'Logam', 'Kaca', 'Tekstil', 'Elektronik', 'Organik', 'Minyak Jelantah'] as $category)
                        <option value="{{ $category }}" {{ old('category', $wasteType->category) == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach

                </select>

                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Poin per Kg</label>

                <input
                    type="number"
                    name="point_per_kg"
                    class="form-control @error('point_per_kg') is-invalid @enderror"
                    placeholder="Contoh : 20"
                    value="{{ old('point_per_kg', $wasteType->point_per_kg) }}">

                <div class="form-hint">Poin ini akan dipakai otomatis saat menghitung total poin transaksi nasabah.</div>

                @error('point_per_kg')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>

                <select
                    name="status"
                    class="form-select @error('status') is-invalid @enderror">

                    <option value="1" {{ old('status', $wasteType->status) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0" {{ old('status', $wasteType->status) == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>

                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-waste-save">
                    <i class="bi bi-check-circle"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.waste-types.index') }}" class="btn-waste-cancel">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

@endsection