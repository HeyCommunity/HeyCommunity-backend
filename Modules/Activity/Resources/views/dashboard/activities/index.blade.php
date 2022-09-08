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
            <a href="{{ route('dashboard.activities.create') }}" class="btn btn-primary lift"><i class="fe fe-plus-circle"></i> 创建活动</a>
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
                  <th>用户</th>
                  <th>封面</th>
                  <th>标题</th>
                  <th>开始时间</th>
                  <th>价格</th>
                  <th>报名</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($activities as $activity)
                  <tr>
                    <td>{{ $activity->id }}</td>
                    <td>
                      <a href="{{ route('dashboard.users.show', $activity->user) }}" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($activity->user->avatar) }}" alt="{{ $activity->user->nickname }}" class="avatar-img rounded-circle">
                      </a>
                      <a class="text-black" href="{{ route('dashboard.users.show', $activity->user) }}">{{ $activity->user->nickname ?: 'NULL' }}</a>
                    </td>
                    <td>
                      <a target="_blank" href="{{ $activity->cover }}">
                        <img src="{{ asset($activity->cover) }}" style="height:40px;">
                      </a>
                    </td>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->started_at }}</td>
                    <td>{{ $activity->price }}</td>
                    <td>{{ $activity->member_num }} / {{ $activity->total_ticket_num }}</td>
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
