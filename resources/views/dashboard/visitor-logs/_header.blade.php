<div class="header">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-end">
        <div class="col">
          <h6 class="header-pretitle">Visitor Log</h6>
          <h1 class="header-title">访客日志</h1>
        </div>

        <div class="col-auto">
          <a class="btn btn-light" href="{{ route('dashboard.visitor-logs.date', ['date' => \Illuminate\Support\Carbon::parse(request()->get('date'))->addDay()->format('Y-m-d')]) }}">
            <i class="fe fe-chevron-left"></i>
            {{ \Illuminate\Support\Carbon::parse(request()->get('date'))->addDay()->format('m/d') }}
          </a>
          <a class="btn btn-light" href="{{ route('dashboard.visitor-logs.date', ['date' => \Illuminate\Support\Carbon::parse(request()->get('date'))->subDay()->format('Y-m-d')]) }}">
            {{ \Illuminate\Support\Carbon::parse(request()->get('date'))->subDay()->format('m/d') }}
            <i class="fe fe-chevron-right"></i>
          </a>
          <button disabled type="button" class="btn btn-light"><i class="fe fe-calendar"></i> 选择日期</button>
        </div>
      </div>

      <div class="row align-items-center">
        <div class="col">
          <ul class="nav nav-tabs nav-overflow header-tabs">
            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.index') }}"
                 class="nav-link {{ request()->routeIs('*.index') ? 'active' : '' }}">全部</a>
            </li>

            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.date', ['date' => now()->format('Y-m-d')]) }}"
                 class="nav-link {{ request()->get('date') === now()->format('Y-m-d') ? 'active' : '' }}">{{ now()->format('m/d') }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.date', ['date' => now()->subDays(1)->format('Y-m-d')]) }}"
                 class="nav-link {{ request()->get('date') === now()->subDays(1)->format('Y-m-d') ? 'active' : '' }}">{{ now()->subDays(1)->format('m/d') }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.date', ['date' => now()->subDays(2)->format('Y-m-d')]) }}"
                 class="nav-link {{ request()->get('date') === now()->subDays(2)->format('Y-m-d') ? 'active' : '' }}">{{ now()->subDays(2)->format('m/d') }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.date', ['date' => now()->subDays(3)->format('Y-m-d')]) }}"
                 class="nav-link {{ request()->get('date') === now()->subDays(3)->format('Y-m-d') ? 'active' : '' }}">{{ now()->subDays(3)->format('m/d') }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dashboard.visitor-logs.date', ['date' => now()->subDays(4)->format('Y-m-d')]) }}"
                 class="nav-link {{ request()->get('date') === now()->subDays(4)->format('Y-m-d') ? 'active' : '' }}">{{ now()->subDays(4)->format('m/d') }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
