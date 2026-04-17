@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Jadwal</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- KELAS -->
                <div class="form-group mb-3">
                    <label>Kelas</label>
                    <select name="kelas_id" class="form-control" required>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" 
                                {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- MAPEL -->
                <div class="form-group mb-3">
                    <label>Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="form-control" required>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}" 
                                {{ $jadwal->mata_pelajaran_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 🔥 TAMBAHAN WAJIB: GURU -->
                <div class="form-group mb-3">
                    <label>Guru</label>
                    <select name="guru_id" class="form-control" required>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}" 
                                {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- HARI -->
                <div class="form-group mb-3">
                    <label>Hari</label>
                    <input type="text" name="hari" value="{{ $jadwal->hari }}" class="form-control" required>
                </div>

                <!-- JAM MULAI -->
                <div class="form-group mb-3">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" class="form-control" required>
                </div>

                <!-- JAM SELESAI -->
                <div class="form-group mb-3">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" class="form-control" required>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection