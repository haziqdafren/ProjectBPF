@extends('layouts.user_type.guest')

@section('content')

<section
    class="min-vh-100 d-flex align-items-center justify-content-center"
    style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)), url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Bagian Kiri -->
            <div class="col-lg-6 text-center text-lg-start">
                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <h1 class="text-white mb-3">Selamat Datang!</h1>
                    <p class="text-lead text-white mb-4">Silahkan melakukan registrasi terlebih dahulu.</p>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="col-lg-6">
                <div class="card z-index-0 shadow-lg">
                    <div class="card-header text-center pt-4">
                        <h5>Register</h5>
                    </div>
                    <div class="card-body">
                        <!-- Demo Mode Warning -->
                        <div class="alert d-flex align-items-center"
                             style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                                    border-left: 4px solid #f59e0b;
                                    padding: 0.75rem 1rem;
                                    border-radius: 0.5rem;
                                    margin-bottom: 1rem;">
                          <div style="display: flex; align-items-center; gap: 0.5rem;">
                            <i class="fas fa-exclamation-triangle" style="color: #f59e0b; font-size: 1.25rem;"></i>
                            <div>
                              <p style="margin: 0; color: #92400e; font-size: 0.8rem; font-weight: 600; line-height: 1.2;">
                                Registration Disabled
                              </p>
                              <p style="margin: 0; color: #b45309; font-size: 0.7rem; line-height: 1.2;">
                                Use demo account: demo@surpa.com / demo123
                              </p>
                            </div>
                          </div>
                        </div>

                        <form role="form text-left" method="POST" action="/register" id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                                @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check text-left">
                                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya menyetujui <a href="javascript:;" class="text-primary font-weight-bolder">Syarat dan Ketentuan</a>
                                </label>
                                @error('agreement')
                                    <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 my-4 mb-2">SIGN UP</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Sudah memiliki akun? <a href="login" class="text-dark font-weight-bolder">Masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Prevent registration and show demo popup
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            Swal.fire({
                title: 'Registration Not Available',
                html: `
                    <div style="text-align: left;">
                        <p style="font-size: 1rem; margin-bottom: 1rem; color: #64748b;">
                            Registration is disabled for demo purposes.
                        </p>
                        <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #f59e0b;">
                            <p style="font-size: 0.95rem; color: #92400e; margin: 0; font-weight: 500;">
                                <i class="fas fa-lock me-2"></i>
                                Please use the demo account to explore the system
                            </p>
                        </div>
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 0.5rem; margin-top: 1rem;">
                            <p style="font-size: 0.875rem; color: #64748b; margin: 0;">
                                <strong>Demo Account</strong><br>
                                Email: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo@surpa.com</code><br>
                                Password: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo123</code>
                            </p>
                        </div>
                        <div style="margin-top: 1rem; text-align: center;">
                            <a href="/login" class="btn btn-primary" style="text-decoration: none;">
                                Go to Login
                            </a>
                        </div>
                    </div>
                `,
                icon: 'warning',
                showConfirmButton: false,
                showCloseButton: true,
                width: '32rem',
                customClass: {
                    popup: 'swal-demo-popup',
                    closeButton: 'swal-close-button'
                }
            });

            return false;
        });
    }
});
</script>

@endsection
