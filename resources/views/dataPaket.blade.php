@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">

        {{-- Success notification with optional WhatsApp button --}}
        @if(session('success'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                            @if(session('receipt_number'))
                                <br><small>Nomor Resi: <strong>{{ session('receipt_number') }}</strong></small>
                            @endif
                        </div>
                        @if(session('whatsapp_url'))
                        <div class="ms-3">
                            <a href="{{ session('whatsapp_url') }}"
                               target="_blank"
                               class="btn btn-sm btn-success"
                               title="Kirim notifikasi ke {{ session('recipient_name', 'penerima') }}">
                                <i class="fab fa-whatsapp me-1"></i> Kirim Notifikasi WhatsApp
                            </a>
                        </div>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        {{-- Error notification --}}
        @if(session('error'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-5">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Data Paket</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-2 pt-2 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pemilik</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ekspedisi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Tiba</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPakets as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->no_resi }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item->nama_pemilik }}</p>
                                                    <p class="text-xxs text-secondary mb-0">{{ $item->no_hpPenerima }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ Str::limit($item->nama_produk, 20) }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">{{ $item->ekspedisi ? $item->ekspedisi->nama_ekspedisi : 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($item->tgl_tiba)->format('d/m/Y') }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm {{ $item->lokasi === 'Pos Security' ? 'bg-gradient-warning' : 'bg-gradient-success' }}">
                                                    {{ $item->lokasi }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm {{ $item->status === 'Belum Diterima' ? 'bg-gradient-danger' : 'bg-gradient-success' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('data-paket.edit', $item->no_resi) }}" class="btn btn-warning btn-sm mb-0" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('data-paket.destroy', $item->no_resi) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mb-0" type="submit" data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">Belum ada data paket</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination --}}
                        @if ($dataPakets->hasPages())
                            <div class="d-flex justify-content-center mt-3 pb-3">
                                {!! $dataPakets->links('pagination::bootstrap-5') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    // For NON-demo users: Add confirmation dialog for delete
    @if(!auth()->user()->is_demo)
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin menghapus data?')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    });
    @endif
</script>
@endpush

@endsection
