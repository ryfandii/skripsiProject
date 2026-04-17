@extends('layouts.app')

@section('content')
<div class="container">

<h3>Profile</h3>

<form method="POST" action="{{ route('siswa.profile.update') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control mb-2">

<input type="file" name="foto" class="form-control mb-2">

<button class="btn btn-primary">Update</button>

</form>

</div>
@endsection