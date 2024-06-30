@extends('layouts.app')

@section('content')
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title">Panduan Penggunaan</h5>
            <ul>
                <li>
                    <p><span class="fw-bold"><a href="{{ route('actual.index') }}" class="text-dark underline">Data Aktual</a> :</span>
                        data aktual adalah data time series (historikal) dari periode-periode sebelumnya yang akan menjadi
                        dasar ketika melakukan perhitungan dengan metode <i>Brown Double Exponential Smoothing.</i> Sebelum
                        melakukan perhitungan, pastikan mengisi data aktual terlebih dahulu. dalam input datanya, bisa
                        manual atau dengan dataset anda sendiri yang di import melalui excel. Data aktual dalam aplikasi ini
                        juga bisa di export dalam bentuk excel.</p>
                </li>
                <li>
                  <p><span class="fw-bold"><a href="{{ route('calculate.index') }}" class="text-dark underline">Perhitungan</a> :</span>
                      Proses perhitungan dengan metode <i>Brown Double Exponential Smoothing.</i> Dalam proses ini, harus melakukan input data nilai alpha (α) yang berkisar dari 0 - 1, dan juga berapa periode yang akan diramalkan (m). Dari perhitungan ini menghasilkan tabel perhitungan, rekapitulasi, dan grafik perbandingan, yang mana menggunakan <b>MAPE</b> sebagai trial errornya. Hasil perhitungannya juga bisa di export dalam bentuk Excel dan Print PDF. </p>
              </li>
            </ul>
        </div>
    </div>
@endsection
