<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nasabah</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f5f7f9;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }

        .container{
            width:100%;
            max-width:450px;
            background:#fff;
            padding:40px;
            border-radius:20px;
            box-shadow:0 15px 40px rgba(0,0,0,.08);
        }

        .logo{
            width:70px;
            height:70px;
            background:#1B8F4C;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            color:#fff;
            font-size:28px;
            margin-bottom:20px;
        }

        h2{
            text-align:center;
            color:#1B8F4C;
            margin-bottom:8px;
        }

        p{
            text-align:center;
            color:#777;
            margin-bottom:30px;
            font-size:14px;
        }

        .alert{
            background:#fee2e2;
            color:#991b1b;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
            border:1px solid #fecaca;
        }

        .alert ul{
            margin-left:20px;
        }

        .form-group{
            margin-bottom:18px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
            font-weight:500;
        }

        .input-box{
            position:relative;
        }

        .input-box input,
        .input-box textarea{
            width:100%;
            padding:13px 45px 13px 15px;
            border:1px solid #ddd;
            border-radius:10px;
            font-size:14px;
            outline:none;
            transition:.3s;
            resize:none;
        }

        .input-box input:focus,
        .input-box textarea:focus{
            border-color:#1B8F4C;
        }

        .input-box i{
            position:absolute;
            right:15px;
            top:50%;
            transform:translateY(-50%);
            color:#999;
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            border-radius:10px;
            background:#1B8F4C;
            color:#fff;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            background:#15703C;
        }

        .login{
            margin-top:20px;
            text-align:center;
            font-size:14px;
        }

        .login a{
            color:#1B8F4C;
            font-weight:600;
            text-decoration:none;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="logo">
        <i class="fas fa-recycle"></i>
    </div>

    <h2>Daftar Nasabah</h2>
    <p>Lengkapi data untuk membuat akun.</p>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-box">
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap"
                       required>
                <i class="fas fa-user"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <div class="input-box">
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       required>
                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <div class="input-box">
                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="08xxxxxxxxxx"
                       required>
                <i class="fas fa-phone"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <div class="input-box">
                <textarea name="address"
                          rows="3"
                          placeholder="Masukkan alamat"
                          required>{{ old('address') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-box">
                <input type="password"
                       name="password"
                       placeholder="Masukkan password"
                       required>
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-box">
                <input type="password"
                       name="password_confirmation"
                       placeholder="Ulangi password"
                       required>
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <button type="submit">
            <i class="fas fa-user-plus"></i>
            Daftar Sekarang
        </button>

    </form>

    <div class="login">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk</a>
    </div>

</div>

</body>
</html>