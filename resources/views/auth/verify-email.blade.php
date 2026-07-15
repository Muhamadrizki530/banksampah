<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>

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
            background:#f4f7fb;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }

        .container{
            width:100%;
            max-width:500px;
            background:#fff;
            border-radius:20px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.08);
            text-align:center;
        }

        .logo{
            width:85px;
            height:85px;
            background:#2563EB;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            margin-bottom:20px;
        }

        .logo i{
            color:#fff;
            font-size:35px;
        }

        h2{
            color:#2563EB;
            margin-bottom:10px;
        }

        p{
            color:#666;
            line-height:1.8;
            font-size:15px;
            margin-bottom:25px;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            border:1px solid #86efac;
            padding:14px;
            border-radius:10px;
            margin-bottom:20px;
            font-size:14px;
        }

        .btn{
            width:100%;
            border:none;
            background:#2563EB;
            color:#fff;
            padding:14px;
            border-radius:10px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .btn:hover{
            background:#1D4ED8;
        }

        .logout{
            display:block;
            margin-top:18px;
            color:#ef4444;
            text-decoration:none;
            font-weight:600;
        }

        .logout:hover{
            text-decoration:underline;
        }

        .info{
            margin-top:20px;
            font-size:13px;
            color:#888;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="logo">
        <i class="fas fa-envelope-open-text"></i>
    </div>

    <h2>Verifikasi Email</h2>

    <p>
        Terima kasih telah mendaftar di <strong>Bank Sampah</strong>.<br>
        Kami telah mengirimkan tautan verifikasi ke alamat email Anda.
        Silakan buka email tersebut lalu klik tombol verifikasi agar akun dapat digunakan.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="success">
            <i class="fas fa-circle-check"></i>
            Link verifikasi berhasil dikirim ulang.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="btn">
            <i class="fas fa-paper-plane"></i>
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="logout" style="background:none;border:none;cursor:pointer;">
            Keluar
        </button>
    </form>

    <div class="info">
        Tidak menerima email?<br>
        Periksa folder <strong>Spam</strong> atau klik tombol <strong>Kirim Ulang Email Verifikasi</strong>.
    </div>

</div>

</body>
</html>