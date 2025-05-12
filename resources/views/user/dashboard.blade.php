@extends('layouts.main')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title">Halo, {{ Auth::user()->name }}! 👋</h4>
                    <p class="fs-5">Selamat datang di Kuesioner Online!</p>
                </div>
                <div class="card-body mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="text-center">
                                <h5 class="mb-3">Ayo Isi Kuesioner untuk Mendapatkan Hasil yang Menarik! 📝</h5>
                                <p>Dengan mengisi kuesioner, kamu bisa mendapatkan penilaian yang menyenangkan!</p>
                                <a href="{{ route('questionnaire.index') }}" class="btn btn-primary btn-lg">Isi Kuesioner
                                    Sekarang!</a>
                            </div>
                            {{-- <div class="mt-4">
                                <img src="{{ asset('assets/img/cartoon-character.png') }}" alt="Karakter Kartun"
                                    class="img-fluid" style="max-width: 200px;">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
