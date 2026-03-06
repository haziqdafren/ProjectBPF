@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section style="min-height: 100vh;
                 background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)), url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
                 background-size: cover;
                 background-position: center;
                 background-repeat: no-repeat;
                 padding: 5rem 0 2rem 0;
                 display: flex;
                 align-items: center;">

    <div class="container">
      <div class="row align-items-center g-4">
        <!-- Kolom Form Sign-in -->
        <div class="col-lg-5 col-md-12 d-flex">
          <div class="card card-plain w-100 my-auto">
            <div class="card-header pb-0 text-left bg-transparent">
              <h3 class="text-dark">Mari Lacak Paketmu!</h3>
              <p class="mb-0 text-secondary">Buat Akun Baru atau Masuk dengan Otoritas berikut:</p>
            </div>
            <div class="card-body">
              <!-- Demo Credentials Info - Compact with Click to Fill -->
              <div class="alert d-flex align-items-center justify-content-between"
                   style="background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
                          border-left: 4px solid #667eea;
                          padding: 0.75rem 1rem;
                          border-radius: 0.5rem;
                          margin-bottom: 1rem;
                          cursor: pointer;"
                   onclick="fillDemoCredentials()"
                   title="Click to autofill demo credentials">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                  <i class="fas fa-user-circle" style="color: #667eea; font-size: 1.25rem;"></i>
                  <div>
                    <p style="margin: 0; color: #3730a3; font-size: 0.8rem; font-weight: 600; line-height: 1.2;">
                      Demo Account
                    </p>
                    <p style="margin: 0; color: #4338ca; font-size: 0.7rem; line-height: 1.2;">
                      demo@surpa.com / demo123
                    </p>
                  </div>
                </div>
                <i class="fas fa-chevron-right" style="color: #667eea; font-size: 0.875rem;"></i>
              </div>

              <form role="form" method="POST" action="/session" id="loginForm">
                @csrf
                <label for="email" class="text-dark">Email</label>
                <div class="mb-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required>
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <label for="password" class="text-dark">Password</label>
                <div class="mb-3">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                  <label class="form-check-label text-dark" for="rememberMe">Ingat saya</label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">MASUK</button>
                </div>
              </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
              <p class="mb-4 text-sm mx-auto text-dark">
                <strong>Tidak Punya akun?</strong>
                <a href="register" class="text-primary"><strong>Daftar</strong></a>
              </p>
            </div>
          </div>
        </div>

        <!-- Kolom Gambar -->
        <div class="col-lg-7 col-md-12 d-none d-lg-flex align-items-center justify-content-center">
          <div class="curved-image w-100"
               style="border-radius: 2rem;
                      background-image: url('{{ asset('assets/img/curved-images/bg.png') }}');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;
                      min-height: 500px;
                      max-height: 70vh;">
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<style>
/* Responsive padding adjustments for navbar clearance */
@media (max-width: 768px) {
    section {
        padding: 4rem 0 2rem 0 !important;
    }
}

@media (max-width: 576px) {
    section {
        padding: 3rem 0 2rem 0 !important;
    }
}
</style>

<script>
function fillDemoCredentials() {
    // Fill email and password fields
    document.getElementById('email').value = 'demo@surpa.com';
    document.getElementById('password').value = 'demo123';

    // Add visual feedback - highlight the fields briefly
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');

    emailField.style.transition = 'all 0.3s ease';
    passwordField.style.transition = 'all 0.3s ease';

    emailField.style.backgroundColor = '#e0e7ff';
    passwordField.style.backgroundColor = '#e0e7ff';

    setTimeout(() => {
        emailField.style.backgroundColor = '';
        passwordField.style.backgroundColor = '';
    }, 600);
}
</script>

@endsection
