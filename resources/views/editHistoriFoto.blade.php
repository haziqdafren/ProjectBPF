@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Foto Paket</h6>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2">
                            <form action="{{ route('histori.update', $history->no_resi) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="no_resi" class="form-control-label">No Resi</label>
                                    <input type="text" class="form-control" id="no_resi" name="no_resi"
                                        value="{{ $history->no_resi }}" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-control-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" disabled>Pilih Status</option>
                                        <option value="Sudah Diterima"
                                            {{ $history->status == 'Sudah Diterima' ? 'selected' : '' }}>Sudah Diterima
                                        </option>
                                        <option value="Belum Diterima"
                                            {{ $history->status == 'Belum Diterima' ? 'selected' : '' }}>Belum Diterima
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="foto_serah_terima" class="form-control-label">Foto Serah Terima</label>
                                    <input type="file" class="form-control" id="foto_serah_terima"
                                        name="foto_serah_terima">
                                    @if ($history->foto_serah_terima)
                                        <img src="{{ Storage::url($history->foto_serah_terima) }}" alt="Foto Serah Terima"
                                            width="100" class="mt-2">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
