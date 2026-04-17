@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <div class="card shadow">
        <div class="card-body text-center">

            <h4>Selamat Datang 👑</h4>

            @auth
            {{ auth()->user()->name }}
             @endauth

            <p class="text-muted">
                Anda login sebagai <b>Admin</b>
            </p>

        </div>
    </div>

</div>
@endsection