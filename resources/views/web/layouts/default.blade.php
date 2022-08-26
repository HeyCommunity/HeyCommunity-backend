<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

  <title>{{ config('app.name') }}</title>
  <!-- TODO: Website description -->
  <meta name="description" content="{{ config('app.name') }}" />

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/libs.bundle.css') }}" />

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
          <input readonly type="search" class="form-control dropdown-toggle list-search" data-bs-toggle="dropdown" placeholder="Search not available">
          <div class="input-group-text"><i class="fe fe-search"></i></div>
        </div>
      </form>

      <!-- User -->
      <div class="navbar-user">
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown">
            @if (Auth::check())
              <div class="avatar avatar-sm avatar-online">
                <img src="{{ asset(Auth::user()->avatar) }}" class="avatar-img rounded-circle">
              </div>
            @else
              <div class="avatar avatar-sm avatar-offline">
                <img src="{{ asset('images/users/default-avatar.jpg') }}" class="avatar-img rounded-circle">
              </div>
            @endif
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-end mt-2">
            @if (Auth::check())
              <span class="dropdown-item">
                <small>{{ now()->meridiem() }}好,</small>
                <a href="{{ route('web.users.show', Auth::id()) }}">{{ Auth::user()->nickname }}</a>
              </span>
              <hr class="dropdown-divider">
              @if (in_array(Auth::id(), config('heycommunity.dashboard.admin_ids')))
                <a class="dropdown-item" href="{{ route('dashboard.index') }}">管理后台</a>
              @endif
              <form method="POST" action="{{ route('web.logout-handler') }}">
                {{ csrf_field() }}
                <button type="submit" class="dropdown-item">登出</button>
              </form>
            @else
              <a href="{{ route('web.login') }}" class="dropdown-item">登录</a>
            @endif
          </div>
        </div>
      </div>

      <!-- Collapse -->
      <div class="collapse navbar-collapse me-lg-auto order-lg-first" id="navbar">
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <input readonly type="search" class="form-control form-control-rounded" placeholder="Search not available">
        </form>

        <!-- Navigation -->
        <a class="navbar-brand me-3" href="{{ route('web.home') }}">{{ config('app.name') }}</a>
        <ul class="navbar-nav me-lg-auto">
          <li class="nav-item"><a class="nav-link {{ routeActive('web.posts*') }}" href="{{ route('web.posts.index') }}">动态</a></li>
          <li class="nav-item"><a class="nav-link {{ routeActive('web.article*') }}" href="{{ route('web.articles.index') }}">文章</a></li>
          <li class="nav-item"><a class="nav-link {{ routeActive('web.activities*') }}" href="{{ route('web.activities.index') }}">活动</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  @yield('mainContent')

  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/dashkit/js/vendor.bundle.js') }}" defer></script>
  <script src="{{ asset('assets/dashkit/js/theme.bundle.js') }}" defer></script>

  <!-- Laravel Flash -->
  {{-- @include('dashboard.layouts._flash') --}}

  <!-- Laravel Notify -->
  {{-- @include('dashboard.layouts._laravel-notify') --}}

  <!-- Google Analytics -->
  @include('common._google-analytics')

  <!-- Page Script -->
  @yield('pageScript')
</body>
</html>
