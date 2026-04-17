<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
        }

        .container-login {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* LEFT */
        .left {
            width: 40%;
            background: #f4f6fb;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .logo {
            width: 250px;
            margin-bottom: 25px;
        }

        .left h2 {
            color: #2c5aa0;
            margin-bottom: 10px;
        }

        .left p {
            color: #666;
            font-size: 14px;
        }

        /* RIGHT */
        .right {
            width: 60%;
            background: linear-gradient(135deg, #3b6cb7, #4f8dd6);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* FORM */
        .form-box {
            width: 320px;
            text-align: center;
            color: white;
        }

        .form-box h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .form-box p {
            font-size: 13px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: none;
            margin-bottom: 15px;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: none;
            background: #00c851;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #00a844;
        }

        .back {
            margin-top: 10px;
            display: block;
            color: white;
            font-size: 13px;
        }

        .alert {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container-login">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('sbadmin2/img/logosmasa.png') }}" class="logo">

        <h2>SMAN 1 BONDOWOSO</h2>
        <p>Masukkan kode OTP yang telah dikirim ke email</p>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-box">

            <h3>VERIFIKASI OTP</h3>
            <p>Masukkan kode OTP</p>

            @if(session('error'))
                <div class="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verify.otp') }}">
                @csrf

                <input type="text" name="otp" placeholder="Masukkan OTP" required>

                <button>Verifikasi</button>

                <a href="/login" class="back">← Kembali ke Login</a>
            </form>

        </div>
    </div>

</div>

</body>
</html>