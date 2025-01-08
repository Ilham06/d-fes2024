@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Proses Perhitungan</h5>
                    <p class="card-description">
                        Proses perhitungan dengan metode Double Exponential Smoothing menggunakan nilai alpha
                        ({{ $alpha }}),
                        berdasarkan data aktual yang telah di input.
                    </p>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Data Aktual</th>
                                    <th scope="col">S1</th>
                                    <th scope="col">S2</th>
                                    <th scope="col">a</th>
                                    <th scope="col">b</th>
                                    <th scope="col">f</th>
                                    {{-- <th scope="col">e</th>
                                    <th scope="col">abs-e</th>
                                    <th scope="col">pe</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $row)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $row['periode'] }}</td>
                                        <td>{{ $row['aktual'] }}</td>
                                        <td>{{ $row['s1'] }}</td>
                                        <td>{{ $row['s2'] }}</td>
                                        <td>{{ $row['a'] }}</td>
                                        <td>{{ $row['b'] }}</td>
                                        <td>{{ $row['f'] }}</td>
                                        {{-- <td>{{ $row['e'] }}</td>
                                        <td>{{ $row['abs_e'] }}</td>
                                        <td>{{ $row['percent_e'] }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="mt-4">
                        <p><span class="fw-bold">MAPE : </span> {{ $mape }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Hasil Perhitungan</h5>
                    <p class="card-description">
                        Dari proses diatas, maka didapatkan hasil perhitungan untuk {{ $m }} periode selanjutnya
                        sebagai berikut :
                    </p>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Data Aktual</th>
                                    <th scope="col">Hasil Prediksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $row)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $row['periode'] }}</td>
                                        <td>{{ $row['aktual'] }}</td>
                                        <td>{{ $row['f'] }}</td>
                                    </tr>
                                @endforeach

                                @foreach ($nextForecasts as $key => $forcast)
                                    <tr class="table-secondary">
                                        <th scope="row">{{ count($result) + ($key + 1) }}</th>
                                        <td>m {{ $key + 1 }}</td>
                                        <td>-</td>
                                        <td class="fw-bold">{{ $forcast }}</td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik perbandingan</h5>
                    <div id="apex1"></div>
                </div>
            </div>
            <div class="">
                @if (Request::path() !== 'hasil-peramalan')
                    <form action="{{ route('calculate.saved') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Simpan Peramalan</button>
                    </form>
                @endif
                <button class="btn btn-danger" onclick="window.location.href='{{ route('calculate.printPDF') }}'">Print PDF</button>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var data = JSON.parse(`<?php echo $chartData; ?>`);

        $(document).ready(function() {
            var options1 = {
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                colors: ['#b3baff', '#90e0db'],
                series: [{
                    name: 'Data Aktual',
                    data: data.aktual
                }, {
                    name: 'Data Peramalan',
                    data: data.forecasting
                }],

                xaxis: {
                    type: 'string',
                    categories: data.periode,
                    labels: {
                        style: {
                            colors: 'rgba(94, 96, 110, .5)'
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                grid: {
                    borderColor: 'rgba(94, 96, 110, .5)',
                    strokeDashArray: 4
                }
            }

            var chart1 = new ApexCharts(
                document.querySelector("#apex1"),
                options1
            );

            chart1.render();

        });
    </script>
@endpush
