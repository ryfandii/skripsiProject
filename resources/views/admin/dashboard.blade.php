@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    {{-- STATISTIK --}}
    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <h6>Jumlah Siswa</h6>
                    <h4>{{ $jumlahSiswa }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <h6>Jumlah Guru</h6>
                    <h4>{{ $jumlahGuru }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <h6>Jumlah Kelas</h6>
                    <h4>{{ $jumlahKelas }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-danger">
                <div class="card-body">
                    <h6>Mata Pelajaran</h6>
                    <h4>{{ $jumlahMapel }}</h4>
                </div>
            </div>
        </div>

    </div>

    {{-- SISWA TERBARU --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5>Siswa Terbaru</h5>
            <ul>
                @foreach($siswaTerbaru as $siswa)
                    <li>
                        {{ $siswa->nama }} 
                        ({{ $siswa->kelas->nama ?? '-' }})
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- 🔥 NILAI TERTINGGI --}}
    <div class="card mt-4">
        <div class="card-body">
            <h5>Nilai Tertinggi</h5>
            <ul>
                @foreach($nilaiTertinggi as $n)
                    <li>
                        {{ $n->siswa->nama ?? '-' }} 
                        - {{ $n->nilai }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection