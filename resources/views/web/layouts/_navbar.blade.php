<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <!-- Navbar Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Brand -->
    <a class="navbar-brand d-none d-lg-inline-block order-lg-first me-3" href="{{ route('web.home') }}">{{ config('app.name') }}</a>
    <span class="navbar-brand d-inline-block d-lg-none">@yield('pageTitle', config('app.name'))</span>

    <!-- Search Form -->
    <form class="form-inline me-4 d-none d-lg-flex">
      <div class="input-group input-group-rounded input-group-merge input-group-reverse">
        <input readonly type="search" class="form-control dropdown-toggle list-search" data-bs-toggle="dropdown" placeholder="Search not available">
        <div class="input-group-text"><i class="fe fe-search"></i></div>
      </div>
    </form>

    <!-- User Dropdown -->
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


    <!-- Nav Collapse -->
    <div class="collapse navbar-collapse me-lg-auto order-lg-first" id="navbar">
      <form class="mt-4 mb-3 d-md-none">
        <input readonly type="search" class="form-control form-control-rounded" placeholder="Search not available">
      </form>

      <!-- Navigation -->
      <ul class="navbar-nav me-lg-auto">
        <li class="nav-item d-lg-none"><a class="nav-link {{ routeActive('web.home') }}" href="{{ route('web.home') }}">{{ config('app.name') }}</a></li>
        <li class="nav-item"><a class="nav-link {{ routeActive('web.posts*') }}" href="{{ route('web.posts.index') }}">动态</a></li>
        <li class="nav-item"><a class="nav-link {{ routeActive('web.article*') }}" href="{{ route('web.articles.index') }}">文章</a></li>
        <li class="nav-item"><a class="nav-link {{ routeActive('web.activities*') }}" href="{{ route('web.activities.index') }}">活动</a></li>
      </ul>
    </div>
  </div>
</nav>

