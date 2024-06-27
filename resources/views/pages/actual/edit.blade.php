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
                    <form>
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input type="text" class="form-control" id="periode" />
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Aktual</label>
                            <input type="text" class="form-control" id="aktual" />
                        </div>
                        <div class="mb-3">
                            <label for="aktual" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
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
