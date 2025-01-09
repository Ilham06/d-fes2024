@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proses Perhitungan</h5>
            <p class="card-description">
                Pilih produk yang akan diramalkan penjualannya, dan input nilai alpha yang akan digunakan untuk perhitungan. nilai alpha berkisar antara 0 sampai 1
            </p>
            <x-alert-error/>
            <form action="{{ route('calculate.result') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product_id" class="form-label">Pilih Produk</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" id="product_id">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
                {{-- <div class="mb-3">
                    <label for="m" class="form-label">Periode</label>
                    <input value="1" name="m" value="1" type="number"
                        class="form-control @error('m') is-invalid @enderror" id="m">
                    @error('m')
                        <div id="" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
