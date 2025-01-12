@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section style="min-height: 100vh;
                 background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)),
                 url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
                 background-size: cover;
                 background-position: center;
                 background-repeat: no-repeat;"><br><br>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-7 col-md-8 d-flex flex-column mx-auto">
            <div class="card card-plain mt-4"> <!-- Adjusted margin-top -->
              <div class="card-header pb-0 text-left bg-transparent">
                <div class="mb-4"> <!-- Added a margin bottom for spacing -->
                  <h3 style="color: white">Lacak Paket</h3>
                  <p class="mb-0" style="color: white;">Masukkan nomor resi atau detail terkait untuk mencari data paket Anda.</p>
                </div>
              </div>
              <div class="card-body">
                <form role="form" method="GET" action="{{ route('search.paket.lacak') }}">
                    <label style="color: white;">Nomor Resi atau Nama Pemilik</label>
                    <div class="mb-3">
                        <input type="text" name="query" class="form-control" placeholder="Masukkan nomor resi atau nama pemilik" aria-label="Nomor Resi atau Nama Pemilik" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Cari Paket</button>
                    </div>
                </form>

              </div>

              @if(isset($results) && count($results) > 0)
                <div class="table-responsive mt-4">
                  <table class="table align-items-center mb-0 custom-table">
                    <thead>
                      <tr>
                        <th>No Resi</th>
                        <th>Nama Produk</th>
                        <th>Nama Ekspedisi</th>
                        <th>Tanggal Tiba</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Nama Pemilik</th> <!-- Tambahkan kolom untuk nama pemilik -->
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($results as $index => $result)
                        <tr>
                          <td>{{ $result->no_resi }}</td>
                          <td>{{ $result->nama_produk }}</td>
                          <td>{{ $result->ekspedisi ? $result->ekspedisi->nama_ekspedisi : 'Tidak Diketahui' }}</td> <!-- Ambil nama ekspedisi -->
                          <td>{{ \Carbon\Carbon::parse($result->tgl_tiba)->format('d/m/Y') }}</td> <!-- Format tanggal -->
                          <td>{{ $result->lokasi }}</td>
                          <td>{{ $result->dataPaket ? $result->dataPaket->status : 'Tidak Diketahui' }}</td> <!-- Ambil status dari dataPaket -->
                          <td>{{ $result->nama_pemilik }}</td> <!-- Tampilkan nama pemilik -->
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @elseif(isset($results) && count($results) === 0)
                <p class="text-center mt-4" style="color: white;">Nomor resi tidak ditemukan.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
