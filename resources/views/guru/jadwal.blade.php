@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Jadwal Mengajar</h1>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Hari</th>
                        <th>Jam</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jadwal as $j)
                    <tr>
                        <td>{{ $j->kelas->nama_kelas }}</td>
                        <td>{{ $j->mapel->nama_mapel }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection