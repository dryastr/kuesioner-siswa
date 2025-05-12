@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Detail Jawaban untuk {{ $user->name }} (Attempt: {{ $attempt }})</h4>
    <div class="mb-3">
        <strong>Total Skor:</strong> {{ $result->total_score }} <br>
        <strong>Kategori:</strong> {{ $result->category }}
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($answers as $answer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $answer->questionnaire->question }}</td>
                        <td>{{ $answer->answer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
