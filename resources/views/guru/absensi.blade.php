@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-0">Absensi Guru</h4>
        <small class="text-muted">
            Lakukan absensi harian dengan kamera
        </small>
    </div>

    <div class="row">

        {{-- KAMERA --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">

                    <div id="camera-area" class="mb-3">
                        <video id="video" width="100%" height="350" autoplay class="rounded border"></video>
                    </div>

                    <button id="start-camera" class="btn btn-primary px-4">
                        Aktifkan Kamera
                    </button>

                    <button id="capture" class="btn btn-success px-4 d-none">
                        Ambil Foto
                    </button>

                </div>
            </div>
        </div>

        {{-- INFO ABSENSI --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">Informasi</h6>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Nama</span>
                            <strong>{{ auth()->user()->name }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tanggal</span>
                            <strong>{{ date('d M Y') }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Jam</span>
                            <strong id="jam"></strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge bg-secondary">Belum Absen</span>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>
    const video = document.getElementById('video');
    const startBtn = document.getElementById('start-camera');
    const captureBtn = document.getElementById('capture');

    startBtn.addEventListener('click', async () => {
        let stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;

        startBtn.classList.add('d-none');
        captureBtn.classList.remove('d-none');
    });

    // JAM REALTIME
    setInterval(() => {
        let now = new Date();
        document.getElementById('jam').innerText =
            now.getHours().toString().padStart(2, '0') + ':' +
            now.getMinutes().toString().padStart(2, '0') + ':' +
            now.getSeconds().toString().padStart(2, '0');
    }, 1000);
</script>

@endsection