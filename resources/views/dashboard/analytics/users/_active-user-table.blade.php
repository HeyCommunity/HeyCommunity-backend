<div class="table-responsive mb-0">
  <table class="table table-sm table-nowrap card-table">
    <thead>
    <tr>
      <th class="text-center">UID</th>
      <th>用户</th>
      <th>访问次数</th>
      <th>访问时间</th>
      <th>设备</th>
      <th>地区</th>
      <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if (! $result->count())
      <tr><td colspan="100">无数据</td></tr>
    @endif

    @foreach ($result as $resultItem)
      <tr>
        <td class="text-center" rowspan="2">{{ $resultItem->user_id }}</td>

        <!-- 用户 -->
        <td>
          @if ($resultItem->user)
            <a href="{{ route('dashboard.users.show', $resultItem->user)  }}" class="avatar avatar-xs d-inline-block me-2">
              <img src="{{ asset($resultItem->user->avatar) }}" alt="{{ $resultItem->user->app_id }}" class="avatar-img rounded-circle">
            </a>
            <a class="text-black" href="{{ route('dashboard.users.show', $resultItem->user) }}">{{ $resultItem->user->nickname ?: 'NULL' }}</a>
          @else
            <a class="avatar avatar-xs d-inline-block me-2">
              <img src="{{ asset('images/users/default-avatar.jpg') }}" class="avatar-img rounded-circle">
              <a class="text-black">Anonymous</a>
            </a>
          @endif
        </td>

        <td>{{ $resultItem->total_num }}</td>
        <td>
          {{ \Carbon\Carbon::parse($resultItem->start_time)->format('H:i') }}
          @if (\Carbon\Carbon::parse($resultItem->start_time)->diffInMinutes(\Carbon\Carbon::parse($resultItem->end_time)))
            - {{ \Carbon\Carbon::parse($resultItem->end_time)->format('H:i') }}
          @endif
        </td>
        <td>{{ $resultItem->devices }}</td>
        <td>{{ $resultItem->locales }}</td>

        <td>
          <button type="button" class="btn btn-sm btn-outline-light text-gray-800 d-inline-block"
                  data-bs-toggle="collapse" data-bs-target="#sameDateLogTable-u{{ $resultItem->user_id }}">
            <i class="fe fe-chevrons-down"></i> 展开
          </button>
        </td>
      </tr>
      <tr>
        <td colspan="100" style="padding:0 !important;" id="sameDateLogTable-u{{ $resultItem->user_id }}" class="collapse">
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
              @foreach ($resultItem->sameUserLogs as $log)
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

