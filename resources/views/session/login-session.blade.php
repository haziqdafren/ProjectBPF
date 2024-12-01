@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section class="min-vh-100 d-flex align-items-center justify-content-center"
    style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)), url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">

    <div class="container">
      <div class="row justify-content-center">
        <!-- Kolom Form Sign-in -->
        <div class="col-lg-5 col-md-6 d-flex flex-column mx-auto">
          <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
              <h3 class="font-weight-bolder text-info text-gradient">Mari Lacak Paketmu!</h3>
              <p class="mb-0">Buat Akun Baru<br></p>
              <p class="mb-0">Atau Masuk dengan Otoritas berikut:</p>
            </div>
            <div class="card-body">
              <form role="form" method="POST" action="/session">
                @csrf
                <label for="email">Email</label>
                <div class="mb-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <label for="password">Password</label>
                <div class="mb-3">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret" aria-label="Password" aria-describedby="password-addon">
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                  <label class="form-check-label" for="rememberMe">Ingat saya</label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn w-100 mt-4 mb-0" style="background: linear-gradient(to right, #17c1e8, #007bff); color: #fff;">Masuk</button>
                </div>
              </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
              <small class="text-muted">Lupa Password? Reset Password
                <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">Disini</a>
              </small>
              <p class="mb-4 text-sm mx-auto">
                Tidak Punya akun?
                <a href="register" class="text-info text-gradient font-weight-bold">Daftar</a>
              </p>
            </div>
          </div>
        </div>

        <!-- Kolom Gambar -->
        <div class="col-lg-7 col-md-6 d-none d-md-block">
          <div class="position-relative h-100" style="background-image: url('{{ asset('assets/img/curved-images/paket.png') }}'); background-size: cover; background-position: center; height: 100vh;">
            <!-- Gambar di sisi kanan sepenuhnya -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
