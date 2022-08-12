@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header bg-dark pb-5">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle text-secondary">Dashbaord</h6>

            <h1 class="header-title text-white">仪表盘</h1>
          </div>
          <div class="col-auto">
            <ul class="nav nav-tabs header-tabs">
              <li class="nav-item">
                <a href="{{ route('dashboard.analytics.increases') }}" class="nav-link text-center">
                  <h6 class="header-pretitle text-secondary">&nbsp;</h6>
                  <h3 class="text-white mb-0">数据增长明细</h3>
                </a>
              </li>

              <li class="nav-item" onclick="showMainLineChartDatasets([0, 1])">
                <a href="#" class="nav-link text-center active" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    +{{ collect($mainLineChartConfigure['data']['datasets'][0]['data'])->sum() }}
                    / {{ collect($mainLineChartConfigure['data']['datasets'][1]['data'])->sum() }}
                  </h6>
                  <h3 class="text-white mb-0">用户趋势</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainLineChartDatasets([2])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  @if (($visitorLogNum = collect($mainLineChartConfigure['data']['datasets'][2]['data'])->sum()) < 1000)
                    <h6 class="header-pretitle text-secondary">{{ $visitorLogNum }}</h6>
                  @else
                    <h6 class="header-pretitle text-secondary">{{ round($visitorLogNum / 1000, 1) }}k</h6>
                  @endif
                  <h3 class="text-white mb-0">请求数</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainLineChartDatasets([3])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">{{ collect($mainLineChartConfigure['data']['datasets'][3]['data'])->sum() }}</h6>
                  <h3 class="text-white mb-0">动态</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainLineChartDatasets([4, 5])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    {{ collect($mainLineChartConfigure['data']['datasets'][4]['data'])->sum() }}
                    / {{ collect($mainLineChartConfigure['data']['datasets'][5]['data'])->sum() }}
                  </h6>
                  <h3 class="text-white mb-0">点赞/评论</h3>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="header-footer">
        <div class="chart">
          <canvas id="mainLineChart" class="chart-canvas"></canvas>

          @section('pageScript')
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('mainLineChart'), {!! json_encode($mainLineChartConfigure) !!});
              });

              function showMainLineChartDatasets(datasets) {
                let mainLineChart = Chart.getChart(document.getElementById('mainLineChart'));

                mainLineChart.data.datasets.forEach(function(dataset, index) {
                  dataset.hidden = true;

                  if (datasets.includes(index)) dataset.hidden = false;
                });

                mainLineChart.update();
              }
            </script>
          @append
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-n6">
    <div class="row">
      <div class="col-12 col-xl-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">周活用户</h4>
            <span class="text-muted me-3">新用户:</span>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="cardToggle" data-toggle="chart" data-target="#ordersChart" data-trigger="change" data-action="add" data-dataset="1" />
              <label class="form-check-label" for="cardToggle"></label>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="ordersChart" class="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">访客请求</h4>
            <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
              <li class="nav-item" data-toggle="chart" data-target="#trafficChart" data-trigger="click" data-action="toggle" data-dataset="0">
                <a href="#" class="nav-link active" data-bs-toggle="tab">全部</a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#trafficChart" data-trigger="click" data-action="toggle" data-dataset="1">
                <a href="#" class="nav-link" data-bs-toggle="tab">仅用户</a>
              </li>
            </ul>
          </div>

          <div class="card-body">
            <div class="chart chart-appended">
              <canvas id="trafficChart" class="chart-canvas" data-toggle="legend" data-target="#trafficChartLegend"></canvas>
            </div>
            <div id="trafficChartLegend" class="chart-legend"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">
                <h6 class="text-uppercase text-muted mb-2">用户</h6>
                <span class="h2 mb-0">{{ $totalUserNum }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +1 / +123
                </span>
              </div>
              <div class="col-auto"><span class="h2 fe fe-users text-muted mb-0"></span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">
                <h6 class="text-uppercase text-muted mb-2">动态</h6>
                <span class="h2 mb-0">{{ $totalPostNum }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +1 / +123
                </span>
              </div>
              <div class="col-auto"><span class="h2 fe fe-rss text-muted mb-0"></span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">
                <h6 class="text-uppercase text-muted mb-2">点赞</h6>
                <span class="h2 mb-0">{{ $totalThumbUpNum }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +1 / +123
                </span>
              </div>
              <div class="col-auto"><span class="h2 fe fe-thumbs-up text-muted mb-0"></span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">
                <h6 class="text-uppercase text-muted mb-2">评论</h6>
                <span class="h2 mb-0">{{ $totalCommentNum }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +1 / +123
                </span>
              </div>
              <div class="col-auto"><span class="h2 fe fe-message-square text-muted mb-0"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-grid">
              <a class="btn btn-light" href="{{ route('dashboard.analytics.increases') }}">查看数据增长明细</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
