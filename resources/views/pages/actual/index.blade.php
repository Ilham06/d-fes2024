@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Penjualan</h5>
            <p class="card-description">
                Data historikal penjualan yang akan dihitung untuk meramalkan data.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                @if (auth()->user()->is_admin)
                    <div class="">
                        <a href="{{ route('actual.create') }}"><button class="btn btn-primary me-2">Tambah data
                                Penjualan</button></a>
                        <a href="{{ route('actual.export') }}"><button class="btn btn-success">Export Excel</button></a>
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
                            <th scope="col">Periode</th>
                            <th scope="col">Data Aktual</th>
                            <th scope="col">Keterangan</th>
                            @if (auth()->user()->is_admin)
                                <th scope="col" width="10%" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($actuals as $key => $actual)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $actual->periode }}</td>
                                <td>{{ $actual->value }}</td>
                                <td>{{ $actual->note }}</td>
                                @if (auth()->user()->is_admin)
                                    <td class="d-flex gap-2"><a href="{{ route('actual.edit', $actual->id) }}"><button
                                                class="btn btn-light btn-sm">Edit</button></a>
                                        <form action="{{ route('actual.delete', $actual->id) }}" method="post">
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
