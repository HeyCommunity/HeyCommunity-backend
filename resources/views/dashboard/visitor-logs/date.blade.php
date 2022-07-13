@extends('dashboard.layouts.default')

@section('mainBody')
  @include('dashboard.visitor-logs._header')

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card" data-list='{"valueNames": ["name"]}'>
          <div class="card-header">
            <h4 class="card-header-title">{{ \Carbon\Carbon::parse(request()->get('date'))->format('Y/m/d') }}</h4>

            <form class="me-3">
              <select disabled class="form-select form-select-sm form-control-flush" data-choices='{"searchEnabled": false}'>
                <option value="asc">按用户</option>
                <option value="desc">按 IP</option>
              </select>
            </form>
          </div>

          <div class="">
            <div class="table-responsive mb-0">
              <table class="table table-sm table-nowrap card-table">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>用户</th>
                  <th>访问次数</th>
                  <th>访问时间</th>
                  <th>设备</th>
                  <th>地区</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @if (! $visitorLogs->count())
                  <tr><td colspan="100">无数据</td></tr>
                @endif

                @foreach ($visitorLogs as $visitorLog)
                  <tr>
                    <td class="text-center" rowspan="2">{{ $visitorLog->id }}</td>

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
                          <a class="text-black">Anonymous</a>
                        </a>
                      @endif
                    </td>

                    <td>{{ $visitorLog->total_num }}</td>
                    <td>
                      {{ \Carbon\Carbon::parse($visitorLog->start_time)->format('H:i:s') }}
                      - {{ \Carbon\Carbon::parse($visitorLog->end_time)->format('H:i:s') }}
                    </td>
                    <td>{{ $visitorLog->devices }}</td>
                    <td>{{ $visitorLog->locales }}</td>

                    <td>
                      <button type="button" class="btn btn-sm btn-outline-light text-gray-800 d-inline-block"
                              data-bs-toggle="collapse" data-bs-target="#someDateLogTable-u{{ $visitorLog->user_id }}">
                        <i class="fe fe-chevrons-down"></i> 展开
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="100" style="padding:0 !important;" id="someDateLogTable-u{{ $visitorLog->user_id }}" class="collapse">
                      <div class="table-responsive">
                        <table class="mb-0 table table-sm table-nowrap">
                          <thead>
                            <tr>
                              <th class="p-0">#</th>
                              <th>URI</th>
                              <th>设备</th>
                              <th>时间</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($visitorLog->someUserLogs as $log)
                            <tr>
                              <td>{{ $log->id }}</td>
                              <td>{{ $log->request_uri }}</td>
                              <td>{{ $log->visitor_agent_device }}</td>
                              <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="mb-5">
          {{ $visitorLogs->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
