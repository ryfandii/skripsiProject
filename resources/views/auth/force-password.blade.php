@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-3 text-center">Ganti Password</h4>

            <form method="POST" action="{{ route('force.password.update') }}">
                @csrf

                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Simpan Password</button>

            </form>

        </div>
    </div>

</div>
@endsection