@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Hasil Peramalan</h5>
                    {{-- <p class="card-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. A, assumenda.
                    </p> --}}
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Hasil Peramalan</th>
                                    <th scope="col">Dibuat pada</th>
                                    <th scope="col" width="20%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $key => $record)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $record->product->name }}</td>
                                        <td>{{ $record->value }}</td>
                                        <td>{{ $record->created_at->format('d F Y, H:i') }}</td>

                                        <td class="d-flex gap-2">
                                            <a href="{{ asset('storage/'.$record->path) }}">
                                                <button class="btn btn-primary">Print
                                                PDF</button></a>
                                            

                                            @if (auth()->user()->is_admin)
                                                <form action="{{ route('forecasting.delete', $record->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="return confirm('apakah anda ingin menghapus data?')"
                                                        type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
