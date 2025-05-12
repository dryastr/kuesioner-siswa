@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="row">
        <!-- Card Jumlah Siswa -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Siswa</h5>
                    <p class="card-text">{{ $totalSiswa }} siswa terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Siswa yang Mengisi Kuesioner -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Siswa yang Mengisi Kuesioner</h5>
                    <p class="card-text">{{ $siswaMengisiKuesioner }} siswa telah mengisi kuesioner</p>
                </div>
            </div>
        </div>

        <!-- Card Rata-rata Nilai -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rata-rata Nilai Kuesioner</h5>
                    <p class="card-text">{{ number_format($rataRataNilai, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Card Kategori Siswa -->
        <div class="col-12 mt-4">
            <h4>Kategori Siswa yang Mengisi Kuesioner</h4>
            <div class="row">
                @foreach ($kategoriSiswa as $kategori)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $kategori->category }}</h5>
                                <p class="card-text">{{ $kategori->total }} siswa</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
