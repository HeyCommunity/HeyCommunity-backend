<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : null }}" href="{{ route('dashboard.index') }}"><i class="fe fe-home"></i> 仪表盘</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#sidebar-analytics" data-bs-toggle="collapse">
      <i class="fe fe-bar-chart-2"></i> 数据分析
    </a>
    <div class="collapse {{ request()->routeIs('dashboard.analytics.*') ? 'show' : '' }}" id="sidebar-analytics">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.analytics.users.index') ? 'active' : null }}" href="{{ route('dashboard.analytics.users.index') }}">用户数据分析</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.users.index') ? 'active' : null }}" href="{{ route('dashboard.users.index') }}"><i class="fe fe-users"></i> 用户</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.posts.index') ? 'active' : null }}" href="{{ route('dashboard.posts.index') }}"><i class="fe fe-rss"></i> 动态</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.comments.index') ? 'active' : null }}" href="{{ route('dashboard.comments.index') }}"><i class="fe fe-message-square"></i> 评论</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.thumbs.index') ? 'active' : null }}" href="{{ route('dashboard.thumbs.index') }}"><i class="fe fe-thumbs-up"></i> 点赞</a>
  </li>
</ul>

<!-- Divider -->
<hr class="navbar-divider my-3">

<!-- 其他 -->
<h6 class="navbar-heading">其他</h6>
<ul class="navbar-nav mb-md-4">
  <li class="nav-item d-md-none">
    <a class="nav-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasActivity" aria-contrtols="sidebarOffcanvasActivity">
      <span class="fe fe-bell"></span> Notifications
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" target="_blank" href="{{ url('/dashboard/telescope') }}"><i class="fe fe-cast"></i> Telescope</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" target="_blank" href="{{ url('/dashboard/logs') }}"><i class="fe fe-alert-octagon"></i> LogViewer</a>
  </li>
</ul>
