@extends('layouts.user_type.auth')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-3">History</h5>
                    <form action="{{ route('histori.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari berdasarkan nomor resi..." value="{{ request()->get('search') }}">
                        <button class="btn btn-dark btn-sm ms-2" type="submit">Cari</button>
                    </form>
                </div>
            </div>
            <div class="card-body px-2 pt-2 pb-2">
                <div class="table-responsive p-0">
                    @if ($histories->isEmpty())
                        <div class="text-center mt-3">
                            <p class="text-muted">Tidak ada data ditemukan untuk nomor resi yang dimasukkan.</p>
                        </div>
                    @else
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemilik</th>
                                    <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Ekspedisi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP Penerima</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Tiba</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Security</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Serah Terima</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->nama_pemilik }}</p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->no_resi }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->nama_produk }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->ekspedisi ? $history->ekspedisi->nama_ekspedisi : 'Tidak Diketahui'}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->no_hpPenerima }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($history->tgl_tiba)->format('d/m/Y') }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->lokasi }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-xs font-weight-bold">{{ $history->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($history->dataPaket)
                                                <span class="text-xs font-weight-bold">{{ $history->dataPaket->security_name }}</span>
                                            @else
                                                <span class="text-xs font-weight-bold text-muted">Tidak ada data paket</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($history->foto_serah_terima)
                                                <img src="{{ Storage::url($history->foto_serah_terima) }}" alt="Foto Serah Terima" style="width: 50px; height: auto;" class="img-thumbnail">
                                            @else
                                                <p class="text-muted">Tidak ada foto</p>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('histori.edit', $history->no_resi) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination Links --}}
                        <div class="d-flex justify-content-center mt-3">
                            {!! $histories->links('pagination::bootstrap-5') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
