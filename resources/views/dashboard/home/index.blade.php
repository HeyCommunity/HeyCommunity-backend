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
              <h6 class="text-uppercase text-muted mb-2">点赞</h6>
              <span class="h2 mb-0">{{ $totalThumbUpNum }}</span>
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
        <div class="card-header">
          <h4 class="card-header-title">主要数据趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            @foreach (\Illuminate\Support\Arr::pluck($mainLineChartConfigure['data']['datasets'], 'label') as $labelName)
              <li class="nav-item"><a class="nav-link active">{{ $labelName }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="mainLineChartCanvas" class="chart-canvas"></canvas></div>

          @section('pageScript')
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('mainLineChartCanvas'), {!! json_encode($mainLineChartConfigure) !!});
              });
            </script>
          @append
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">点赞/评论趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            @foreach (\Illuminate\Support\Arr::pluck($thumbAndCommentLineChartConfigure['data']['datasets'], 'label') as $labelName)
              <li class="nav-item"><a class="nav-link active">{{ $labelName }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="thumbAndCommentLineChartCanvas" class="chart-canvas"></canvas></div>

          @section('pageScript')
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('thumbAndCommentLineChartCanvas'), {!! json_encode($thumbAndCommentLineChartConfigure) !!});
              });
            </script>
          @append
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
