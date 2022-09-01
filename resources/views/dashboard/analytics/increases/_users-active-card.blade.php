<div class="card">
  <div class="card-header">
    <h4 class="card-header-title">近 7 天活跃用户</h4>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive mb-0">
      <table class="table table-sm table-nowrap card-table">
        <thead>
        <tr>
          <th>ID</th>
          <th>昵称</th>
          <th>BIO</th>
          <th>动态/点赞/评论</th>
          <th>活跃天数</th>
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
                <a href="{{ route('dashboard.users.show', $user) }}" class="avatar avatar-xs d-inline-block me-2">
                  <img src="{{ asset($user->avatar) }}" alt="{{ $user->app_id }}" class="avatar-img rounded-circle">
                </a>
              @endif
              <a class="text-reset" href="{{ route('dashboard.users.show', $user) }}">{{ $user->nickname ?: 'NULL' }}</a>
            </td>
            <td>{{ Str::limit($user->bio, 15*2) }}</td>
            <td><span class="badge bg-light">{{ $user->post_num }} / {{ $user->thumb_up_num }} / {{ $user->comment_num }}</span></td>
            <td><span class="badge bg-light">{{ $user->active_day_num }}</span></td>

            <td>{{ $user->last_active_at->diffForHumans() }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
              <a href="{{ route('dashboard.users.show', $user) }}" class="btn btn-sm btn-white">详情</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
