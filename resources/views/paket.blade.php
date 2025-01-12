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

                        <!-- Display the logged-in user's name -->
                        <p>User: <strong>{{ $user->name }}</strong></p>

                        <form action="{{ route('data-paket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" required>
                                @error('no_resi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_pemilik" class="form-control-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
                                @error('nama_pemilik')
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
                                <label for="ekspedisi_id" class="form-control-label">Nama Ekspedisi</label>
                                <select class="form-control" id="ekspedisi_id" name="ekspedisi_id" required>
                                    <option value="" disabled selected>Pilih Ekspedisi</option>
                                    @foreach($ekspedisis as $ekspedisi)
                                        <option value="{{ $ekspedisi->Id_ekpedisi }}">{{ $ekspedisi->nama_ekspedisi }}</option>
                                    @endforeach
                                </select>
                                @error('ekspedisi_id')
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
                                <label for="bukti_serah_terima" class="form-control-label">Bukti Serah Terima (Foto)</label>
                                <input type="file" class="form-control" id="bukti_serah_terima" name="bukti_serah_terima" accept="image/*" onchange="previewImage(event)">
                                @error('bukti_serah_terima')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img id="imagePreview" src="#" alt="Preview" style="display: none; width: 100%; max-width: 300px; margin-top: 10px;" class="img-thumbnail"> <!-- Preview image -->
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

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Set the image source to the file's data URL
            imagePreview.style.display = 'block'; // Show the image preview
        }

        if (file) {
            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            imagePreview.src = '#'; // Reset the image source if no file is selected
            imagePreview.style.display = 'none'; // Hide the image preview
        }
    }
</script>

@endsection
