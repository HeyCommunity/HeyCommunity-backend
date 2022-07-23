<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name') }}</title>
  <!-- TODO: Website description -->
  <meta name="description" content="{{ config('app.name') }}" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme.bundle.css') }}" id="stylesheetLight" />
</head>

<body>
  <!-- NAVIGATION -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Form -->
      <form class="form-inline me-4 d-none d-lg-flex">
        <div class="input-group input-group-rounded input-group-merge input-group-reverse">
          <input type="search" class="form-control dropdown-toggle list-search" data-bs-toggle="dropdown" placeholder="Search not available">
          <div class="input-group-text"><i class="fe fe-search"></i></div>
        </div>
      </form>

      <!-- User -->
      <div class="navbar-user">
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown">
            <div class="avatar avatar-sm avatar-offline">
              <img src="{{ asset('images/users/default-avatar.jpg') }}" class="avatar-img rounded-circle">
            </div>
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-end mt-2">
            <a href="#" class="disabled dropdown-item">注册</a>
            <a href="#" class="disabled dropdown-item">登录</a>
            <hr class="dropdown-divider">
            <a href="#" class="disabled dropdown-item">暂不可用</a>
          </div>
        </div>
      </div>

      <!-- Collapse -->
      <div class="collapse navbar-collapse me-lg-auto order-lg-first" id="navbar">
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <input type="search" class="form-control form-control-rounded" placeholder="Search not available">
        </form>

        <!-- Navigation -->
        <a class="navbar-brand me-3" href="{{ route('web.home') }}">{{ config('app.name') }}</a>
        <ul class="navbar-nav me-lg-auto">
          <li class="nav-item"><a class="nav-link {{ routeActive('web.posts*') }}" href="{{ route('web.home') }}">动态</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  @yield('mainContent')

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/libs.bundle.css') }}" />

  <!-- Vendor JS -->
  <script src="{{ asset('assets/dashkit/js/vendor.bundle.js') }}" defer></script>

  <!-- Theme JS -->
  <script src="{{ asset('assets/dashkit/js/theme.bundle.js') }}" defer></script>

  <!-- Page Script -->
  @yield('pageScript')
</body>
</html>
