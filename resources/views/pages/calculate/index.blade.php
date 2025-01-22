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

                <!-- Multiple Select for Actual Data -->
                <div class="mb-3">
                    <label for="actuals" class="form-label">Pilih Data Aktual</label>
                    <select name="actuals[]" class="form-control @error('actuals') is-invalid @enderror" id="actuals" multiple>
                        <!-- Options will be populated dynamically -->
                    </select>
                    @error('actuals')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alpha" class="form-label">Nilai alpha</label>
                    <input name="alpha" type="text" class="form-control @error('alpha') is-invalid @enderror" id="alpha">
                    @error('alpha')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            // When product is selected, fetch actual data for that product
            document.getElementById('product_id').addEventListener('change', function() {
                var productId = this.value;

                if (productId) {
                    fetch('/calculate/actuals/' + productId)
                        .then(response => response.json())
                        .then(data => {
                            var actualsSelect = document.getElementById('actuals');
                            actualsSelect.innerHTML = ''; // Clear existing options
                            console.log(data)
                            // Populate with actual data
                            data.forEach(function(actual) {
                                var option = document.createElement('option');
                                option.value = actual.id;
                                option.textContent = `Periode ${actual.periode}, ${actual.value}`; // Assuming 'name' is the field in 'Actual' model
                                actualsSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching actuals:', error));
                }
            });
        </script>
    @endpush
@endsection
