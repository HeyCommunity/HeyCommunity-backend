<div class="card">
  <div class="card-header">
    <div class="card-header-title">点赞的人</div>
    <div><span class="badge bg-secondary-soft">{{ $thumbs->count() }}</span></div>
  </div>
  <div class="card-body">
    <div class="col-auto">
      <div class="avatar-group">
        @if ($thumbs->count())
          @foreach ($thumbs as $thumb)
            <a href="{{ hcRoute('users.show', $thumb->user) }}" class="avatar avatar-sm" data-bs-toggle="tooltip" title="{{ $thumb->user->nickname }}">
              <img src="{{ asset($thumb->user->avatar) }}" alt="{{ $thumb->user->nickname }}" class="avatar-img rounded-circle">
            </a>
          @endforeach
        @else
          <div><span class="text-muted fs-sm">暂无数据</span></div>
        @endif
      </div>
    </div>
  </div>
</div>

