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
                        <form action="{{ route('histori.update', $history->no_resi) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="no_resi" class="form-control-label">No Resi</label>
                                <input type="text" class="form-control" id="no_resi" name="no_resi" value="{{ $history->no_resi }}" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disabled>Pilih Status</option>
                                    <option value="Sudah Diterima" {{ $history->status == 'Sudah Diterima' ? 'selected' : '' }}>Sudah Diterima</option>
                                    <option value="Belum Diterima" {{ $history->status == 'Belum Diterima' ? 'selected' : '' }}>Belum Diterima</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi" class="form-control-label">Lokasi</label>
                                <select class="form-control" id="lokasi" name="lokasi" required>
                                    <option value="" disabled>Pilih Lokasi</option>
                                    <option value="Pos Security" {{ $history->lokasi == 'Pos Security' ? 'selected' : '' }}>Pos Security</option>
                                    <option value="Rumah Tangga" {{ $history->lokasi == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                                </select>
                                @error('lokasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="foto_serah_terima" class="form-control-label">Foto Serah Terima</label>
                                <input type="file" class="form-control" id="foto_serah_terima" name="foto_serah_terima" accept="image/*" onchange="previewImage(event)">
                                @if($history->foto_serah_terima)
                                    <img src="{{ Storage::url($history->foto_serah_terima) }}" alt="Foto Serah Terima" width="100" class="mt-2">
                                @endif
                            </div>

                            <div class="form-group">
                                <!-- Elemen untuk menampilkan pratinjau gambar -->
                                <img id="imagePreview" src="#" alt="Preview" style="display: none; width: 100%; max-width: 300px; margin-top: 10px;" class="img-thumbnail">
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

<script>
    // Fungsi untuk menampilkan pratinjau gambar
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview'); // Mendapatkan elemen gambar untuk pratinjau
        const file = event.target.files[0]; // Mengambil file gambar yang dipilih
        const reader = new FileReader(); // Membuat objek FileReader untuk membaca file

        // Ketika file berhasil dibaca
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Mengatur sumber gambar pratinjau ke data URL file
            imagePreview.style.display = 'block'; // Menampilkan gambar pratinjau
        }

        // Jika ada file yang dipilih
        if (file) {
            reader.readAsDataURL(file); // Membaca file sebagai data URL
        } else {
            imagePreview.src = '#'; // Mengatur ulang sumber gambar jika tidak ada file yang dipilih
            imagePreview.style.display = 'none'; // Menyembunyikan gambar pratinjau
        }
    }
</script>

@endsection
