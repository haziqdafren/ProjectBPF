@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h5>Daftar Ekspedisi</h5>
    <a href="{{ route('ekspedisi.create') }}" class="btn btn-primary">Tambah Ekspedisi</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ekspedisis as $key => $ekspedisi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $ekspedisi->nama_ekspedisi }}</td>
                    <td>{{ $ekspedisi->kontak }}</td>
                    <td>
                        <a href="{{ route('ekspedisi.edit', $ekspedisi->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ekspedisi.destroy', $ekspedisi->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
