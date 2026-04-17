@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Judul -->
    <h1 class="h3 mb-2 text-gray-800">Data Kelas</h1>
    <p class="mb-4">Pengelolaan data kelas SMA Negeri 1 Bondowoso</p>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">

        <!-- Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kelas</h6>

            <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kelas
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kelas as $k)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $k->nama_kelas }}</td>
                            <td class="text-center">
                                <span class="badge badge-info">
                                    {{ $k->jurusan }}
                                </span>
                            </td>
                            <td class="text-center">

                                <a href="{{ route('admin.kelas.edit', $k->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.kelas.destroy', $k->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus data kelas ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Data kelas belum tersedia
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