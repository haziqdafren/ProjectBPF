@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h5>Tambah Ekspedisi</h5>
    <form action="{{ route('ekspedisi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_ekspedisi" class="form-label">Nama Ekspedisi</label>
            <input type="text" name="nama_ekspedisi" id="nama_ekspedisi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('ekspedisi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
