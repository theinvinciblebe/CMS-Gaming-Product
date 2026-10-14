@include("dashboard-layout.head")


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">



      <!-- Tailwind-style Light / Dark Mode Toggle Button -->
      <li class="nav-item d-flex align-items-center mx-2">
        <button id="cmsThemeToggle" type="button" class="tailwind-theme-toggle" onclick="toggleCmsTheme()" aria-label="Toggle Light and Dark Mode" title="Toggle Light / Dark mode">
          <span class="toggle-track">
            <span class="toggle-thumb">
              <i class="fas fa-sun icon-sun"></i>
              <i class="fas fa-moon icon-moon"></i>
            </span>
          </span>
          <span class="toggle-label d-none d-sm-inline" id="cmsThemeText">Dark</span>
        </button>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link d-flex align-items-center px-3" style="border-bottom: 1px solid rgba(255,255,255,0.08); background: rgba(0,0,0,0.25); text-decoration: none;">
      <div style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(99,102,241,0.45); margin-right: 12px; flex-shrink: 0;">
        <i class="fas fa-gamepad" style="color: white; font-size: 17px;"></i>
      </div>
      <div>
        <span class="brand-text font-weight-bold" style="color: #ffffff; font-size: 15px; letter-spacing: 0.5px; display: block; line-height: 1.2;">GAMING CMS V2</span>
        <span style="font-size: 10px; color: #818cf8; text-transform: uppercase; letter-spacing: 1.2px; font-weight: 600;">Control Studio</span>
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center" style="border-bottom: 1px solid rgba(255,255,255,0.06); padding: 0.5rem 0.8rem; background: rgba(255,255,255,0.02); border-radius: 12px;">
        <div class="image">
          <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #06b6d4, #3b82f6); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px; box-shadow: 0 0 12px rgba(6,182,212,0.3);">
            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
          </div>
        </div>
        <div class="info pl-3" style="line-height: 1.2;">
          <a href="{{ route('user.profile') }}" class="d-block" style="color: #e2e8f0; font-weight: 600; font-size: 13px; text-decoration: none;">
            <span style="background: linear-gradient(135deg, #6366f1, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ Auth::user()->name ?? 'Administrator' }}</span>
          </a>
          <span style="font-size: 11px; color: #10b981; display: inline-flex; align-items: center; gap: 4px; margin-top: 2px;">
            <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981; display: inline-block;"></span> Active Admin
          </span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user-management*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>User Management</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ route('sales.index') }}" class="nav-link {{ Request::is('sales-management*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Sales History <span class="badge badge-success right" style="background: linear-gradient(135deg, #10b981, #059669); font-weight: 700;">Orders</span></p>
            </a>
          </li>

           <li class="nav-item">
            <a href="/" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-external-link-alt"></i>
              <p>Live Website <span class="badge badge-info right">Visit</span></p>
            </a>
          </li>

            <div class="dropdown-divider" style="border-top-color: rgba(255,255,255,0.06); margin: 12px 8px;"></div>
            <li class="nav-item">
                <a href="/logout" class="nav-link logout-btn" style="color: #f87171 !important;">
                    <i class="fas fa-sign-out-alt nav-icon" aria-hidden="true"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      @yield('content')

      <!-- Include Toastr JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <!-- Include Global Toastr Notifications -->
      @include('dashboard-layout.toastr')

  </div>
</div>
<!-- ./wrapper -->

@include('dashboard-layout.foot')

