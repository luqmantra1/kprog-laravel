<!-- Sidebar Start -->
<aside class="left-sidebar bg-white shadow-sm">
  <!-- Sidebar scroll -->
  <div>
    <!-- Brand Logo -->
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ url('panel/dashboard') }}" class="logo-img">
        <img src="{{ asset('assets/images/logos/kproglogo25.png') }}" alt="Logo" style="height: 80px; width: 140px;" />
      </a>
      <div class="d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-5 text-dark"></i>
      </div>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      @php
        $PermissionUser = App\Models\PermissionRoleModel::getPermission('User', Auth::user()->role_id);
        $PermissionRole = App\Models\PermissionRoleModel::getPermission('Role', Auth::user()->role_id);
        $PermissionClient = App\Models\PermissionRoleModel::getPermission('Client', Auth::user()->role_id);
        $PermissionPolicy = App\Models\PermissionRoleModel::getPermission('Policy', Auth::user()->role_id);
        $PermissionProposal = App\Models\PermissionRoleModel::getPermission('Proposal', Auth::user()->role_id);
        $PermissionQuotation = App\Models\PermissionRoleModel::getPermission('Quotation', Auth::user()->role_id);
        $PermissionDocument = App\Models\PermissionRoleModel::getPermission('Document', Auth::user()->role_id);
        $PermissionSetting = App\Models\PermissionRoleModel::getPermission('Setting', Auth::user()->role_id);
      @endphp

      <ul id="sidebarnav" class="pt-3 px-2">

        <!-- Home Section -->
        <li class="nav-title text-uppercase text-muted mb-2 fw-semibold fs-xs">
          <iconify-icon icon="mdi:home-outline" class="me-2 text-secondary"></iconify-icon>
          Home
        </li>

        <li class="sidebar-item">
          <a href="{{ url('panel/dashboard') }}" class="sidebar-link @if(Request::segment(2) == 'dashboard') active @endif">
            <iconify-icon icon="mdi:view-dashboard-outline" class="me-2"></iconify-icon>
            Dashboard
          </a>
        </li>

        <!-- Internal Section -->
        @if(!empty($PermissionClient))
        <li class="nav-title text-uppercase text-muted mt-4 mb-2 fw-semibold fs-xs">
          <iconify-icon icon="mdi:domain" class="me-2 text-secondary"></iconify-icon>
          Internal
        </li>

        <li class="sidebar-item">
          <a href="{{ url('panel/client') }}" class="sidebar-link @if(Request::segment(2) == 'client') active @endif">
            <iconify-icon icon="mdi:account-multiple-outline" class="me-2"></iconify-icon>
            Client
          </a>
        </li>
        @endif

        @if(!empty($PermissionPolicy))
        <li class="sidebar-item">
          <a href="{{ url('panel/policy') }}" class="sidebar-link @if(Request::segment(2) == 'policy') active @endif">
            <iconify-icon icon="mdi:file-document-multiple-outline" class="me-2"></iconify-icon>
            Policies
          </a>
        </li>
        @endif

        @if(!empty($PermissionProposal))
        <li class="sidebar-item">
          <a href="{{ url('panel/proposal') }}" class="sidebar-link @if(Request::segment(2) == 'proposal') active @endif">
            <iconify-icon icon="mdi:lightbulb-outline" class="me-2"></iconify-icon>
            Proposal
          </a>
        </li>
        @endif

        @if(!empty($PermissionQuotation))
        <li class="sidebar-item">
          <a href="{{ url('panel/quotation') }}" class="sidebar-link @if(Request::segment(2) == 'quotation') active @endif">
            <iconify-icon icon="mdi:comment-quote-outline" class="me-2"></iconify-icon>
            Quotation
          </a>
        </li>
        @endif

        @if(!empty($PermissionDocument))
        <li class="sidebar-item">
          <a href="{{ url('panel/document') }}" class="sidebar-link @if(Request::segment(2) == 'document') active @endif">
            <iconify-icon icon="mdi:file-document-outline" class="me-2"></iconify-icon>
            Documents
          </a>
        </li>
        @endif

        <!-- System Section -->
        @if(!empty($PermissionUser))
        <li class="nav-title text-uppercase text-muted mt-4 mb-2 fw-semibold fs-xs">
          <iconify-icon icon="mdi:cog-outline" class="me-2 text-secondary"></iconify-icon>
          System
        </li>

        <li class="sidebar-item">
          <a href="{{ url('panel/user') }}" class="sidebar-link @if(Request::segment(2) == 'user') active @endif">
            <iconify-icon icon="mdi:account-outline" class="me-2"></iconify-icon>
            User
          </a>
        </li>
        @endif

        @if(!empty($PermissionRole))
        <li class="sidebar-item">
          <a href="{{ url('panel/role') }}" class="sidebar-link @if(Request::segment(2) == 'role') active @endif">
            <iconify-icon icon="mdi:account-cog-outline" class="me-2"></iconify-icon>
            Role
          </a>
        </li>
        @endif

        @if(!empty($PermissionSetting))
        <li class="sidebar-item">
          <a href="{{ url('panel/setting') }}" class="sidebar-link @if(Request::segment(2) == 'setting') active @endif">
            <iconify-icon icon="mdi:cog-outline" class="me-2"></iconify-icon>
            Setting
          </a>
        </li>
        @endif

      </ul>
    </nav>
  </div>
  <!-- End Sidebar scroll -->
</aside>
<!-- Sidebar End -->
