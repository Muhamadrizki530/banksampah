<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bank Sampah</title>

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')   
    <style>
        :root{
            --bg:            #F8FAFC;
            --sidebar:       #FFFFFF;
            --card:          #FFFFFF;
            --primary:       #2563EB;
            --primary-hover: #1D4ED8;
            --success:       #22C55E;
            --warning:       #F59E0B;
            --danger:        #EF4444;
            --border:        #E5E7EB;
            --text-primary:  #111827;
            --text-secondary:#6B7280;

            --radius: 12px;
            --shadow-sm: 0 1px 2px rgba(17, 24, 39, 0.04), 0 1px 3px rgba(17, 24, 39, 0.06);
            --transition: 0.2s ease;
        }

        *{ box-sizing: border-box; }

        html, body{
            min-height: 100vh;
            background: var(--bg);
            font-family: 'Inter', -apple-system, 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }

        a{ text-decoration: none; }

        h1, h2, h3, h4, h5, h6{
            font-weight: 700;
            color: var(--text-primary);
        }

        button{ font-family: 'Inter', sans-serif; }

        /* ===== Top bar ===== */
        .topbar{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #FFFFFF;
            border-bottom: 1px solid var(--border);
            padding: 14px 28px;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .topbar-brand{
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--text-primary);
            flex-shrink: 0;
        }
        .topbar-brand i{
            color: var(--primary);
            font-size: 1.2rem;
        }

        .topbar-actions{
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* ===== User menu / logout ===== */
        .top-user-wrap{
            position: relative;
        }

        .top-user{
            display: flex;
            align-items: center;
            gap: 10px;
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 5px 12px 5px 5px;
            cursor: pointer;
            transition: border-color var(--transition), background var(--transition);
        }
        .top-user:hover, .top-user.open{
            border-color: var(--primary);
            background: var(--bg);
        }
        .top-user-avatar{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: #fff;
            flex-shrink: 0;
        }
        .top-user-name{
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-primary);
        }
        .top-user i.bi-chevron-down{
            color: var(--text-secondary);
            font-size: 0.75rem;
            transition: transform var(--transition);
        }
        .top-user.open i.bi-chevron-down{
            transform: rotate(180deg);
        }

        .user-dropdown{
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 210px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 12px 28px -8px rgba(17, 24, 39, 0.18);
            overflow: hidden;
            display: none;
            z-index: 40;
        }
        .user-dropdown.show{ display: block; }

        .user-dropdown .dropdown-header{
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }
        .user-dropdown .dropdown-header .dh-name{
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
        }
        .user-dropdown .dropdown-header .dh-email{
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 2px;
            word-break: break-all;
        }

        .user-dropdown a,
        .user-dropdown button{
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            text-align: left;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-primary);
            background: none;
            border: none;
            cursor: pointer;
            transition: background var(--transition), color var(--transition);
        }
        .user-dropdown a i,
        .user-dropdown button i{
            font-size: 0.95rem;
            color: var(--text-secondary);
            width: 16px;
        }
        .user-dropdown a:hover,
        .user-dropdown button:hover{
            background: var(--bg);
        }
        .user-dropdown .logout-btn{
            color: var(--danger);
            border-top: 1px solid var(--border);
        }
        .user-dropdown .logout-btn i{
            color: var(--danger);
        }
        .user-dropdown .logout-btn:hover{
            background: rgba(239, 68, 68, 0.08);
        }

        /* ===== Layout shell ===== */
        .shell{
            display: flex;
            gap: 24px;
            padding: 24px 28px;
            align-items: flex-start;
        }

        /* ===== Sidebar ===== */
        .sidebar{
            width: 240px;
            flex-shrink: 0;
            background: var(--sidebar);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 12px;
            position: sticky;
            top: 96px;
        }

        .sidebar h6{
            color: var(--text-secondary);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar .nav-link{
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 2px;
            position: relative;
            transition: background var(--transition), color var(--transition);
        }

        .sidebar .nav-link i{
            font-size: 1rem;
            width: 18px;
            text-align: center;
            color: var(--text-secondary);
            transition: color var(--transition);
        }

        .sidebar .nav-link:hover{
            background: var(--bg);
            color: var(--text-primary);
        }
        .sidebar .nav-link:hover i{ color: var(--text-primary); }

        .sidebar .nav-link.active{
            background: rgba(37, 99, 235, 0.08);
            color: var(--primary);
            font-weight: 600;
        }
        .sidebar .nav-link.active i{ color: var(--primary); }
        .sidebar .nav-link.active::before{
            content: "";
            position: absolute;
            left: -12px;
            top: 8px;
            bottom: 8px;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: var(--primary);
        }

        /* ===== Content ===== */
        .content-area{
            flex: 1;
            min-width: 0;
        }

        /* ===== Shared components (cards, tables, buttons, alerts) ===== */
        .card{
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow var(--transition), border-color var(--transition);
        }
        .card:hover{
            box-shadow: 0 4px 10px rgba(17, 24, 39, 0.06);
        }

        .table-card{
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        table{
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        thead th{
            position: sticky;
            top: 0;
            background: var(--bg);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            text-align: left;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
        }
        tbody td{
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            color: var(--text-primary);
            font-weight: 400;
        }
        tbody tr{ transition: background var(--transition); }
        tbody tr:hover{ background: var(--bg); }
        tbody tr:last-child td{ border-bottom: none; }

        .btn{
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 0.85rem;
            border-radius: 8px;
            padding: 9px 16px;
            transition: background var(--transition), border-color var(--transition), color var(--transition);
            border: 1px solid transparent;
        }
        .btn-primary{
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }
        .btn-primary:hover{
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #fff;
        }
        .btn-secondary{
            background: #fff;
            border-color: var(--border);
            color: var(--text-primary);
        }
        .btn-secondary:hover{
            background: var(--bg);
            border-color: var(--text-secondary);
        }
        .btn-edit{
            background: #fff;
            border-color: var(--border);
            color: var(--text-secondary);
        }
        .btn-edit:hover{
            border-color: var(--text-secondary);
            color: var(--text-primary);
            background: var(--bg);
        }
        .btn-delete{
            background: #fff;
            border-color: var(--danger);
            color: var(--danger);
        }
        .btn-delete:hover{
            background: var(--danger);
            color: #fff;
        }

        .badge-status{
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }
        .badge-success{ background: rgba(34, 197, 94, 0.12); color: #16803D; }
        .badge-warning{ background: rgba(245, 158, 11, 0.12); color: #B45309; }
        .badge-danger{ background: rgba(239, 68, 68, 0.12); color: #B91C1C; }

        .alert-success{
            background: rgba(34, 197, 94, 0.08) !important;
            border: 1px solid rgba(34, 197, 94, 0.35) !important;
            color: #15803D !important;
            border-radius: var(--radius);
            font-size: 0.875rem;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px){
            .shell{ flex-direction: column; padding: 16px; }
            .sidebar{ width: 100%; position: static; }
            .top-user-name{ display: none; }
        }
    </style>
</head>

<body>

<div class="topbar">
    <div class="topbar-brand">
        <i class="bi bi-recycle"></i>
        Bank Sampah Admin
    </div>

    <div class="topbar-actions">
        <div class="top-user-wrap" id="userMenuWrap">
            <div class="top-user" id="userMenuToggle">
                <div class="top-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
                <span class="top-user-name">{{ auth()->user()->name }}</span>
                <i class="bi bi-chevron-down"></i>
            </div>

            <div class="user-dropdown" id="userDropdown">
                <div class="dropdown-header">
                    <div class="dh-name">{{ auth()->user()->name }}</div>
                    <div class="dh-email">{{ auth()->user()->email }}</div>
                </div>

                {{-- Sesuaikan route ini dengan route profil kamu jika ada --}}
                <a href="{{ route('profile.edit') ?? '#' }}">
                    <i class="bi bi-person"></i> Profil Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="shell">

    <div class="sidebar">
        <h6>Menu</h6>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/nasabah" class="nav-link {{ request()->is('admin/nasabah*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Nasabah
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/waste-types" class="nav-link {{ request()->is('admin/waste-types*') ? 'active' : '' }}">
                    <i class="bi bi-trash3"></i> Jenis Sampah
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/waste-transactions" class="nav-link {{ request()->is('admin/waste-transactions*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Transaksi Sampah
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/groceries" class="nav-link {{ request()->is('admin/groceries*') ? 'active' : '' }}">
                    <i class="bi bi-gift"></i> Hadiah
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/redemptions" class="nav-link {{ request()->is('admin/redemptions*') ? 'active' : '' }}">
                    <i class="bi bi-ticket-perforated"></i> Penukaran
                </a>
            </li>

        </ul>
    </div>

    <div class="content-area">

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </div>

</div>

<script>
    // ============ Dropdown user menu / logout ============
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdown    = document.getElementById('userDropdown');

    userMenuToggle.addEventListener('click', function(e){
        e.stopPropagation();
        userDropdown.classList.toggle('show');
        userMenuToggle.classList.toggle('open');
    });

    document.addEventListener('click', function(e){
        if(!document.getElementById('userMenuWrap').contains(e.target)){
            userDropdown.classList.remove('show');
            userMenuToggle.classList.remove('open');
        }
    });

    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape'){
            userDropdown.classList.remove('show');
            userMenuToggle.classList.remove('open');
        }
    });
</script>

</body>
</html>