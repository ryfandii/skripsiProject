@extends('layouts.app')

@section('content')
<div class="container">

<h3>Data Nilai</h3>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Mapel</th>
        <th>Nilai</th>
    </tr>

    @foreach($nilai as $n)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $n->mapel->nama_mapel }}</td>
        <td>{{ $n->nilai }}</td>
    </tr>
    @endforeach

</table>

</div>
@endsection