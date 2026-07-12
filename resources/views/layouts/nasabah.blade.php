<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Dashboard Nasabah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')

    <style>

        body{
            background:#f1f5f9;
            font-family:'Poppins',sans-serif;
        }

        /* =========================
            NAVBAR
        ========================= */

        .navbar{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            box-shadow:0 12px 30px rgba(37,99,235,.25);
            z-index:1030;
        }

        .navbar-brand{
            color:#fff;
            font-weight:700;
            font-size:1.2rem;
            letter-spacing:.3px;
        }

        .navbar-brand:hover{
            color:#fff;
        }

        .nav-link{
            color:rgba(255,255,255,.92)!important;
            margin-left:8px;
            font-weight:500;
            padding:8px 14px!important;
            border-radius:10px;
            transition:.25s;
        }

        .nav-link:hover{
            background:rgba(255,255,255,.15);
            color:#fff!important;
        }

        .nav-link.active{
            background:rgba(255,255,255,.22);
            color:#fff!important;
        }

        .navbar-toggler{
            border:none;
            color:#fff;
        }

        .navbar-toggler:focus{
            box-shadow:none;
        }

        .navbar-toggler .bi{
            font-size:1.4rem;
            color:#fff;
        }

        /* =========================
            OFFCANVAS MOBILE MENU
        ========================= */

        .offcanvas-mobile{
            width:280px;
            background:linear-gradient(180deg,#2563eb,#1d4ed8);
            color:#fff;
        }

        .offcanvas-mobile .offcanvas-header{
            border-bottom:1px solid rgba(255,255,255,.15);
        }

        .offcanvas-mobile .offcanvas-title{
            font-weight:700;
            font-size:1.05rem;
        }

        .offcanvas-mobile .btn-close{
            filter:invert(1) grayscale(100%) brightness(200%);
        }

        .offcanvas-mobile .nav-link{
            margin-left:0;
            margin-bottom:6px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .offcanvas-mobile .nav-link.active{
            background:rgba(255,255,255,.22);
        }

        .offcanvas-mobile hr{
            border-color:rgba(255,255,255,.15);
            margin:14px 0;
        }

        .offcanvas-mobile .btn-logout-mobile{
            color:#ffd6d2;
            background:rgba(255,255,255,.08);
            border:none;
            width:100%;
            text-align:left;
            padding:8px 14px;
            border-radius:10px;
            display:flex;
            align-items:center;
            gap:10px;
            font-weight:500;
        }

        .offcanvas-mobile .btn-logout-mobile:hover{
            background:rgba(255,255,255,.16);
            color:#fff;
        }

        /* =========================
            CONTENT
        ========================= */

        .content{
            padding:32px;
            min-height:calc(100vh - 140px);
        }

        /* =========================
            DROPDOWN
        ========================= */

        .dropdown-menu{
            border:none;
            border-radius:16px;
            box-shadow:0 15px 35px rgba(15,23,42,.12);
            padding:8px;
        }

        .dropdown-item{
            border-radius:10px;
            padding:10px 14px;
            transition:.2s;
        }

        .dropdown-item:hover{
            background:#eff6ff;
            color:#2563eb;
        }

        /* =========================
            FOOTER
        ========================= */

        footer{
            margin-top:40px;
            padding:20px;
            text-align:center;
            color:#64748b;
            font-size:14px;
        }

        @media (max-width: 991.98px){
            .content{
                padding:20px;
            }
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top">

    <div class="container">

        <a class="navbar-brand"
           href="{{ route('nasabah.dashboard') }}">

            <i class="bi bi-recycle"></i>
            Bank Sampah

        </a>

        <button class="navbar-toggler bg-transparent"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileNav"
                aria-controls="mobileNav">

            <i class="bi bi-list"></i>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('nasabah.dashboard') ? 'active' : '' }}"
                       href="{{ route('nasabah.dashboard') }}">

                        <i class="bi bi-house-fill"></i>
                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('nasabah.tukar-poin*') ? 'active' : '' }}"
                       href="{{ route('nasabah.tukar-poin') }}">

                        <i class="bi bi-gift-fill"></i>
                        Tukar Poin

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('nasabah.riwayat-penukaran*') ? 'active' : '' }}"
                       href="{{ route('nasabah.riwayat-penukaran') }}">

                        <i class="bi bi-clock-history"></i>
                        Penukaran

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('nasabah.statistik*') ? 'active' : '' }}"
                       href="{{ route('nasabah.statistik') }}">

                        <i class="bi bi-bar-chart-fill"></i>
                        Statistik

                    </a>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>

                            <a class="dropdown-item"
                               href="{{ route('profile.edit') }}">

                                <i class="bi bi-person me-2"></i>
                                Profil

                            </a>

                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button class="dropdown-item text-danger">

                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>

{{-- ============ OFFCANVAS MOBILE MENU (geser dari kiri) ============ --}}
<div class="offcanvas offcanvas-start offcanvas-mobile"
     tabindex="-1"
     id="mobileNav"
     aria-labelledby="mobileNavLabel">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileNavLabel">
            <i class="bi bi-recycle me-1"></i> Bank Sampah
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column">

        <a class="nav-link {{ request()->routeIs('nasabah.dashboard') ? 'active' : '' }}"
           href="{{ route('nasabah.dashboard') }}">
            <i class="bi bi-house-fill"></i> Dashboard
        </a>

        <a class="nav-link {{ request()->routeIs('nasabah.tukar-poin*') ? 'active' : '' }}"
           href="{{ route('nasabah.tukar-poin') }}">
            <i class="bi bi-gift-fill"></i> Tukar Poin
        </a>

        <a class="nav-link {{ request()->routeIs('nasabah.riwayat-penukaran*') ? 'active' : '' }}"
           href="{{ route('nasabah.riwayat-penukaran') }}">
            <i class="bi bi-clock-history"></i> Riwayat Penukaran
        </a>

        <a class="nav-link {{ request()->routeIs('nasabah.statistik*') ? 'active' : '' }}"
           href="{{ route('nasabah.statistik') }}">
            <i class="bi bi-bar-chart-fill"></i> Statistik
        </a>

        <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
           href="{{ route('profile.edit') }}">
            <i class="bi bi-person-circle"></i> Profil
        </a>

        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout-mobile">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

    </div>

</div>

<div class="content">

    @yield('content')

</div>

<footer>

    © {{ date('Y') }} Bank Sampah • Sistem Informasi Bank Sampah

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>