@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah data aktual</h5>
                    <p class="card-description">
                        Form tambah data aktual yang akan menjadi referensi
                        perhitungan
                    </p>
                    <form action="{{ route('actual.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input name="periode" type="text" class="form-control @error('periode') is-invalid @enderror"
                                id="periode" />
                            @error('periode')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Aktual</label>
                            <input name="value" type="text" class="form-control @error('value') is-invalid @enderror"
                                id="aktual" />
                            @error('value')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Keterangan</label>
                            <textarea name="note" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Export dataset</h5>
                    <p class="card-description">
                        anda juga bisa menambahkan dataset anda secara langsung
                        melalui Excel
                    </p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('actual.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="dataset" class="form-label">Pilih file excel</label>
                            <input name="dataset" class="form-control mb-1" type="file" id="dataset" />
                            <a href="{{ asset('assets/dataset.xlsx') }}">download template dataset</a>
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
