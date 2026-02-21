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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemilik</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Ekspedisi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP Penerima</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Tiba</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Terima Paket</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Security</th> <!-- Kolom untuk Nama Security -->
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th> <!-- Kolom untuk tombol aksi -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPakets as $item)
                                        <tr>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->nama_pemilik }}</p> <!-- Menampilkan nama pemilik -->
                                            </td>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->no_resi }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->nama_produk }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->ekspedisi ? $item->ekspedisi->nama_ekspedisi : 'Tidak Diketahui' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->no_hpPenerima }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($item->tgl_tiba)->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->lokasi }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if($item->bukti_serah_terima)
                                                    <img src="{{ asset('storage/' . $item->bukti_serah_terima) }}" alt="Bukti Serah Terima" style="width: 50px; height: auto;" class="img-thumbnail">
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">Tidak ada</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->security_name }}</p> <!-- Menampilkan nama security -->
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('data-paket.edit', $item->no_resi) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('data-paket.destroy', $item->no_resi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Data tidak tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- Pagination --}}
                            @if ($dataPakets->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $dataPakets->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
