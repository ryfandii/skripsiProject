<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #36b9cc, #4e73df);
            height: 100vh;
        }

        .register-box {
            margin-top: 8%;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center register-box">

        <div class="col-md-5">

            <div class="card shadow-lg">
                <div class="card-body">

                    <h4 class="text-center mb-4">
                        <b>Register Akun</b>
                    </h4>

                    <form method="POST" action="/register">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>

                        <button class="btn btn-primary btn-block">
                            Register
                        </button>

                        <div class="text-center mt-3">
                            <a href="/login">Sudah punya akun?</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>