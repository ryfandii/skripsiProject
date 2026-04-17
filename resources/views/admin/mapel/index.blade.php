@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Mata Pelajaran</h1>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">
        
        <!-- Card Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Mata Pelajaran</h6>
            <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Mapel</th>
                            <th>Kode</th>
                            <th>Jam Pelajaran</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($mapel as $m)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $m->nama_mapel }}</td>
                            <td class="text-center">{{ $m->kode_mapel }}</td>
                            <td class="text-center">{{ $m->jam_pelajaran }} Jam</td>
                            <td class="text-center">

                                <a href="{{ route('admin.mapel.edit', $m->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
@endsection