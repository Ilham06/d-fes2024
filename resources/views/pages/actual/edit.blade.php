@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah data aktual penjualan</h5>
                    <p class="card-description">
                        Form tambah data aktual yang akan menjadi referensi
                        perhitungan
                    </p>
                    <form action="{{ route('actual.update', $actual->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Pilih Produk</label>
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" id="product_id">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $actual->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input name="periode" value="{{ $actual->periode }}" type="text"
                                class="form-control @error('periode') is-invalid @enderror" id="periode" />
                            @error('periode')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Jumlah aktual penjualan</label>
                            <input name="value" value="{{ $actual->value }}" type="text"
                                class="form-control @error('value') is-invalid @enderror" id="aktual" />
                            @error('value')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Keterangan</label>
                            <textarea name="note" class="form-control" name="" id="" cols="30" rows="10">{{ $actual->note }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
