<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KPROG AI LABS</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/kproglogocut.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pb3H1rqZKe5w6n5jvX4hZ+TxMAlVQH2cg5A5L4kN5ztb+pVEmdDH4hA0QvxTGXvKcPtbd3Csl5bt1M7S7ZOH3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .main {
      padding: 2rem;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .card-header {
      background-color: #ffffff;
      border-bottom: 1px solid #eaeaea;
      padding: 1rem 1.5rem;
      font-weight: 600;
      font-size: 1.1rem;
    }
    .btn-primary {
      background-color: #4a00e0;
      border: none;
    }
    .btn-primary:hover {
      background-color: #3700b3;
    }
    table {
      margin-bottom: 0;
    }
    th, td {
      vertical-align: middle;
    }
    .table thead {
      background-color: #f1f3f5;
    }
    .sidebar {
      background-color: #212529;
    }
    .sidebar .nav-link.active {
      background-color: #343a40;
      color: #fff !important;
    }
  </style>

  @yield('style')
</head>

@include('panel.layout.apptopstrip')

<body>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('panel.layout.sidebar')

    <main id="main" class="main">
      @yield('content')
    </main>

  </div>

  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  
  @yield('script')

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

@include('panel.layout.footer')
</html>
