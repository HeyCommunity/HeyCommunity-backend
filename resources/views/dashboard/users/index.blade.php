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
                  <th>动态数</th>
                  <th>点赞数 / 评论数</th>
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
                    <td>{{ $user->post_num }}</td>
                    <td>{{ $user->thumb_up_num }} / {{ $user->comment_num }}</td>
                    <td><span data-bs-toggle="tooltip" title="{{ $user->last_active_at }}">
                      {{ $user->last_active_at ? ($user->last_active_at->addDays(15)->gratherThan(now()) ? $user->last_active_at->diffForHumans() : $user->last_active_at) : '-' }}
                    </span></td>
                    <td><span data-bs-toggle="tooltip" title="{{ $user->created_at }}">
                      {{ $user->created_at->addDays(15)->greaterThan(now()) ? $user->created_at->diffForHumans() : $user->created_at }}
                    </span></td>
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
