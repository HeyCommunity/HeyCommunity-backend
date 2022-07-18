@extends('dashboard.layouts.default')

@section('mainBody')
  @include('dashboard.visitor-logs._header')

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
                  <th>URI</th>
                  <th>地区/IP</th>
                  <th>访问设备</th>
                  <th>访问时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @if (! $visitorLogs->count())
                  <tr><td colspan="100">无数据</td></tr>
                @endif

                @foreach ($visitorLogs as $visitorLog)
                  <tr>
                    <td>{{ $visitorLog->id }}</td>

                    <!-- 用户 -->
                    <td>
                      @if ($visitorLog->user)
                        <a href="{{ route('dashboard.users.show', $visitorLog->user)  }}" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($visitorLog->user->avatar) }}" alt="{{ $visitorLog->user->app_id }}" class="avatar-img rounded-circle">
                        </a>
                        <a class="text-black" href="{{ route('dashboard.users.show', $visitorLog->user) }}">{{ $visitorLog->user->nickname ?: 'NULL' }}</a>
                      @else
                        <a class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset('images/users/default-avatar.jpg') }}" class="avatar-img rounded-circle">
                        </a>
                      @endif
                    </td>

                    <td><span data-bs-toggle="tooltip" title="{{ $visitorLog->route_name }}">{{ $visitorLog->request_method }}: {{ $visitorLog->request_uri }}</span></td>
                    <td>{{ $visitorLog->visitor_ip_locale }} /<i>{{ $visitorLog->visitor_ip }}</i></td>

                    <td>{{ $visitorLog->visitor_agent_device }}</td>
                    <td><span data-bs-toggle="tooltip" title="{{ $visitorLog->created_at->diffForHumans() }}">{{ $visitorLog->created_at }}</span></td>
                    <td>/</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $visitorLogs->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
