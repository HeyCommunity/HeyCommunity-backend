<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : null }}" href="{{ route('dashboard.index') }}"><i class="fe fe-home"></i> 仪表盘</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#sidebar-analytics" data-bs-toggle="collapse">
      <i class="fe fe-bar-chart-2"></i> 数据分析
    </a>
    <div class="collapse {{ request()->routeIs(['dashboard.analytics.*', 'dashboard.visitor-logs.*']) ? 'show' : '' }}" id="sidebar-analytics">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.analytics.increases') ? 'active' : null }}" href="{{ route('dashboard.analytics.increases') }}">数据增长明细</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.analytics.users') ? 'active' : null }}" href="{{ route('dashboard.analytics.users') }}">用户数据分析</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.visitor-logs.*') ? 'active' : null }}" href="{{ route('dashboard.visitor-logs.index') }}">访客日志</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#sidebar-banners" data-bs-toggle="collapse">
      <i class="fe fe-image"></i> 焦点图管理
    </a>
    <div class="collapse {{ request()->routeIs('dashboard.carousels.*') ? 'show' : '' }}" id="sidebar-banners">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.carousels.index') && request('type') === 'web' ? 'active' : null }}" href="{{ route('dashboard.carousels.index', ['type' => 'web']) }}">网站焦点图</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.carousels.index') && request('type') === 'wxapp' ? 'active' : null }}" href="{{ route('dashboard.carousels.index', ['type' => 'wxapp']) }}">小程序焦点图</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.users.*') ? 'active' : null }}" href="{{ route('dashboard.users.index') }}"><i class="fe fe-users"></i> 用户管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.posts.*') ? 'active' : null }}" href="{{ route('dashboard.posts.index') }}"><i class="fe fe-rss"></i> 动态管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#sidebar-articles" data-bs-toggle="collapse">
      <i class="fe fe-file-text"></i> 文章管理
    </a>
    <div id="sidebar-articles" class="collapse {{ request()->routeIs(['dashboard.article*']) ? 'show' : '' }}">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.articles.*') ? 'active' : null }}" href="{{ route('dashboard.articles.index') }}">文章列表</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.article-categories.*') ? 'active' : null }}" href="{{ route('dashboard.article-categories.index') }}">文章分类</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.article-tags.*') ? 'active' : null }}" href="{{ route('dashboard.article-tags.index') }}">文章标签</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.activities.*') ? 'active' : null }}" href="{{ route('dashboard.activities.index') }}"><i class="fe fe-flag"></i> 活动管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.comments.*') ? 'active' : null }}" href="{{ route('dashboard.comments.index') }}"><i class="fe fe-message-square"></i> 评论管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.thumbs.*') ? 'active' : null }}" href="{{ route('dashboard.thumbs.index') }}"><i class="fe fe-thumbs-up"></i> 点赞管理</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.user-reports.*') ? 'active' : null }}" href="{{ route('dashboard.user-reports.index') }}"><i class="fe fe-alert-octagon"></i> 用户报告</a>
  </li>
</ul>

<!-- Divider -->
<hr class="navbar-divider my-3">

<!-- 其他 -->
<h6 class="navbar-heading">其他</h6>
<ul class="navbar-nav mb-md-4">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.iframes.telescope') ? 'active' : '' }}"
       href="{{ route('dashboard.iframes.telescope') }}"><i class="fe fe-cast"></i> Telescope</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#sidebar-log-viewer" data-bs-toggle="collapse">
      <i class="fe fe-alert-octagon"></i> LogViewer
    </a>
    <div class="collapse {{ request()->is('*-log-viewer') ? 'show' : '' }}" id="sidebar-log-viewer">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('*laravel-log-viewer') ? 'active' : null }}" href="{{ url('dashboard/iframes/laravel-log-viewer') }}">Laravel Logs</a>
          <a class="nav-link {{ request()->is('*heycommunity-log-viewer') ? 'active' : null }}" href="{{ url('dashboard/iframes/heycommunity-log-viewer') }}">HeyCommunity Logs</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" target="_blank" href="{{ route('web.home') }}"><i class="fe fe-home"></i> {{ config('app.name') }}</a>
  </li>
</ul>
