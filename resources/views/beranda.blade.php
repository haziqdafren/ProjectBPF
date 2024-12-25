@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        @foreach ([
            ['title' => 'Jumlah Data yang Masuk', 'value' => 50],
            ['title' => 'Jumlah Paket pada Lokasi Security', 'value' => 20],
            ['title' => 'Jumlah Paket pada Lokasi Lab', 'value' => 30],
            ['title' => 'Jumlah Paket pada Lokasi Lab', 'value' => 30]
        ] as $card)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $card['title'] }} :</p>
                                <h5 class="font-weight-bolder mb-0">{{ $card['value'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin: 40px 0;"></div>

    <div class="container-fluid py-1 px-1">
        <div class="card p-1">
            <div class="card-body">
                <form role="form" method="GET" action="{{ url('search-paket') }}">
                    <label style="color: white;">Nomor Resi</label>
                    <div class="mb-3">
                        <input type="text" name="resi" class="form-control" placeholder="Masukkan nomor resi" aria-label="Nomor Resi" aria-describedby="resi-addon">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-100 mt-4 mb-0">Cari Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid py-1 px-1">
        <div class="card p-1">
            <div class="card-body p-1 d-flex justify-content-center align-items-center" style="height: 100px;">
                <a href="/Tambah-Paket" class="btn bg-gradient-dark btn-md w-100">Tambah Data Paket</a>
            </div>
        </div>
    </div>

    <div style="margin: 20px 0;"></div>

    <div class="container-fluid py-1 px-1">
        <div class="card p-1">
            <div class="card-body p-1 d-flex justify-content-center align-items-center" style="height: 100px;">
                <a href="/Edit_Paket" class="btn bg-gradient-dark btn-md w-100">Edit Data Paket</a>
            </div>
        </div>
    </div>
</div> --}}

@endsection
