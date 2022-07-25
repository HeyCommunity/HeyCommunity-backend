<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HEY社区</title>
  <meta name="description" content="HeyCommunity Dashboard" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/libs.bundle.css') }}" />

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme.bundle.css') }}" id="stylesheetLight" />
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme-dark.bundle.css') }}" id="stylesheetDark" />

  <style>body { display: none; }</style>
  <style rel="stylesheet">
    img {
      display: inline-block;
    }
  </style>

  <!-- 设置页面布局 -->
  <script>
    localStorage.setItem('dashkitShowPopover', 'false');
    localStorage.setItem('dashkitSidebarSize', 'base');
    localStorage.setItem('dashkitNavColor', 'default');
    localStorage.setItem('dashkitColorScheme', 'light');
    localStorage.setItem('dashkitNavPosition', 'sidenav');    // combo | sidenav | topnav
  </script>
</head>
<body>
  <!-- NAVIGATION -->
  <nav class="navbar navbar-vertical fixed-start navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"><span class="navbar-toggler-icon"></span></button>

      <!-- Brand -->
      <a class="navbar-brand text-center" href="{{ route('dashboard.index') }}">
        <span class="d-block text-primary fs-1 fw-bold">HEY社区</span>
        <span class="d-block text-muted fs-5 fw-light">管理后台</span>
      </a>

      <!-- User (xs) -->
      <div class="navbar-user d-md-none">
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown">
            <div class="avatar avatar-sm avatar-online">
              <img src="{{ asset('images/logo.png') }}" class="avatar-img rounded-circle">
            </div>
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-end">
            <a href="#" class="disabled dropdown-item">Profile</a>
            <a href="#" class="disabled dropdown-item">Settings</a>
            <hr class="dropdown-divider">
            <a href="#" class="disabled dropdown-item">Logout</a>
          </div>
        </div>
      </div>

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidebarCollapse">
        <!-- 主导航 -->
        @include('dashboard.layouts._navbar-main')

        <!-- 导航底部管理员功能 -->
        <div class="mt-auto"></div>
        <div class="navbar-user d-none d-md-flex" id="sidebarUser">
          <a class="navbar-user-link" data-bs-toggle="tooltip" data-bs-placement="top" title="not available">
              <span class="icon active"><i class="fe fe-bell"></i></span>
          </a>

          <div class="dropup">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
              <div class="avatar avatar-sm avatar-online">
                <img src="{{ asset('images/logo.png') }}" class="avatar-img rounded-circle">
              </div>
            </a>

            <div class="dropdown-menu">
              <a href="#" class="disabled dropdown-item">Profile</a>
              <a href="#" class="disabled dropdown-item">Settings</a>
              <hr class="dropdown-divider">
              <a href="#" class="disabled dropdown-item">Logout</a>
            </div>
          </div>

          <a class="navbar-user-link" data-bs-toggle="tooltip" data-bs-placement="top" title="not available">
            <span class="icon"><i class="fe fe-search"></i></span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  @yield('mainContent')

  <!-- JAVASCRIPT -->

  <!-- Vendor JS -->
  <script src="{{ asset('assets/dashkit/js/vendor.bundle.js') }}" defer></script>

  <!-- Theme JS -->
  <script src="{{ asset('assets/dashkit/js/theme.bundle.js') }}" defer></script>

  <!-- Page Script -->
  @yield('pageScript')
</body>
</html>
