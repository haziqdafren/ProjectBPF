@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <h6 class="text-uppercase text-secondary text-xxs font-weight-bolder">Form Tambah Data</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tambah Data Paket</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <form action="{{ route('tables') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" required>
                            </div>
                            <div class="form-group">
                                <label for="produk" class="form-control-label">Produk</label>
                                <input type="text" class="form-control" id="produk" name="produk" required>
                            </div>
                            <div class="form-group">
                                <label for="pemilik" class="form-control-label">Pemilik</label>
                                <input type="text" class="form-control" id="pemilik" name="pemilik" required>
                            </div>
                            <div class="form-group">
                                <label for="ekspedisi" class="form-control-label">Ekspedisi</label>
                                <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_tiba" class="form-control-label">Tanggal Tiba</label>
                                <input type="date" class="form-control" id="tgl_tiba" name="tgl_tiba" required>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Belum Diambil">Belum Diambil</option>
                                    <option value="Sudah Diambil">Sudah Diambil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serah_terima" class="form-control-label">Serah Terima</label>
                                <input type="text" class="form-control" id="serah_terima" name="serah_terima">
                            </div>
                            <div class="form-group">
                                <label for="tanda_terima" class="form-control-label">Tanda Terima</label>
                                <input type="file" class="form-control" id="tanda_terima" name="tanda_terima">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
