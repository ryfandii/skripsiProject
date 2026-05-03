@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <div class="row">

        {{-- LEFT PANEL --}}
        <div class="col-md-3">

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Informasi Siswa</h6>
                    <hr>
                    <p class="mb-1"><b>Nama:</b> {{ auth()->user()->name }}</p>
                    <p class="mb-1"><b>Kelas:</b> {{ auth()->user()->siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Status Hari Ini</h6>

                    @if($sudahAbsen ?? false)
                        <span class="badge bg-success px-3 py-2">Sudah Hadir</span>
                    @else
                        <span class="badge bg-warning text-dark px-3 py-2">Belum Absen</span>
                    @endif
                </div>
            </div>

        </div>

        {{-- MAIN --}}
        <div class="col-md-9">

            {{-- LIST ABSENSI PER MAPEL --}}
            @forelse($groupedAbsensi as $namaMapel => $items)

                <div class="mb-4">

                    {{-- HEADER MAPEL --}}
                    <h5 class="fw-bold text-primary">
                        📚 {{ $namaMapel }}
                    </h5>
                    <hr>

                    <div class="row">

                        @foreach($items as $absensi)

                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body text-center">

                                    <i class="fas fa-user-check text-success mb-2"></i>

                                    <h6 class="fw-bold">
                                        {{ optional($absensi->guru)->nama ?? '-' }}
                                    </h6>

                                    <small class="text-muted d-block mb-2">
                                        {{ \Carbon\Carbon::now()->translatedFormat('H:i') }}
                                    </small>

                                    <form method="POST" action="{{ route('siswa.absensi.hadir') }}">
                                        @csrf
                                        <input type="hidden" name="absensi_id" value="{{ $absensi->id }}">

                                        @php
                                            $sudah = \App\Models\AbsensiDetail::where('absensi_id', $absensi->id)
                                                ->where('siswa_id', auth()->user()->siswa->id)
                                                ->exists();
                                        @endphp

                                        <button class="btn btn-success btn-sm rounded-pill"
                                            @if($sudah) disabled @endif>

                                            {{ $sudah ? 'Sudah Absen' : 'Hadir' }}
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>

                </div>

            @empty
                <div class="text-center text-muted">
                    Tidak ada absensi aktif
                </div>
            @endforelse

        </div>

    </div>

</div>
@endsection