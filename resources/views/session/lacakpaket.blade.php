@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section style="min-height: 100vh;
                 background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.289)), url('{{ asset('assets/img/curved-images/ocean.jpg') }}');
                 background-size: cover;
                 background-position: center;
                 background-repeat: no-repeat;
                 padding: 3rem 0;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
          <!-- Search Card -->
          <div class="card card-plain mb-4">
            <div class="card-header pb-0 text-left bg-transparent">
              <h3 class="text-dark mb-2">Lacak Paket</h3>
              <p class="mb-0 text-secondary">Masukkan nomor resi atau nama pemilik untuk mencari data paket Anda.</p>
            </div>
            <div class="card-body">
              <form role="form" method="GET" action="{{ route('search.paket.lacak') }}" id="trackingForm">
                <label class="text-dark">Nomor Resi atau Nama Pemilik</label>
                <div class="row g-2">
                  <div class="col-md-9 col-12">
                    <input type="text" name="query" id="trackingQuery" class="form-control" placeholder="Masukkan nomor resi atau nama pemilik" aria-label="Nomor Resi atau Nama Pemilik" value="{{ request('query') }}" required>
                  </div>
                  <div class="col-md-3 col-12">
                    <button type="submit" class="btn btn-primary w-100">CARI</button>
                  </div>
                </div>
              </form>

              <!-- Example Tracking Numbers -->
              <div class="alert d-flex align-items-start" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); border-left: 4px solid #0284c7; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 0;">
                <i class="fas fa-lightbulb" style="color: #0284c7; font-size: 1.25rem; margin-right: 0.75rem; margin-top: 0.125rem;"></i>
                <div style="flex: 1;">
                  <p style="margin: 0; color: #075985; font-size: 0.8rem; font-weight: 600; line-height: 1.3; margin-bottom: 0.5rem;">
                    Try these example tracking numbers:
                  </p>
                  <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge" style="background: white; color: #0369a1; padding: 0.35rem 0.75rem; font-weight: 500; cursor: pointer; border: 1px solid #0284c7; font-size: 0.75rem;" onclick="fillTracking('JNE123456789001')" title="Click to use this number">
                      JNE123456789001
                    </span>
                    <span class="badge" style="background: white; color: #0369a1; padding: 0.35rem 0.75rem; font-weight: 500; cursor: pointer; border: 1px solid #0284c7; font-size: 0.75rem;" onclick="fillTracking('JNET987654321002')" title="Click to use this number">
                      JNET987654321002
                    </span>
                    <span class="badge" style="background: white; color: #0369a1; padding: 0.35rem 0.75rem; font-weight: 500; cursor: pointer; border: 1px solid #0284c7; font-size: 0.75rem;" onclick="fillTracking('POS456789123003')" title="Click to use this number">
                      POS456789123003
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Results Section -->
          @if(isset($results) && count($results) > 0)
            <div class="card">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Resi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pemilik</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ekspedisi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Tiba</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($results as $result)
                        <tr>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $result->no_resi }}</p>
                          </td>
                          <td>
                            <div class="d-flex flex-column">
                              <p class="text-xs font-weight-bold mb-0">{{ $result->nama_pemilik }}</p>
                              <p class="text-xxs text-secondary mb-0">{{ $result->no_hpPenerima }}</p>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ Str::limit($result->nama_produk, 20) }}</p>
                          </td>
                          <td>
                            <span class="badge badge-sm bg-gradient-info">{{ $result->ekspedisi ? $result->ekspedisi->nama_ekspedisi : 'N/A' }}</span>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($result->tgl_tiba)->format('d/m/Y') }}</p>
                          </td>
                          <td>
                            <span class="badge badge-sm {{ $result->lokasi === 'Pos Security' ? 'bg-gradient-warning' : 'bg-gradient-success' }}">
                              {{ $result->lokasi }}
                            </span>
                          </td>
                          <td>
                            <span class="badge badge-sm {{ $result->status === 'Belum Diterima' ? 'bg-gradient-danger' : 'bg-gradient-success' }}">
                              {{ $result->status }}
                            </span>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @elseif(isset($results) && count($results) === 0)
            <div class="card">
              <div class="card-body text-center py-5">
                <i class="fas fa-search fa-3x text-secondary mb-3"></i>
                <h5 class="text-secondary">Nomor resi tidak ditemukan</h5>
                <p class="text-muted">Silakan periksa kembali nomor resi atau nama pemilik yang Anda masukkan.</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
</main>

<script>
function fillTracking(trackingNumber) {
    // Fill the tracking input field
    const trackingInput = document.getElementById('trackingQuery');
    trackingInput.value = trackingNumber;

    // Add visual feedback - highlight the field briefly
    trackingInput.style.transition = 'all 0.3s ease';
    trackingInput.style.backgroundColor = '#e0f2fe';
    trackingInput.style.borderColor = '#0284c7';

    setTimeout(() => {
        trackingInput.style.backgroundColor = '';
        trackingInput.style.borderColor = '';
    }, 600);

    // Optional: Focus the input field
    trackingInput.focus();
}
</script>

@endsection
