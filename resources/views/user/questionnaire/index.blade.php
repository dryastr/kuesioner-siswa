@extends('layouts.main')

@section('title', 'Users Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <h4 class="card-title">Kuesioner</h4>

                        <span class="me-2 mb-2 mb-sm-0">Keterangan: STS : Sangat Tidak Sesuai SS : Sangat Sesuai</span>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('questionnaire.store') }}" method="POST">
                            @csrf
                            @foreach ($questions as $question)
                                <div class="mb-4">
                                    <label class="form-label">{{ $loop->iteration }}. {{ $question->question }}</label>
                                    <div class="d-flex align-items-center flex-column flex-sm-row">
                                        {{-- <span class="me-2 mb-2 mb-sm-0">Sangat Tidak Sesuai</span> --}}

                                        <div class="d-flex flex-wrap">
                                            @for ($i = 1; $i <= 6; $i++)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="answers[{{ $loop->index }}][answer]"
                                                        id="question-{{ $question->id }}-{{ $i }}"
                                                        value="{{ $i }}" required>
                                                    <label class="form-check-label"
                                                        for="question-{{ $question->id }}-{{ $i }}">{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>

                                        {{-- <span class="ms-2 mb-2 mb-sm-0">Sangat Sesuai</span> --}}
                                    </div>

                                    <input type="hidden" name="answers[{{ $loop->index }}][questionnaire_id]"
                                        value="{{ $question->id }}">
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
