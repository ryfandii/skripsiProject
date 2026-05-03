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

       <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="email" value="{{ request('email') }}">

            <div>
                <input type="password" name="password" placeholder="Password baru" required>
            </div>

            <div>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</div>
@endsection