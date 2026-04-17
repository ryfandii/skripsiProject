@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Profile Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ auth()->user()->name }}">
                </div>

                <div class="mb-3">
                    <label>Foto</label><br>

                    @if(auth()->user()->photo)
                        <img src="{{ asset('uploads/' . auth()->user()->photo) }}"
                             width="120" class="mb-2 rounded">
                    @else
                        <img src="{{ asset('sbadmin2/img/undraw_profile.svg') }}"
                             width="120" class="mb-2">
                    @endif

                    <input type="file" name="photo" class="form-control mt-2">
                </div>

                <button class="btn btn-primary">Update Profil</button>

            </form>

        </div>
    </div>

</div>
@endsection