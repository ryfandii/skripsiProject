@extends('layouts.app')
@section('content')

<div class="container my-5" style="max-width: 700px;">

    <h3 class="mb-4 fw-500" style="border-left: 4px solid #1d4ed8; padding-left: 12px; color: #1a2e4a;">
        Input Soal: {{ $ujian->judul }}
    </h3>

    @if(session('success'))
        <div class="alert alert-dismissible fade show d-flex align-items-center gap-2" role="alert"
             style="background:#dcfce7; color:#166534; border: 0.5px solid #86efac; border-radius: 8px;">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-dismissible fade show d-flex align-items-center gap-2" role="alert"
             style="background:#fef2f2; color:#991b1b; border: 0.5px solid #fca5a5; border-radius: 8px;">
            <i class="bi bi-exclamation-circle"></i>
            {{ $errors->first() }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('guru.ujian.storeSoal', $ujian->id) }}">
        @csrf

        @for($i=0; $i<5; $i++)
            <div class="card mb-4" style="border: 0.5px solid #e2e8f0; border-radius: 12px; overflow: hidden;">

                <div class="card-header d-flex align-items-center gap-2"
                     style="background: #1a2e4a; color: #e0eeff; padding: 12px 20px; border: none;">
                    <i class="bi bi-file-text" style="font-size: 16px;"></i>
                    Soal
                    <span style="background: rgba(255,255,255,0.15); border-radius: 20px; padding: 2px 10px;
                                 font-size: 12px; color: #bfdbfe;">
                        {{ $i + 1 }} / 5
                    </span>
                </div>

                <div class="card-body p-4">

                    <div class="mb-3">
                        <label for="pertanyaan-{{ $i }}" class="form-label"
                               style="font-size: 13px; font-weight: 500; color: #1a2e4a;">
                            <i class="bi bi-question-circle" style="margin-right: 4px; color: #1d4ed8;"></i>
                            Pertanyaan
                        </label>
                        <input type="text" id="pertanyaan-{{ $i }}" name="soal[{{ $i }}][pertanyaan]"
                               class="form-control" placeholder="Masukkan pertanyaan soal ke-{{ $i+1 }}..."
                               style="font-size: 14px; border: 0.5px solid #cbd5e1; border-radius: 8px;"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 13px; font-weight: 500; color: #1a2e4a;">
                            Pilihan Jawaban
                        </label>
                        <div class="row g-2">
                            @foreach(['a','b','c','d'] as $opt)
                                <div class="col-6 col-md-3">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span style="width: 20px; height: 20px; border-radius: 50%;
                                                     background: #1a2e4a; color: #e0eeff; display: inline-flex;
                                                     align-items: center; justify-content: center;
                                                     font-size: 11px; font-weight: 500;">
                                            {{ strtoupper($opt) }}
                                        </span>
                                    </div>
                                    <input type="text" id="{{ $opt }}-{{ $i }}"
                                           name="soal[{{ $i }}][{{ $opt }}]"
                                           class="form-control"
                                           placeholder="Pilihan {{ strtoupper($opt) }}"
                                           style="font-size: 14px; border: 0.5px solid #cbd5e1; border-radius: 8px;"
                                           required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr style="border: none; border-top: 0.5px solid #e2e8f0; margin: 1rem 0;">

                    <div class="mb-0">
                        <label for="jawaban-{{ $i }}" class="form-label"
                               style="font-size: 13px; font-weight: 500; color: #1a2e4a;">
                            <i class="bi bi-check-circle" style="margin-right: 4px; color: #1d4ed8;"></i>
                            Jawaban Benar
                        </label>
                        <select id="jawaban-{{ $i }}" name="soal[{{ $i }}][jawaban]"
                                class="form-select"
                                style="font-size: 14px; border: 0.5px solid #cbd5e1; border-radius: 8px;"
                                required>
                            <option value="" disabled selected>Pilih jawaban yang benar</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>

                </div>
            </div>
        @endfor

        <div class="d-grid">
            <button type="submit" class="btn btn-lg d-flex align-items-center justify-content-center gap-2"
                    style="background: #1a2e4a; color: #e0eeff; border: none; border-radius: 8px;
                           padding: 13px; font-size: 15px; font-weight: 500;">
                <i class="bi bi-floppy"></i>
                Simpan Soal
            </button>
        </div>
    </form>

</div>

@endsection