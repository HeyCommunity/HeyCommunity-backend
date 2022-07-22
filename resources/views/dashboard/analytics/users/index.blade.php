@extends('dashboard.layouts.default')

@section('mainBody')
<div class="header">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-end">
        <div class="col">
          <h6 class="header-pretitle">User Analytics</h6>
          <h1 class="header-title">用户数据分析</h1>
        </div>
        <div class="col-auto">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CARDS -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">用户增长和活跃趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            @foreach (\Illuminate\Support\Arr::pluck($userChartConfigure['datasets'], 'label') as $labelName)
              <li class="nav-item"><a class="nav-link active">{{ $labelName }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="chartCanvas" class="chart-canvas"></canvas></div>

          @section('pageScript')
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('chartCanvas'), {
                  type: 'line',
                  data: {!! json_encode($userChartConfigure) !!},
                });
              });
            </script>
          @append
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">近七天活跃用户</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            @foreach (range(0, 6) as $subDayNum)
              <li class="nav-item">
                <a class="nav-link {{ now()->subDays($subDayNum)->isToday() ? 'active' : '' }}" data-bs-toggle="tab"
                   href="#userActivePanel-{{ now()->subDays($subDayNum)->format('Y-m-d') }}">
                  {{ now()->subDays($subDayNum)->isToday() ? '今天' : now()->subDays($subDayNum)->format('m/d') }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="card-body tab-content p-0">
          @foreach ($user7DaysActiveData as $date => $userActiveData)
            <div id="userActivePanel-{{ $date }}"
                 class="tab-pane fade {{ \Illuminate\Support\Carbon::parse($date)->isToday() ? 'show active' : '' }}">
              {{-- TODO: 当前每天只显示 100 用户，需要支持分页 --}}
              @include('dashboard.analytics.users._active-user-table', ['result' => $userActiveData])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
