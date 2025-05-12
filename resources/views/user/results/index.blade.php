@extends('layouts.main')

@section('title', 'Hasil Kuesioner')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="card-title">Hasil Kuesioner</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 mt-5">
                        <h5>Pilih Jawaban</h5>
                        <form class="" method="GET" action="{{ route('results.index') }}">
                            <select name="attempt" class="form-select" onchange="this.form.submit()">
                                @foreach ($attempts as $att)
                                    <option value="{{ $att }}" {{ $att == $attempt ? 'selected' : '' }}>
                                        Jawaban Kuesioner ke-{{ $att }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    @if ($results)
                        <div class="mb-3 mt-5">
                            <h5>Total Skor</h5>
                            <p class="fs-4 text-success fw-bold">{{ $results->total_score }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Kategori</h5>
                            <p class="fs-4 text-info fw-bold">{{ $results->category }}</p>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('questionnaire.index') }}" class="btn btn-outline-primary">Isi Kuesioner
                                Lagi</a>
                        </div>
                    @else
                        <p class="text-center text-danger">Belum ada hasil kuesioner untuk attempt ini. Silakan isi
                            kuesioner terlebih dahulu.</p>
                        <div class="text-center">
                            <a href="{{ route('questionnaire.index') }}" class="btn btn-primary">Isi Kuesioner</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
