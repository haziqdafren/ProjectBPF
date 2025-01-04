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
                        <form action="{{ route('data-paket.update', $dataPaket->no_resi) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" value="{{ $dataPaket->no_resi }}" readonly required>
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
                                <label for="nama_ekspedisi" class="form-control-label">Nama Ekspedisi</label>
                                <select class="form-control" id="nama_ekspedisi" name="nama_ekspedisi" required>
                                    <option value="" disabled>Pilih Ekspedisi</option>
                                    <option value="JNE" {{ $dataPaket->nama_ekspedisi == 'JNE' ? 'selected' : '' }}>JNE</option>
                                    <option value="Tiki" {{ $dataPaket->nama_ekspedisi == 'Tiki' ? 'selected' : '' }}>Tiki</option>
                                    <option value="Pos Indonesia" {{ $dataPaket->nama_ekspedisi == 'Pos Indonesia' ? 'selected' : '' }}>Pos Indonesia</option>
                                    <option value="Gojek" {{ $dataPaket->nama_ekspedisi == 'Gojek' ? 'selected' : '' }}>Gojek</option>
                                    <option value="Grab" {{ $dataPaket->nama_ekspedisi == 'Grab' ? 'selected' : '' }}>Grab</option>
                                </select>
                                @error('nama_ekspedisi')
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
                                <label for="lokasi" class="form-control-label">Lokasi</label>
                                <select class="form-control" id="lokasi" name="lokasi" required>
                                    <option value="" disabled>Pilih Lokasi</option>
                                    <option value="Pos Security" {{ $dataPaket->lokasi == 'Pos Security' ? 'selected' : '' }}>Pos Security</option>
                                    <option value="Rumah Tangga" {{ $dataPaket->lokasi == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                                </select>
                                @error('lokasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="Sudah Diterima" {{ $dataPaket->status == 'Sudah Diterima' ? 'selected' : '' }}>Sudah Diterima</option>
                                    <option value="Belum Diterima" {{ $dataPaket->status == 'Belum Diterima' ? 'selected' : '' }}>Belum Diterima</option>
                                </select>
                                @error('status')
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
