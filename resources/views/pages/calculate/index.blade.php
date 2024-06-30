@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proses Perhitungan</h5>
            <p class="card-description">
                Input nilai alpha yang akan digunakan untuk perhitungan sebelum melakukan perhitungan. nilai alpha berkisar
                antara 0 sampai 1
            </p>
            <x-alert-error/>
            <form action="{{ route('calculate.result') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="periode" class="form-label">Nilai alpha</label>
                    <input name="alpha" type="text" class="form-control @error('alpha') is-invalid @enderror"
                        id="periode">
                    @error('alpha')
                        <div id="" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="m" class="form-label">Periode</label>
                    <input name="m" value="1" type="number"
                        class="form-control @error('m') is-invalid @enderror" id="m">
                    @error('m')
                        <div id="" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
