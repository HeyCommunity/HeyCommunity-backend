<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

  <title>HEY社区</title>
  <meta name="description" content="HeyCommunity Dashboard" />

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/libs.bundle.css') }}" />

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme.bundle.css') }}" id="stylesheetLight" />
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme-dark.bundle.css') }}" id="stylesheetDark" />

  <style></style>
  <style rel="stylesheet">
    body { display: none; }
    img { display: inline-block; }
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
  @include('dashboard.layouts._navbar')

  <!-- MAIN CONTENT -->
  @yield('mainContent')

  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/dashkit/js/vendor.bundle.js') }}" defer></script>     <!-- Vendor JS -->
  <script src="{{ asset('assets/dashkit/js/theme.bundle.js') }}" defer></script>      <!-- Theme JS -->
  <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- TODO: 优化引用 jquery -->

  <!-- Laravel Flash -->
  @include('dashboard.layouts._flash')

  <!-- Google Analytics -->
  @include('common._google-analytics')

  <!-- Page Script -->
  @yield('pageScript')
</body>
</html>
