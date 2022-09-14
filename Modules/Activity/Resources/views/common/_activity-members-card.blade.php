<div class="card">
  <div class="card-header">
    <div class="card-header-title">报名的人</div>
    <div><span class="badge bg-secondary-soft">{{ $activity->members->count() }}</span></div>
  </div>
  <div class="card-body">
    @if ($activity->members->count())
      <div class="list-group list-group-flush my-n3">
        @foreach ($activity->members as $user)
          <div class="list-group-item">
            <div class="row align-items-center">
              <div class="col-auto">
                <a href="{{ route('dashboard.users.show', $user) }}" class="avatar">
                  <img src="{{ asset($user->avatar) }}" alt="{{ $user->nickname }}" class="avatar-img rounded-circle">
                </a>
              </div>

              <div class="col ms-n2">
                <div class="mb-1">
                  <a class="h4 text-black" href="{{ route('dashboard.users.show', $user) }}">{{ $user->nickname }}</a>
                  <div class="float-end"><span class="text-muted fs-sm">{{ now()->diffForHumans() }}</span></div>
                </div>
                <p class="card-text text-muted small">{{ $user->bio }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div><span class="text-muted fs-sm">暂无数据</span></div>
    @endif
  </div>
</div>

