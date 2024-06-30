@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Pengguna</h5>
            <p class="card-description">
                Data pengguna yang bisa mengakses aplikasi.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('user.create') }}"><button class="btn btn-primary me-2">Tambah data</button></a>
                </div>
                <form action="">
                    <input type="text" id="" class="form-control" placeholder="cari data ...">
                </form>
            </div>
            <x-alert-success />
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="fw-bold">{{ $user['is_admin'] ? 'admin' : 'user' }}</td>
                                <td>
                                    @if ($user['deleted_at'])
                                        <span class="badge rounded-pill bg-primary">Tidak Aktif</span>
                                    @else
                                        <span class="badge rounded-pill bg-primary">Aktif</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2"><a href="{{ route('user.edit', $user->id) }}"><button
                                            class="btn btn-light btn-sm">Edit</button></a>
                                    @if ($user['deleted_at'])
                                        <form action="{{ route('user.restore', $user->id) }}" method="post">
                                            @csrf
                                            <button onclick="return confirm('apakah anda ingin memulihkan akun?')"
                                                type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('apakah anda ingin menghapus akun?')"
                                                type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </td>
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
