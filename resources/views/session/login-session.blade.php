@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section
  class="min-vh-100 d-flex align-items-center justify-content-center"
  style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)), url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;">
          <!-- Kolom Kiri: Gambar Dekoratif -->
          <div class="col-md-6 d-none d-md-block">
            <div class="d-flex align-items-center justify-content-center h-100">
              <img src="{{ asset('assets/img/bg.png') }}" alt="Gambar Dekoratif" class="shadow-lg" style="width: 70%; height: auto;">
            </div>
          </div>

          <!-- Kolom Kanan: Form Login -->
          <div class="col-lg-5 col-md-6 mx-auto">
            <div class="card card-plain p-4" style="background: rgb(255, 255, 255); border-radius: 12px;">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang!</h3>
                <p class="mb-1 text-secondary">Silakan masuk untuk melanjutkan</p>
              </div>
              <div class="card-body">
                <form role="form" method="POST" action="/session">
                  @csrf
                  <!-- Input Email -->
                  <label for="email" class="form-label">Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control border border-info" name="email" id="email" placeholder="Email Anda">
                    @error('email')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>

                  <!-- Input Password -->
                  <label for="password" class="form-label">Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control border border-info" name="password" id="password" placeholder="Password Anda">
                    @error('password')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>

                  <!-- Checkbox Remember Me -->
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                  </div>

                  <!-- Tombol Login -->
                  <div class="text-center">
                    <button type="submit" class="btn btn-info w-100 mt-4 mb-0">Masuk</button>
                  </div>
                </form>
              </div>

              <!-- Footer Form -->
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Lupa Password?
                  <a href="/login/forgot-password" class="text-info font-weight-bold">Reset di sini</a>
                </small>
                <p class="mb-4 text-sm mx-auto">
                  Tidak punya akun?
                  <a href="register" class="text-info font-weight-bold">Daftar</a>
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>

@endsection
