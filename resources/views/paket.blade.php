@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tambah Data Paket</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <form action="{{ route('data-paket.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" required>
                                @error('no_resi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_produk" class="form-control-label">Deskripsi Paket</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                                @error('nama_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_hpPenerima" class="form-control-label">No HP Penerima</label>
                                <input type="text" class="form-control" id="no_hpPenerima" name="no_hpPenerima" required>
                                @error('no_hpPenerima')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_ekspedisi" class="form-control-label">Nama Ekspedisi</label>
                                <select class="form-control" id="nama_ekspedisi" name="nama_ekspedisi" required>
                                    <option value="" disabled selected>Pilih Ekspedisi</option>
                                    <option value="JNE">JNE</option>
                                    <option value="Tiki">Tiki</option>
                                    <option value="Pos Indonesia">Pos Indonesia</option>
                                    <option value="Gojek">Gojek</option>
                                    <option value="Grab">Grab</option>
                                </select>
                                @error('nama_ekspedisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_tiba" class="form-control-label">Tanggal Tiba</label>
                                <input type="date" class="form-control" id="tgl_tiba" name="tgl_tiba" required>
                                @error('tgl_tiba')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="form-control-label">Lokasi</label>
                                <select class="form-control" id="lokasi" name="lokasi" required>
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                    <option value="Kampus A">Kampus A</option>
                                    <option value="Kampus B">Kampus B</option>
                                    <option value="Kampus C">Kampus C</option>
                                </select>
                                @error('lokasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Dikirim">Dikirim</option>
                                    <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                                    <option value="Sampai">Sampai</option>
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
