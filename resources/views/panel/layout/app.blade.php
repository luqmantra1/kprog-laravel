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
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .main {
    padding: 2rem;
  }

  .card {
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    background-color: #ffffff;
  }

  .card-header {
    background-color: #ffffff;
    border-bottom: 1px solid #eaeaea;
    padding: 1rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .btn-primary {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .btn-primary:hover {
    background: linear-gradient(to right, #5f0ec5, #1e62e1);
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

  /* Sidebar styles */
  .sidebar {
    background: #1e1e2f;
    color: #ffffff;
    min-height: 100vh;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
  }

  .sidebar .nav-title {
    font-size: 13px;
    color: #a0aec0;
    text-transform: uppercase;
    margin: 20px 20px 10px;
    font-weight: bold;
  }

  .sidebar-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #cbd5e0;
    font-size: 15px;
    border-radius: 8px;
    transition: all 0.2s;
    text-decoration: none;
  }

  .sidebar-link i {
    margin-right: 10px;
    font-size: 16px;
  }

  .sidebar-link:hover {
    background-color: #2d2d44;
    color: #ffffff;
  }

  .sidebar-link.active {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: white;
    font-weight: bold;
  }

  /* Smooth transitions for layout */
  .sidebar, .sidebar-link, .btn-primary {
    transition: all 0.3s ease-in-out;
  }

  /* Header fix if needed */
  header {
    background: #ffffff;
    border-bottom: 1px solid #eaeaea;
    padding: 1rem 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  /* Footer spacing */
  footer {
    padding: 1rem 2rem;
    background: #ffffff;
    border-top: 1px solid #eaeaea;
    text-align: center;
    color: #6c757d;
  }

</style>


  @yield('style')
</head>

@include('panel.layout.apptopstrip')
@include('panel.layout.sidebar')
<body>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    

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
