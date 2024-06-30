@extends('layouts.app')

@section('content')
    <x-alert-error />
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title">Forecasting dengan metode Double Exponential Smoothing</h5>
            <p class="card-text">Hallo <span class="fw-bold">{{auth()->user()->name}}</span>, <br> selamat datang kembali di aplikasi Forecasting
                dengan metode Double Exponential Smoothing</p>
            <p class="card-text">Brown Double Exponential Smoothing adalah teknik peramalan deret waktu yang digunakan untuk
                data yang menunjukkan tren dari waktu ke waktu, tetapi tidak memiliki pola musiman. Teknik ini merupakan
                pengembangan dari simple exponential smoothing dengan menambahkan komponen untuk mengakomodasi tren dalam
                data.</p>
            <div class="mt-4">
                <button class="btn btn-success me-2">Panduan Penggunaan</button>
                <a href="{{ route('calculate.index') }}"><button class="btn btn-primary">Mulai Peramalan</button></a>
            </div>
        </div>
    </div>
@endsection
