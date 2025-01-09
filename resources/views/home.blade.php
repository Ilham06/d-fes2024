@extends('layouts.app')

@section('content')
    <x-alert-error />
    <div class="card text-start">
        <div class="card-body position-relative">
            <h5 class="card-title">Halo <span class="fw-bold">{{ auth()->user()->name }}</span>, Selamat datang kembali.</h5>
            <div class="w-full position-relative">
                <!-- Overlay dengan opacity 70% -->
                <div class="position-absolute top-0 left-0 w-100 h-100 bg-dark" style="opacity: 0.7"></div>
                <!-- Gambar dengan border radius dan opacity 0.7 -->
                <img width="100%" class="rounded-3" src="{{ asset('assets/images/home.jpeg') }}" alt="">
                <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                    <h2>Peramalan Double Exponential Smoothing</h2>
                    <p class="lead">Implementasi Double Exponential Smoothing untuk meramalkan hasil penjualan produk</p>
                </div>
            </div>
            {{-- <div class="mt-4">
                <a href="{{ route('help') }}"><button class="btn btn-success me-2">Panduan Penggunaan</button></a>
                <a href="{{ route('calculate.index') }}"><button class="btn btn-primary">Mulai Peramalan</button></a>
            </div> --}}
        </div>
    </div>
@endsection
