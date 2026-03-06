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

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Ekspedisi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kontak</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ekspedisis as $ekspedisi)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $ekspedisi->Id_ekpedisi }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-sm bg-gradient-info me-2">
                                                        <i class="fas fa-shipping-fast"></i>
                                                    </span>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $ekspedisi->nama_ekspedisi }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <i class="fas fa-phone text-primary me-1"></i>
                                                    {{ $ekspedisi->kontak }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('ekspedisi.edit', $ekspedisi->Id_ekpedisi) }}" class="btn btn-warning btn-sm mb-0" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('ekspedisi.destroy', $ekspedisi->Id_ekpedisi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ekspedisi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-0" data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada data ekspedisi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
