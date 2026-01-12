<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fde2e4, #fadadd);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            width: 900px;
            height: 500px;
            background: #fff;
            border-radius: 20px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* LEFT */
        .login-left {
            width: 45%;
            padding: 50px;
        }

        .login-left h2 {
            color: #e75480;
            margin-bottom: 10px;
        }

        .login-left p {
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #f3c4d4;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #e75480;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #e75480;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #d6456f;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 15px;
        }

        /* RIGHT */
        .login-right {
            width: 55%;
            background: linear-gradient(135deg, #fbc2eb, #f9a8d4);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-right img {
            width: 100%;
        }

        .login-right h3 {
            position: absolute;
            bottom: 40px;
            color: white;
            font-weight: 500;
        }

        @media(max-width: 768px){
            .login-wrapper{
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            .login-right{
                display: none;
            }
            .login-left{
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT -->
    <div class="login-left">
        <h2>Login Admin</h2>
        <p>Selamat datang di Admin Toko Kue 🍰</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button class="login-btn">Login</button>
        </form>
    </div>

    <!-- RIGHT -->
    <div class="login-right">
        <!-- Ganti dengan gambar kamu -->
        <img src="{{ asset('images/login.jpg') }}" alt="Login Illustration">
        <h3>Manajemen Toko Kue</h3>
    </div>

</div>

</body>
</html>
