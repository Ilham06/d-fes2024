@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Produk</h5>
            {{-- <p class="card-description">
                Data produk
            </p> --}}
            <div class="d-flex justify-content-between align-items-center">
                @if (auth()->user()->is_admin)
                    <div class="">
                        <a href="{{ route('product.create') }}"><button class="btn btn-primary me-2">Tambah data</button></a>
                    </div>
                @endif
                {{-- <form action="">
                    <input type="text" id="" class="form-control" placeholder="cari data ...">
                </form> --}}
            </div>
            <x-alert-success />
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Id Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Keterangan</th>
                            @if (auth()->user()->is_admin)
                                <th scope="col" width="10%" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->note }}</td>
                                @if (auth()->user()->is_admin)
                                    <td class="d-flex gap-2"><a href="{{ route('product.edit', $product->id) }}"><button
                                                class="btn btn-light btn-sm">Edit</button></a>
                                        <form action="{{ route('product.delete', $product->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('apakah anda ingin menghapus data?')"
                                                type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
