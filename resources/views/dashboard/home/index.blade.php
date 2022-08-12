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
              <li class="nav-item" onclick="showMainChartDatasets([0, 1])">
                <a href="#" class="nav-link text-center active" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    +{{ collect($mainChartConfigure['data']['datasets'][0]['data'])->sum() }}
                    / {{ collect($mainChartConfigure['data']['datasets'][1]['data'])->sum() }}
                  </h6>
                  <h3 class="text-white mb-0">用户趋势</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainChartDatasets([2])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  @if (($visitorLogNum = collect($mainChartConfigure['data']['datasets'][2]['data'])->sum()) < 1000)
                    <h6 class="header-pretitle text-secondary">{{ $visitorLogNum }}</h6>
                  @else
                    <h6 class="header-pretitle text-secondary">{{ round($visitorLogNum / 1000, 1) }}k</h6>
                  @endif
                  <h3 class="text-white mb-0">请求数</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainChartDatasets([3])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">{{ collect($mainChartConfigure['data']['datasets'][3]['data'])->sum() }}</h6>
                  <h3 class="text-white mb-0">动态</h3>
                </a>
              </li>
              <li class="nav-item" onclick="showMainChartDatasets([4, 5])">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    {{ collect($mainChartConfigure['data']['datasets'][4]['data'])->sum() }}
                    / {{ collect($mainChartConfigure['data']['datasets'][5]['data'])->sum() }}
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
          <canvas id="mainChart" class="chart-canvas"></canvas>

          @section('pageScript')
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('mainChart'), {!! json_encode($mainChartConfigure) !!});
              });

              function showMainChartDatasets(datasets) {
                let mainChart = Chart.getChart(document.getElementById('mainChart'));

                mainChart.data.datasets.forEach(function(dataset, index) {
                  dataset.hidden = true;

                  if (datasets.includes(index)) dataset.hidden = false;
                });

                mainChart.update();
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
              <input class="form-check-input" type="checkbox" onchange="toggleChartDatasets('#userWeekActiveChart', [1])">
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="userWeekActiveChart" class="chart-canvas"></canvas>

              @section('pageScript')
                <script>
                  document.addEventListener('DOMContentLoaded', function () {
                    new Chart(document.getElementById('userWeekActiveChart'), {!! json_encode($userWeekActiveConfigure) !!});
                  });

                  function toggleChartDatasets(selector, datasets) {
                    let thisChart = Chart.getChart(document.getElementById(selector.substring(1)));

                    datasets.forEach(function(datasetIndex) {
                      thisChart.data.datasets[datasetIndex].hidden = ! thisChart.data.datasets[datasetIndex].hidden;
                    });

                    thisChart.update();
                  }
                </script>
              @append
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">访客请求 <small class="text-muted ms-1">近 1 个月</small></h4>
            <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
              <li class="nav-item" onclick="showChartDatasets('#visitorLogChart', [0])">
                <a href="#" class="nav-link active" data-bs-toggle="tab">全部</a>
              </li>
              <li class="nav-item" onclick="showChartDatasets('#visitorLogChart', [1])">
                <a href="#" class="nav-link" data-bs-toggle="tab">仅用户</a>
              </li>
            </ul>
          </div>

          <div class="card-body">
            <div class="chart chart-appended">
              <canvas id="visitorLogChart" class="chart-canvas" data-toggle="legend" data-target="#visitorLogChartLegend"></canvas>
            </div>
            <div id="visitorLogChartLegend" class="chart-legend"></div>

            @section('pageScript')
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  new Chart(document.getElementById('visitorLogChart'), {!! json_encode($visitorLogChartConfigure) !!});
                });

                function showChartDatasets(selector, datasets) {
                  let thisChart = Chart.getChart(document.getElementById(selector.substring(1)));

                  thisChart.data.datasets.forEach(function(dataset, index) {
                    dataset.hidden = true;

                    if (datasets.includes(index)) dataset.hidden = false;
                  });

                  thisChart.update();
                }
              </script>
            @append
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
                <span class="h2 mb-0">{{ $modelTrendData['user']['total'] }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +{{ $modelTrendData['user']['week_num'] }} / +{{ $modelTrendData['user']['month_num'] }}
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
                <span class="h2 mb-0">{{ $modelTrendData['post']['total'] }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +{{ $modelTrendData['post']['week_num'] }} / +{{ $modelTrendData['post']['month_num'] }}
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
                <span class="h2 mb-0">{{ $modelTrendData['thumb_up']['total'] }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +{{ $modelTrendData['thumb_up']['week_num'] }} / +{{ $modelTrendData['thumb_up']['month_num'] }}
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
                <span class="h2 mb-0">{{ $modelTrendData['comment']['total'] }}</span>
                <span class="mt-n1 badge bg-light-soft text-secondary">
                  +{{ $modelTrendData['comment']['week_num'] }} / +{{ $modelTrendData['comment']['month_num'] }}
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
              <a class="btn btn-light" target="_blank" href="{{ route('dashboard.analytics.increases') }}">查看数据增长明细</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
