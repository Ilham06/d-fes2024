<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proses Perhitungan</h5>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Periode</th>
                        <th>Data Aktual</th>
                        <th>S1</th>
                        <th>S2</th>
                        <th>a</th>
                        <th>b</th>
                        <th>f</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row['periode'] }}</td>
                            <td>{{ $row['aktual'] }}</td>
                            <td>{{ $row['s1'] }}</td>
                            <td>{{ $row['s2'] }}</td>
                            <td>{{ $row['a'] }}</td>
                            <td>{{ $row['b'] }}</td>
                            <td>{{ $row['f'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- <div>
                <p><strong>MAPE:</strong> {{ $mape }}</p>
            </div> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Hasil Perhitungan</h5>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Periode</th>
                        <th>Data Aktual</th>
                        <th>Hasil Prediksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row['periode'] }}</td>
                            <td>{{ $row['aktual'] }}</td>
                            <td>{{ $row['f'] }}</td>
                        </tr>
                    @endforeach

                    @foreach ($nextForecasts as $key => $forecast)
                        <tr>
                            <td>{{ count($result) + ($key + 1) }}</td>
                            <td>m {{ $key + 1 }}</td>
                            <td>-</td>
                            <td>{{ $forecast }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
