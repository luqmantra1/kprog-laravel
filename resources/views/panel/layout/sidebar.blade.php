<!-- Sidebar Start -->
<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
          <img src="{{ asset('assets/images/logos/kproglogo25.png') }}" alt="" style="height:100px; width:150px;" />

          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'dashboard') collapsed @endif"  href="{{ url('panel/dashboard') }}" aria-expanded="false">
                    <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                    <span class="hide-menu">Dashboard</span>
                </a>
                </li>
                <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Internal</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'client') collapsed @endif"  href="{{ url('panel/client') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Client</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'policy') collapsed @endif"  href="{{ url('panel/policy') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Policies</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'proposal') collapsed @endif"  href="{{ url('panel/proposal') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Proposal</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'quotation') collapsed @endif"  href="{{ url('panel/quotation') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Quotation</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'document') collapsed @endif"  href="{{ url('panel/document') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Documents</span>
                </a>
                </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear"  class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">System</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'user') collapsed @endif"  href="{{ url('panel/user') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">User</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg @if(Request::segment(2) != 'role') collapsed @endif"  href="{{ url('panel/role') }}" aria-expanded="false">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                    <span class="hide-menu">Role</span>
                </a>
                </li>
                
            <!-- <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
              href="{{ url('panel/user') }}" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:shield-user-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">User</span>
                </div>

              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
              href="{{ url('panel/role') }}" aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:shield-user-line-duotone" class=""></iconify-icon>
                  </span>
                  <span class="hide-menu">Role</span>
                </div>

              </a>
            </li>    -->
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->