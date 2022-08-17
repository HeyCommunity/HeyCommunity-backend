@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Activities</h6>
            <h1 class="header-title">活动</h1>
          </div>
          <div class="col-auto">
            <a href="{{ route('dashboard.activities.create') }}" class="btn btn-primary lift">创建活动</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="table-responsive mb-0">
            <table class="table table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>标题</th>
                  <th>简介</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($activities as $activity)
                  <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->intro }}</td>
                    <td>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.activities.edit', $activity) }}">编辑</a>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.activities.show', $activity) }}">详情</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $activities->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
