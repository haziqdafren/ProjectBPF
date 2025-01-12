@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Ekspedisi</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form untuk mengedit ekspedisi -->
                        <form action="{{ route('ekspedisi.update', $ekspedisi->Id_ekpedisi) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_ekspedisi" class="form-control-label">Nama Ekspedisi</label>
                                <input type="text" class="form-control" id="nama_ekspedisi" name="nama_ekspedisi" value="{{ $ekspedisi->nama_ekspedisi }}" required>
                                @error('nama_ekspedisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kontak" class="form-control-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $ekspedisi->kontak }}" required>
                                @error('kontak')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary bg-gradient-dark btn-sm mt-3">Simpan Perubahan</button>
                                <a href="{{ route('ekspedisi.index') }}" class="btn btn-secondary btn-sm mt-3">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
