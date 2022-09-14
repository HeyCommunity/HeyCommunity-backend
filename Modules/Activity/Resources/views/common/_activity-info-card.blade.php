<div class="card">
  <div class="card-header"><h4 class="card-header-title">活动信息</h4></div>
  <div class="card-body">
    <div class="list-group list-group-flush my-n3">
      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">票价</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->price }} RMB</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">报名人数</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->member_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">余票数 / 总票数</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->surplus_ticket_num }} / {{ $activity->total_ticket_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">点赞 / 评论</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->thumb_up_num }} / {{ $activity->comment_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">活动地点</h5></div>
          <div class="col-auto">
            <small class="text-muted" data-bs-toggle="tooltip" title="{{ $activity->address_full }} {{ $activity->address_name }}">{{ $activity->address_name }}</small>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">开始时间</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->started_at }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">结束时间</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $activity->ended_at }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">发布时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $activity->created_at }}" data-bs-toggle="tooltip" title="{{ $activity->created_at->diffForHumans() }}">{{ $activity->created_at }}</time>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

