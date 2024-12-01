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
                  <h3 class="font-weight-bolder text-info text-gradient">Lacak Paket</h3>
                  <p class="mb-0" style="color: white;">Masukkan nomor resi atau detail terkait untuk mencari data paket Anda.</p>
                </div>
              </div>
              <div class="card-body">
                <form role="form" method="GET" action="{{ url('search-paket') }}">
                  <label style="color: white;">Nomor Resi</label>
                  <div class="mb-3">
                    <input type="text" name="resi" class="form-control" placeholder="Masukkan nomor resi" aria-label="Nomor Resi" aria-describedby="resi-addon">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Cari Paket</button>
                  </div>
                </form>
              </div>

              @if(isset($results) && count($results) > 0)
              <div class="table-responsive mt-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Resi</th>
                      <th>Nama Security</th>
                      <th>Lokasi</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($results as $index => $result)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $result->resi }}</td>
                      <td>{{ $result->nama_security }}</td>
                      <td>{{ $result->lokasi }}</td>
                      <td>{{ $result->status }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @else
              <p class="text-center mt-4" style="color: white;">Tidak ada data ditemukan.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
