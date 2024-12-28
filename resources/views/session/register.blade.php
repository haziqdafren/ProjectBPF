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
                        <form role="form text-left" method="POST" action="/register">
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
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya menyetujui <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan Ketentuan</a>
                                </label>
                                @error('agreement')
                                    <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Sudah memiliki akun? <a href="login" class="text-dark font-weight-bolder">Masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
