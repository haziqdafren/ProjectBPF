<!DOCTYPE html>

<html lang="{{ (\Request::is('rtl') ? 'ar' : 'en') }}" dir="{{ \Request::is('rtl') ? 'rtl' : 'ltr' }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Soft UI Dashboard by Creative Tim</title>

  <!-- Fonts and Icons -->
  <title>
    Surpa
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
</head>

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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

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

  <!-- Github Buttons (Optional) -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- Soft UI Dashboard Scripts -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

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
