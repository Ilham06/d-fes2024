@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 col-lg-4">
                <h4 class="fw-bold text-center mb-2">Forecasting </h4>
                <h4 class="fw-bold text-center mb-5">Sistem Peralaman Jumlah Penjualan Produk</h4>
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-text">
                            <p>Halo, selamat datang kembali.</p>
                            <p>Silahkan login dengan akun anda.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="floatingInput">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-floating">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <label for="floatingPassword">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
