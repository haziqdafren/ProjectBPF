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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pemilik</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ekspedisi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Tiba</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $history->no_resi }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <p class="text-xs font-weight-bold mb-0">{{ $history->nama_pemilik }}</p>
                                                <p class="text-xxs text-secondary mb-0">{{ $history->no_hpPenerima }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ Str::limit($history->nama_produk, 20) }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-info">{{ $history->ekspedisi ? $history->ekspedisi->nama_ekspedisi : 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($history->tgl_tiba)->format('d/m/Y') }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm {{ $history->lokasi === 'Pos Security' ? 'bg-gradient-warning' : 'bg-gradient-success' }}">
                                                {{ $history->lokasi }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm {{ $history->status === 'Belum Diterima' ? 'bg-gradient-danger' : 'bg-gradient-success' }}">
                                                {{ $history->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($history->foto_serah_terima)
                                                <a href="{{ Storage::url($history->foto_serah_terima) }}" target="_blank" class="badge badge-sm bg-gradient-info" data-bs-toggle="tooltip" title="Lihat bukti">
                                                    <i class="fas fa-image"></i> Lihat
                                                </a>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('histori.edit', $history->no_resi) }}" class="btn btn-warning btn-sm mb-0" data-bs-toggle="tooltip" title="Edit">
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
