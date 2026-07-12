<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah</title>

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
            max-width:430px;
            background:#fff;
            border-radius:20px;
            padding:40px;
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
            margin-bottom:25px;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
            border:1px solid #86efac;
        }

        .error{
            background:#fee2e2;
            color:#991b1b;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
            border:1px solid #fecaca;
        }

        .error ul{
            margin-left:20px;
        }

        .form-group{
            margin-bottom:18px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:500;
        }

        .input-box{
            position:relative;
        }

        .input-box input{
            width:100%;
            padding:13px 45px 13px 15px;
            border:1px solid #ddd;
            border-radius:10px;
            outline:none;
            transition:.3s;
        }

        .input-box input:focus{
            border-color:#1B8F4C;
        }

        .input-box i{
            position:absolute;
            right:15px;
            top:50%;
            transform:translateY(-50%);
            color:#999;
        }

        .remember{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            font-size:14px;
        }

        .remember a{
            text-decoration:none;
            color:#1B8F4C;
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

        .register{
            margin-top:20px;
            text-align:center;
        }

        .register a{
            color:#1B8F4C;
            text-decoration:none;
            font-weight:600;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="logo">
        <i class="fas fa-recycle"></i>
    </div>

    <h2>Login</h2>
    <p>Masuk ke akun Bank Sampah</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>Email</label>

            <div class="input-box">
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan Email"
                    required
                    autofocus>

                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Password</label>

            <div class="input-box">
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan Password"
                    required>

                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="remember">

            <label>
                <input type="checkbox" name="remember">
                Ingat Saya
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif

        </div>

        <button type="submit">
            <i class="fas fa-right-to-bracket"></i>
            Login
        </button>

    </form>

    <div class="register">
        Belum punya akun?
        <a href="{{ route('register') }}">
            Daftar Sekarang
        </a>
    </div>

</div>

</body>
</html>