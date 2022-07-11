@extends('dashboard.layouts.default')

@section('mainBody')
<div class="header">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-end">
        <div class="col">
          <h6 class="header-pretitle">overview</h6>
          <h1 class="header-title">仪表盘</h1>
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
    <div class="col-12 col-lg">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center gx-0">
            <div class="col">
              <h6 class="text-uppercase text-muted mb-2">用户</h6>
              <span class="h2 mb-0">{{ $totalUserNum }}</span>
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
              <h6 class="text-uppercase text-muted mb-2">评论</h6>
              <span class="h2 mb-0">{{ $totalCommentNum }}</span>
            </div>
            <div class="col-auto"><span class="h2 fe fe-message-square text-muted mb-0"></span></div>
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
            </div>
            <div class="col-auto"><span class="h2 fe fe-thumbs-up text-muted mb-0"></span></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">用户趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-bs-toggle="tab">新增</a></li>
            <li class="nav-item"><a class="nav-link disabled" href="#" data-bs-toggle="tab">活跃</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="canvas-userChart" class="chart-canvas"></canvas></div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">内容增长趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            <li class="nav-item"><a class="nav-link active">动态</a></li>
            <li class="nav-item"><a class="nav-link active">文章</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="canvas-contentChart" class="chart-canvas"></canvas></div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">评论/点赞增长趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            <li class="nav-item"><a class="nav-link active">评论</a></li>
            <li class="nav-item"><a class="nav-link active">点赞</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="canvas-commonChart" class="chart-canvas"></canvas></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('pageScript')
  <script>
    new Chart(document.getElementById('canvas-userChart'), {
      type: 'line',
      data: {!! json_encode($userChartConfigure) !!},
    });

    new Chart(document.getElementById('canvas-contentChart'), {
      type: 'line',
      data: {!! json_encode($contentChartConfigure) !!},
    });

    new Chart(document.getElementById('canvas-commonChart'), {
      type: 'line',
      data: {!! json_encode($commonChartConfigure) !!},
    });
  </script>
@endsection
