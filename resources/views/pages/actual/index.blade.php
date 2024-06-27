@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Aktual</h5>
            <p class="card-description">
                Data historikal yang akan dihitung untuk meramalkan data.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('actual.create') }}"><button class="btn btn-primary me-2">Tambah data</button></a>
                    <button class="btn btn-success">Export Excel</button>
                </div>
                <form action="">
                    <input type="text" id="" class="form-control" placeholder="cari data ...">
                </form>
            </div>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Periode</th>
                            <th scope="col">Data Aktual</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Januari</td>
                            <td>100</td>
                            <td></td>
                            <td><a href="{{route('actual.edit', 1)}}"><button class="btn btn-light">Aksi</button></a></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Februari</td>
                            <td>200</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Maret</td>
                            <td>300</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>April</td>
                            <td>400</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Mei</td>
                            <td>500</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Juni</td>
                            <td>600</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Juli</td>
                            <td>700</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Agustus</td>
                            <td>800</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>September</td>
                            <td>900</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>Oktober</td>
                            <td>1000</td>
                            <td></td>
                            <td><button class="btn btn-light">Aksi</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
