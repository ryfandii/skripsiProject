@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h4 class="mb-3 text-center">Reset Password</h4>

        {{-- ERROR --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('reset.password') }}">
            @csrf

            <input type="password" name="password" class="form-control mb-2" placeholder="Password baru" required>

            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Konfirmasi password" required>

            <button class="btn btn-warning w-100">Reset Password</button>
        </form>
    </div>
</div>
@endsection