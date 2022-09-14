<div class="card">
  <div class="card-header">
    <h4 class="card-header-title"><i class="fe fe-user me-1"></i> 用户信息</h4>
    <span class="small text-muted">#{{ $user->id }}</span>
  </div>
  <div class="card-body">
    <div class="list-group list-group-flush my-n3">
      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">简介</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $user->intro }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">性别</h5></div>
          <div class="col-auto"><small class="text-muted">{{ \App\Models\User::$genders[$user->gender] ?? '未知' }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">活跃天数</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $user->active_day_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">动态/评论/点赞</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $user->post_num }} / {{ $user->comment_num }} / {{ $user->thumb_up_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">最近活跃时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $user->last_active_at }}"
                  data-bs-toggle="tooltip" title="{{ optional($user->last_active_at)->diffForHumans() }}">{{ $user->last_active_at ?? 'NULL' }}</time>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">注册时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $user->created_at }}"
                  data-bs-toggle="tooltip" title="{{ $user->created_at->diffForHumans() }}">{{ $user->created_at }}</time>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

