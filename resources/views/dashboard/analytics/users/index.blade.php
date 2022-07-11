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
    <div class="col-12 col-lg-6 col-xl">
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title">用户趋势</h4>
          <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-bs-toggle="tab">新增</a></li>
            <li class="nav-item"><a class="nav-link disabled" href="#" data-bs-toggle="tab">活跃</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="chart"><canvas id="userChart" class="chart-canvas"></canvas></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('pageScript')
<script>
  window.onload = function() {
    const userChartCanvas = document.getElementById('userChart');
    new Chart(userChartCanvas, {
      type: 'line',
      data: {!! json_encode($chartData) !!},
    });
  }
</script>
@endsection
