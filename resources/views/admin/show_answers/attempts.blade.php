@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Daftar Attempt untuk {{ $user->name }}</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Attempt</th>
                    <th>Total Skor</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attempts as $attempt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attempt->attempt }}</td>
                        <td>{{ $attempt->total_score }}</td>
                        <td>{{ $attempt->category }}</td>
                        <td>
                            <a href="{{ route('show.answers.detail', [$user->id, $attempt->attempt]) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
