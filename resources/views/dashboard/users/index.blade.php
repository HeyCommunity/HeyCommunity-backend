@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Users</h6>
            <h1 class="header-title">用户</h1>
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
                  <th>昵称</th>
                  <th>动态</th>
                  <th>点赞/评论</th>
                  <th>活跃天数</th>
                  @include('dashboard.layouts.utils._table-sort-th', ['name' => '最近活跃', 'orderBy' => 'last_active_at'])
                  @include('dashboard.layouts.utils._table-sort-th', ['name' => '注册时间', 'orderBy' => 'created_at'])
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                      @if ($user->avatar)
                        <a href="{{ route('dashboard.users.show', $user) }}" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($user->avatar) }}" alt="{{ $user->app_id }}" class="avatar-img rounded-circle">
                        </a>
                      @endif
                      <a class="text-black" href="{{ route('dashboard.users.show', $user) }}">{{ $user->nickname ?: 'NULL' }}</a>
                    </td>
                    <td>{{ $user->post_num }}</td>
                    <td>{{ $user->thumb_up_num }} / {{ $user->comment_num }}</td>
                    <td>{{ $user->active_day_num }}</td>
                    @if (empty($user->last_active_at))
                      <td>-</td>
                    @else
                      <td><span data-bs-toggle="tooltip" title="{{ $user->last_active_at->diffForHumans() }}">{{ $user->last_active_at }}</span></td>
                    @endif
                    <td><span data-bs-toggle="tooltip" title="{{ $user->created_at->diffForHumans() }}">{{ $user->created_at }}</span></td>
                    <td>
                      <a href="{{ route('dashboard.users.show', $user) }}" class="btn btn-sm btn-light d-inline-block lift">详情</a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle lift" data-bs-toggle="dropdown"></button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                          <a class="dropdown-item text-muted">No Operations</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
