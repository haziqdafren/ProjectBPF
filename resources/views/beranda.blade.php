@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        @foreach ([
            ['title' => 'Jumlah Data yang Masuk', 'value' => $jumlahDataMasuk],
            ['title' => 'Jumlah Paket pada Pos Security', 'value' => $jumlahDataMasukPosSecurity],
            ['title' => 'Jumlah Paket pada Rumah Tangga', 'value' => $jumlahDataMasukRumahTangga]
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

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kalender & Jam:</p>
                                <h5 class="font-weight-bolder mb-0" id="currentTime"></h5>
                                <p id="currentDate" class="text-muted"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin: 40px 0;"></div>

    <!-- Form Pencarian Nomor Resi -->
    <div class="container-fluid py-1 px-1">
        <div class="card p-1">
            <div class="card-body">
                <form action="{{ route('search.paket.data') }}" method="GET">
                    <label style="color: white;">Nomor Resi</label>
                    <div class="mb-3">
                        <input type="text" name="resi" id="resi" class="form-control" placeholder="Masukkan nomor resi atau nama pemilik" aria-label="Nomor Resi" aria-describedby="resi-addon" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-dark w-100 mt-4 mb-0">Cari Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Tabel Hasil Pencarian -->
   @if(isset($dataPaket) && $dataPaket->isNotEmpty())
   <div class="container-fluid py-1 px-1">
       <div class="card p-1">
           <div class="card-body">
               <table class="table align-items-center mb-0" id="resultTable">
                   <thead>
                       <tr>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemilik</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Ekspedisi</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP Penerima</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Tiba</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Security</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($dataPaket as $item)
                           <tr>
                               <td class="text-center">{{ $item->nama_pemilik }}</td>
                               <td class="text-center">{{ $item->no_resi }}</td>
                               <td class="text-center">{{ $item->nama_produk }}</td>
                               <td class="text-center">{{ $item->ekspedisi ? $item->ekspedisi->nama_ekspedisi : 'Tidak Diketahui' }}</td>
                               <td class="text-center">{{ $item->no_hpPenerima }}</td>
                               <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_tiba)->format('d/m/Y') }}</td>
                               <td class="text-center">{{ $item->lokasi }}</td>
                               <td class="text-center">{{ $item->security_name }}</td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
               <!-- Pagination links -->
               {{ $dataPaket->links() }}
           </div>
       </div>
   </div>
   @else
       @if(isset($dataPaket))
           <div class="alert alert-warning" role="alert">
               Data tidak ditemukan untuk pencarian Anda.
           </div>
       @endif
   @endif


</div>

@section('scripts')
<script>
    // Perbarui waktu dan tanggal setiap detik
    function updateDateTime() {
        const now = new Date();
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const currentDate = now.toLocaleDateString('id-ID', optionsDate);
        const currentTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        document.getElementById('currentDate').innerText = currentDate;
        document.getElementById('currentTime').innerText = currentTime;
    }
    setInterval(updateDateTime, 1000);
</script>
@endsection

@endsection
