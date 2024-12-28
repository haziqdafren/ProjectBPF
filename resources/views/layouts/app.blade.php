<!DOCTYPE html>
<html lang="{{ (\Request::is('rtl') ? 'ar' : 'en') }}" dir="{{ \Request::is('rtl') ? 'rtl' : 'ltr' }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/logo.png') }}">
  <title>Surpa</title>

  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <!-- Custom CSS -->
    <style>
        #dateTimeWidget {
            font-size: 1 rem;
            font-weight: bold;
            color: #333;
        }
      </style>

</head>

@yield('scripts')
@stack('scripts')

<body class="g-sidenav-show bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }}" data-theme="light-blue">

  <!-- Authentication Blade Sections -->
  @auth
    @yield('auth')
  @endauth

  @guest
    @yield('guest')
  @endguest

  <!-- Success Message (if any) -->
  @if(session()->has('success'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success') }}</p>
    </div>
  @endif

  <!-- Core JS Files -->
  {{-- <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


  <!-- Custom JS (Optional for additional functionality) -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      };
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

<script>
    window.onload = function () {
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const currentDate = now.toLocaleDateString('id-ID', optionsDate);
            const currentTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('currentDate').innerText = currentDate;
            document.getElementById('currentTime').innerText = currentTime;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    };
  </script>




  <!-- Github Buttons (Optional) -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- Soft UI Dashboard Scripts -->
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

  @push('dashboard')
    <script>
      document.getElementById('theme-toggle').addEventListener('click', function() {
          const body = document.body;
          // Toggle between light and dark themes
          if (body.getAttribute('data-theme') === 'light-blue') {
              body.setAttribute('data-theme', 'dark-blue');
          } else {
              body.setAttribute('data-theme', 'light-blue');
          }
      });
    </script>
  @endpush

</body>

</html>
