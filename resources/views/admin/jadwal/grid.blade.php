@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Jadwal Pelajaran (Grid)</h1>

    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="thead-dark">
                        <tr>
                            <th>Jam</th>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $jamList = $jadwal->groupBy('jam_mulai');
                        @endphp

                        @foreach($jamList as $jam => $items)
                        <tr>
                            <td><b>{{ $jam }}</b></td>

                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                                <td>
                                    @php
                                        $data = $items->where('hari', $hari)->first();
                                    @endphp

                                    @if($data)
                                        <span class="badge badge-primary d-block mb-1">
                                            {{ $data->mapel->nama_mapel }}
                                        </span>
                                        <small>
                                            {{ $data->kelas->nama_kelas }}
                                        </small><br>
                                        <small class="text-muted">
                                            {{ $data->guru->nama ?? '-' }}
                                        </small>
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach

                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection