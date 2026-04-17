@extends('layouts.app')

@section('content')
<div class="container">

<h3>Absensi</h3>

<table class="table table-bordered">
<tr>
    <th>Tanggal</th>
    <th>Status</th>
</tr>

@foreach($absensi as $a)
<tr>
    <td>{{ $a->tanggal }}</td>
    <td>{{ $a->status }}</td>
</tr>
@endforeach

</table>

</div>
@endsection