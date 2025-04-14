<!-- Header Start -->
<header class="app-header shadow-sm bg-white">
  <nav class="navbar navbar-expand-lg navbar-light px-4 py-2">
    <!-- Left Side (Toggle + Notifications) -->
    <ul class="navbar-nav align-items-center">
      <!-- Sidebar Toggle -->
      <li class="nav-item d-xl-none">
        <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2 fs-4 text-dark"></i>
        </a>
      </li>

      <!-- Notification Bell -->
      <!-- <li class="nav-item dropdown ms-3 position-relative">
        <a class="nav-link" href="#" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="position-relative">
            <iconify-icon icon="solar:bell-linear" class="fs-5 text-dark"></iconify-icon>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"
              style="width: 10px; height: 10px; padding: 0; border: 1.5px solid white;"></span>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="notificationsDropdown">
          <li class="dropdown-header fw-semibold px-3">Notifications</li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">New submission received</a></li>
          <li><a class="dropdown-item" href="#">Task approved</a></li>
        </ul>
      </li> -->
    </ul>

    <!-- Right Side (Profile) -->
    <div class="navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <!-- User Profile -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/images/profile/user1.jpg') }}" alt="user"
              class="rounded-circle" width="35" height="35">
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up shadow-sm" aria-labelledby="profileDropdown">
            <li class="dropdown-header fw-semibold text-dark px-3">Welcome, {{ Auth::user()->name ?? 'User' }}</li>
            <!-- <li><hr class="dropdown-divider"></li> -->
            <!-- <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="ti ti-user fs-5 text-muted"></i> My Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="ti ti-mail fs-5 text-muted"></i> My Account
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="ti ti-list-check fs-5 text-muted"></i> My Tasks
              </a>
            </li> -->
            <!-- <li><hr class="dropdown-divider"></li> -->
            <li>
              <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="{{ url('logout') }}">
                <i class="ti ti-logout fs-5"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Header End -->
