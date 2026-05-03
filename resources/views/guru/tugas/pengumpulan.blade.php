@extends('layouts.app')

@section('content')
<div class="container">

    <h4>Pengumpulan Tugas: {{ $tugas->judul }}</h4>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>File</th>
                <th>Waktu Kumpul</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($tugas->pengumpulan as $p)
        <tr>

            <td>{{ $p->siswa->nama ?? '-' }}</td>

            <td>
                <a href="{{ asset('storage/' . $p->file) }}" target="_blank">
                    Download
                </a>
            </td>

            <td>
                {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i') }}
            </td>

            <td>
                @if($p->status == 'telat')
                    <span class="badge bg-warning text-dark">Telat</span>
                @else
                    <span class="badge bg-success">Tepat Waktu</span>
                @endif
            </td>

            <!-- 🔥 FORM NILAI LANGSUNG -->
            <form method="POST" action="{{ route('guru.tugas.nilai', $p->id) }}">
                @csrf

                <td>
                    <input type="number" name="nilai"
                           value="{{ $p->nilai }}"
                           class="form-control"
                           style="width:80px;">
                </td>

                <td>
                    <input type="text" name="komentar"
                           value="{{ $p->komentar }}"
                           class="form-control">
                </td>

                <td>
                    <button class="btn btn-sm btn-success">
                        Simpan
                    </button>
                </td>

            </form>

        </tr>
        @endforeach
        </tbody>

    </table>

</div>
@endsection