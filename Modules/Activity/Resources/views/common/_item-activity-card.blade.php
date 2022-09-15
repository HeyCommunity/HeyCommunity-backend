<div class="card">
  <img class="card-img-top" src="{{ asset($activity->cover) }}" style="max-height:180px; object-fit:cover;">
  <div class="card-header py-3" style="height:auto;">
    <div>
      <h2 class="card-header-title">{{ $activity->title }}</h2>
      <div><span class="text-muted fs-sm">{{ $activity->user->nickname }}</span></div>
    </div>
    <div>
      <div><div class="text-muted text-end">#{{ $activity->id }}</div></div>
      <div><span class="fs-sm text-muted">{{ $activity->created_at }}</span></div>
    </div>
  </div>
  <div class="card-body">
    <div class="card card-inactive card-sm">
      <div class="card-body">
        <div class="h5 text-muted">活动简介</div>
        <div>{{ $activity->intro }}</div>
      </div>
    </div>
    <div class="mb-3 quill-html">{!! $activity->content !!}</div>
  </div>
</div>

