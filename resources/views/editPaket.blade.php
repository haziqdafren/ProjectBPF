@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Data Paket</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <form action="{{ route('data-paket.update', $dataPaket->no_resi) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" value="{{ $dataPaket->no_resi }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_pemilik" class="form-control-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="{{ $dataPaket->nama_pemilik }}" required>
                                @error('nama_pemilik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_produk" class="form-control-label">Deskripsi Paket</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $dataPaket->nama_produk }}" required>
                                @error('nama_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hpPenerima" class="form-control-label">No HP Penerima</label>
                                <input type="text" class="form-control" id="no_hpPenerima" name="no_hpPenerima" value="{{ $dataPaket->no_hpPenerima }}" required>
                                @error('no_hpPenerima')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ekspedisi_id" class="form-control-label">Nama Ekspedisi</label>
                                <select class="form-control" id="ekspedisi_id" name="ekspedisi_id" required>
                                    <option value="" disabled>Pilih Ekspedisi</option>
                                    @foreach($ekspedisis as $ekspedisi)
                                        <option value="{{ $ekspedisi->Id_ekpedisi }}" {{ $dataPaket->ekspedisi_id == $ekspedisi->Id_ekpedisi ? 'selected' : '' }}>
                                            {{ $ekspedisi->nama_ekspedisi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ekspedisi_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_tiba" class="form-control-label">Tanggal Tiba</label>
                                <input type="date" class="form-control" id="tgl_tiba" name="tgl_tiba" value="{{ $dataPaket->tgl_tiba }}" required>
                                @error('tgl_tiba')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary bg-gradient-dark btn-sm mt-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
