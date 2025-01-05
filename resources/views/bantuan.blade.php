@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section style="min-height: 100vh;
                 background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)),
                 url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
                 background-size: cover;
                 background-position: center;
                 background-repeat: no-repeat;">
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-7 col-md-8 d-flex flex-column mx-auto">
            <div class="card card-plain mt-4" style="border-radius: 15px; background-color: rgb(255, 255, 255);"> <!-- Card styling -->
              <div class="card-header pb-0 text-left bg-transparent">
                <div class="mb-4">
                  <h3 class="text-info">Bantuan</h3> <!-- Changed color to primary -->
                  <p class="mb-0 text-dark">Jika Anda memerlukan bantuan, silakan hubungi kami melalui:</p> <!-- Changed color to dark -->
                </div>
              </div>
              <div class="card-body">
                <h5 class="text-info">Kontak Kami</h5> <!-- Changed color to primary -->
                <ul class="list-unstyled" style="color: #333;"> <!-- Changed text color -->
                  <li><strong>Email:</strong> <a href="mailto:surpa@gmail.com" style="color: rgb(0, 0, 0);">surpa@gmail.com</a></li>
                  <li><strong>Telepon:</strong> <a href="tel:+62123456789" style="color: rgb(0, 0, 0);">+62 123 456 789</a></li>
                  <li><strong>Lokasi:</strong> Jl.Umban Sari Atas, Pekanbaru, Riau.</li>
                </ul>
                <p class="text-dark"><strong>Tim kami siap membantu Anda!</strong></p> <!-- Changed color to dark -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
