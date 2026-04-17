<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Akademik</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Akademik</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html, body {
    height: 100%;
}

/* CONTAINER */
.container-login {
    display: flex;
    height: 100vh;
    width: 100%;
}

/* LEFT SIDE */
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

/* LOGO */
.logo {
    width: 300px;
    margin-bottom: 25px;
    transition: 0.3s;
}

.logo:hover {
    transform: scale(1.05);
}

/* TEXT */
.left h2 {
    color: #2c5aa0;
    font-size: 26px;
    margin-bottom: 10px;
    font-weight: 600;
}

.left p {
    color: #666;
    font-size: 14px;
}

/* RIGHT SIDE */
.right {
    width: 60%;
    background: linear-gradient(135deg, #3b6cb7, #4f8dd6);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* LOGIN FORM */
.login-form {
    width: 280px;
    text-align: center;
    color: white;
}

/* TITLE */
.login-form h3 {
    margin-bottom: 5px;
    font-weight: 600;
}

.login-form small {
    display: block;
    margin-bottom: 20px;
    opacity: 0.8;
}

/* INPUT */
.login-form input {
    width: 100%;
    padding: 13px;
    border-radius: 30px;
    border: none;
    margin-bottom: 15px;
    outline: none;
    transition: 0.3s;
}

.login-form input:focus {
    box-shadow: 0 0 0 2px rgba(255,255,255,0.5);
}

/* BUTTON */
.btn-login {
    width: 100%;
    padding: 13px;
    border-radius: 30px;
    border: none;
    background: linear-gradient(135deg, #00c851, #00a844);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* LINK */
.forgot {
    margin-top: 10px;
    font-size: 13px;
}

.forgot a {
    color: #fff;
    text-decoration: underline;
    opacity: 0.8;
}

.forgot a:hover {
    opacity: 1;
}

/* ALERT */
.alert {
    background: rgba(255,255,255,0.2);
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 12px;
}

/* TITLE */
.login-form h3 {
    font-size: 26px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 5px;
    color: #ffffff;
}

/* SUBTITLE */
.login-form small {
    display: block;
    margin-bottom: 25px;
    font-size: 12px;
    color: rgba(255,255,255,0.7);
    letter-spacing: 1px;
}

/* INPUT */
.login-form input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 30px;
    border: none;
    margin-bottom: 15px;
    outline: none;
    background: rgba(255,255,255,0.9);
    font-size: 14px;
    transition: 0.3s;
}

.login-form input::placeholder {
    color: #999;
}

/* FOCUS EFFECT */
.login-form input:focus {
    background: #fff;
    box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
}

/* BUTTON */
.btn-login {
    width: 100%;
    padding: 14px;
    border-radius: 30px;
    border: none;
    background: linear-gradient(135deg, #00c851, #00a844);
    color: white;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}
</style>
</head>

<body>

<div class="container-login">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('sbadmin2/img/logosmasa.png') }}" class="logo">

        <h2>SMAN 1<br>BONDOWOSO</h2>
        <p>Masukkan email dan password<br>untuk melanjutkan</p>
    </div>

   <!-- RIGHT -->
<div class="right">
    <div class="login-form">

        <h3>SIGN IN</h3>
        <small>TO ACCESS THE PORTAL</small>

        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" class="btn-login">Login</button>

            <div class="forgot">
                <a href="/forgot-password">Forgot Password?</a>
            </div>
        </form>

    </div>
</div>

</html>