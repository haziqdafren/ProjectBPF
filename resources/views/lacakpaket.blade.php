@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-7 col-md-8 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Lacak Paket</h3>
                <p class="mb-0">Masukkan nomor resi atau detail terkait untuk mencari data paket Anda.</p>
              </div>
              <div class="card-body">
                <form role="form" method="GET" action="{{ url('search-paket') }}">
                  <label>Nomor Resi</label>
                  <div class="mb-3">
                    <input type="text" name="resi" class="form-control" placeholder="Masukkan nomor resi" aria-label="Nomor Resi" aria-describedby="resi-addon">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Cari Paket</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Tidak menemukan paket Anda?
                  <a href="contact-support" class="text-info text-gradient font-weight-bold">Hubungi Dukungan</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
