<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KPROG AI LABS</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/Kproglogocut.png') }}"/>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
</head>

<body>
  <!-- Main Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
       data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Centered Container -->
    <div class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0 shadow-sm border-0">
              <div class="card-body">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="text-center d-block mb-3">
                  <img src="{{ asset('assets/images/logos/Kproglogo.png') }}" alt="Logo" class="img-fluid" width="150">
                </a>
                <p class="text-center text-muted mb-4">Please insert your credential</p>

                @if (session('message'))
    <div class="alert alert-warning text-center">
        {{ session('message') }}
    </div>
@endif


                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                @csrf

                  <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                  </div>

                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>

                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                      <label class="form-check-label" for="rememberMe">Remember this device</label>
                    </div>
                    <a class="text-primary fw-bold" href="">Forgot Password?</a>
                  </div>

                  <button type="submit" class="btn btn-primary w-100 py-2 fs-5">Sign In</button>

                  <div class="text-center mt-4">
                    <span class="fs-6 text-muted">New To Kprog ?</span>
                    <a class="text-primary fw-bold ms-2" href="">Create an account</a>
                  </div>
                </form>
                <!-- End Form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
