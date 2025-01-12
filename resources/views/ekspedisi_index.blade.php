@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Daftar Ekspedisi</h6>
                        <a href="{{ route('ekspedisi.create') }}" class="btn btn-primary btn-sm float-end">Tambah Ekspedisi</a>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kontak</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekspedisis as $ekspedisi)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $ekspedisi->Id_ekpedisi }}</p> <!-- Ganti dari $ekspedisi->id ke $ekspedisi->Id_ekpedisi -->
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $ekspedisi->nama_ekspedisi }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $ekspedisi->kontak }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('ekspedisi.edit', $ekspedisi->Id_ekpedisi) }}" class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('ekspedisi.destroy', $ekspedisi->Id_ekpedisi) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus ekspedisi ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($ekspedisis->isEmpty())
                            <p class="text-center mt-4">Belum ada data ekspedisi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
