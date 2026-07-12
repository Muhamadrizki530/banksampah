@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.nasabah')

@section('title','Profil Saya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile/edit.css') }}">
@endpush

@section('content')

<div class="profile-wrapper">

    <div class="profile-header">
        <div>
            <h3>
                <i class="bi bi-person-circle"></i>
                Profil Saya
            </h3>
            <p>Kelola informasi akun dan keamanan akun Anda.</p>
        </div>
    </div>

    <div class="profile-grid">

        <div class="profile-card">
            <div class="card-header">
                <i class="bi bi-person"></i>
                Informasi Profil
            </div>

            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="profile-card">
            <div class="card-header">
                <i class="bi bi-lock"></i>
                Ubah Password
            </div>

            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

    </div>

</div>

@endsection