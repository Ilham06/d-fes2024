@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proses Perhitungan</h5>
            <p class="card-description">
                Input nilai alpha yang akan digunakan untuk perhitungan sebelum melakukan perhitungan. nilai alpha berkisar
                antara 0 sampai 1
            </p>
            <form action="{{route('calculate.result')}}" method="POST">
               @csrf
                <div class="mb-3">
                    <label for="periode" class="form-label">Nilai alpha</label>
                    <input name="alpha" type="text" class="form-control" id="periode">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
