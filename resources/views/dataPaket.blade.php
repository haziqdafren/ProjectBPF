@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Data Paket</h6>
                        <a href="/paket/create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Paket
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-hover align-items-center mb-0">
                                <thead class="table-dark text-white">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Resi</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Pemilik</th>
                                        <th class="text-center">Ekspedisi</th>
                                        <th class="text-center">Tgl Tiba</th>
                                        <th class="text-center">Lokasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPakets as $item) <!-- Gunakan $dataPakets -->
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->no_resi }}</td>
                                        <td class="text-center">{{ $item->produk }}</td>
                                        <td class="text-center">{{ $item->pemilik }}</td>
                                        <td class="text-center">{{ $item->ekspedisi }}</td>
                                        <td class="text-center">{{ $item->tgl_tiba }}</td>
                                        <td class="text-center">{{ $item->lokasi }}</td>
                                        <td class="text-center">
                                            <a href="/paket/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/paket/{{ $item->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Data tidak tersedia</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {!! $dataPakets->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
