@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h5>Edit Ekspedisi</h5>
    <form action="{{ route('ekspedisi.update', $ekspedisi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_ekspedisi" class="form-label">Nama Ekspedisi</label>
            <input type="text" name="nama_ekspedisi" id="nama_ekspedisi" class="form-control" value="{{ $ekspedisi->nama_ekspedisi }}" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="{{ $ekspedisi->kontak }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('ekspedisi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
