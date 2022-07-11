@extends('dashboard.layouts.default')

@section('mainBody')
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
                  <th>最近活跃</th>
                  <th>注册时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                      @if ($user->avatar)
                        <a href="#" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($user->avatar) }}" alt="{{ $user->app_id }}" class="avatar-img rounded-circle">
                        </a>
                      @endif
                      <span>{{ $user->nickname ?: 'NULL' }}</span>
                    </td>
                    <td>{{ $user->last_active_at ? $user->last_active_at->diffForHumans() : '-' }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td></td>
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
@endsection
