@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah data pengguna</h5>
                    <p class="card-description">
                        Form tambah data pengguna
                    </p>
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text"
                                class="form-control search @error('name')
                        is-invalid
                        @enderror"
                                id="name" name="name">
                            @error('name')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                class="form-control search @error('email')
                        is-invalid
                        @enderror"
                                id="email" name="email">
                            @error('email')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                class="form-control search @error('password')
                        is-invalid
                        @enderror"
                                id="password" name="password">
                            @error('password')
                                <div id="" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
