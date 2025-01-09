@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit data produk</h5>
                    <p class="card-description">
                        Form edit data produk
                    </p>
                    <form action="{{ route('product.update', $product->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input name="name" value="{{ $product->name }}" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name" />
                            @error('name')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Keterangan</label>
                            <textarea name="note" class="form-control" name="" id="" cols="30" rows="10">{{ $product->note }}</textarea>
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
