@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">{{ $ujian->judul }}</h3>

    {{-- TIMER --}}
    <div class="alert alert-info">
        ⏱ Sisa waktu: <b id="timer"></b>
    </div>

    <form method="POST" action="{{ route('siswa.ujian.submit', $ujian->id) }}">
    @csrf

    <div class="row">

        {{-- ================= KIRI: SOAL ================= --}}
        <div class="col-md-9">

            @foreach($soals as $i => $s)
            <div class="card mb-3 p-3" id="soal{{ $s->id }}">

                <b>Soal {{ $loop->iteration }}</b><br>
                {{ $s->pertanyaan }}

                <hr>

                <label>
                    <input type="radio" name="jawaban[{{ $s->id }}]" value="a">
                    {{ $s->a }}
                </label><br>

                <label>
                    <input type="radio" name="jawaban[{{ $s->id }}]" value="b">
                    {{ $s->b }}
                </label><br>

                <label>
                    <input type="radio" name="jawaban[{{ $s->id }}]" value="c">
                    {{ $s->c }}
                </label><br>

                <label>
                    <input type="radio" name="jawaban[{{ $s->id }}]" value="d">
                    {{ $s->d }}
                </label><br>

            </div>
            @endforeach

            {{-- BUTTON FINISH --}}
            <div class="text-end mb-5">
                <button class="btn btn-success btn-lg">
                    ✅ Finish Ujian
                </button>
            </div>

        </div>


        {{-- ================= KANAN: DAFTAR SOAL ================= --}}
        <div class="col-md-3">

            <div class="card p-3">

                <b>Daftar Soal</b>

                <div class="d-flex flex-wrap mt-2">
                    @foreach($soals as $i => $s)
                        <a href="#soal{{ $s->id }}"
                           class="btn btn-sm btn-outline-primary m-1">
                            {{ $loop->iteration }}
                        </a>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

    </form>

</div>


{{-- ================= TIMER SCRIPT ================= --}}
<script>

let waktu = {{ $ujian->durasi * 60 }};

let timer = setInterval(function() {

    let menit = Math.floor(waktu / 60);
    let detik = waktu % 60;

    document.getElementById('timer').innerHTML =
        menit + " : " + (detik < 10 ? "0" + detik : detik);

    waktu--;

    if (waktu < 0) {
        clearInterval(timer);
        alert("Waktu habis!");
        document.querySelector('form').submit();
    }

}, 1000);

</script>

@endsection