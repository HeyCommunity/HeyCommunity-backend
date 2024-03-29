@section('AuthUserDropdownMenuItems')
  @if (Auth::check())
    <span class="dropdown-item">
    <small>{{ now()->meridiem() }}好,</small>
    <a target="_blank" href="{{ route('web.users.show', Auth::id()) }}">{{ Auth::user()->nickname }}</a>
  </span>
    <hr class="dropdown-divider">
    <form method="POST" action="{{ route('dashboard.auth.logout-handler') }}">
      {{ csrf_field() }}
      <button type="submit" class="dropdown-item">登出</button>
    </form>
  @endif
@endsection

<nav class="navbar navbar-vertical fixed-start navbar-expand-md navbar-light" id="sidebar">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"><span class="navbar-toggler-icon"></span></button>

    <!-- Brand -->
    <a class="navbar-brand text-center" href="{{ route('dashboard.index') }}">
      <span class="d-block text-primary fs-1 fw-bold">{{ config('app.name') }}</span>
      <span class="d-block text-muted fs-5 fw-light">管理后台</span>
    </a>

    <!-- User (xs) -->
    <div class="navbar-user d-md-none">
      <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
          <div class="avatar avatar-sm avatar-online">
            <img src="{{ asset(Auth::user()->avatar ?? 'images/heycommunity/logo.png') }}" class="avatar-img rounded-circle">
          </div>
        </a>

        <!-- Menu -->
        <div class="dropdown-menu dropdown-menu-end mt-2">
          @yield('AuthUserDropdownMenuItems')
        </div>
      </div>
    </div>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidebarCollapse">
      <!-- 主导航 -->
      @include('dashboard.layouts._navbar-menu')

      <!-- 导航底部管理员功能 -->
      <div class="mt-auto"></div>
      <div class="navbar-user d-none d-md-flex" id="sidebarUser">
        <a class="navbar-user-link" data-bs-toggle="tooltip" data-bs-placement="top" title="not available">
          <span class="icon active"><i class="fe fe-bell"></i></span>
        </a>

        <div class="dropup">
          <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
            <div class="avatar avatar-sm avatar-online">
              <img src="{{ asset(Auth::user()->avatar ?? 'images/heycommunity/logo.png') }}" class="avatar-img rounded-circle">
            </div>
          </a>

          <!-- Menu -->
          <div class="dropdown-menu">
            @yield('AuthUserDropdownMenuItems')
          </div>
        </div>

        <a class="navbar-user-link" data-bs-toggle="tooltip" data-bs-placement="top" title="not available">
          <span class="icon"><i class="fe fe-search"></i></span>
        </a>
      </div>
    </div>
  </div>
</nav>

