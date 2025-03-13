<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/logo_ibam.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/logo_ibam.png') }}">
  <title>GCA IBAM - @yield('title')</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  {{-- lien des icones de fontawesome --}}
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (nécessaire pour le dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />


  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="g-sidenav-show bg-gray-100">

    @section('dashboard')
    @show

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('partials.navbar')

    @if(session('success'))
    <div id="alert-success" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div id="alert-error" class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

<script>
    setTimeout(() => {
        document.getElementById('alert-success')?.remove();
        document.getElementById('alert-error')?.remove();
    }, 1500); // Disparaît après 3 secondes
</script>

    @yield('content')






  </main>
  <!-- Core JS Files -->
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
  @yield('scripts')
</body>
</html>
