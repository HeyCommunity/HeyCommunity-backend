<div class="card">
  <div class="card-header">
    <h4 class="card-header-title">动态信息</h4>
    <span class="small text-muted">#{{ $post->id }}</span>
  </div>
  <div class="card-body">
    <div class="list-group list-group-flush my-n3">
      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">发布人</h5></div>
          <div class="col-auto"><a class="small" href="{{ hcRoute('users.show', $post->user) }}">{{ $post->user->nickname }}</a></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">阅读 / 点赞 / 评论</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $post->read_num }} / {{ $post->thumb_up_num }} / {{ $post->comment_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">发布时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $post->created_at }}"
                  data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</time>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">更新时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $post->updated_at }}"
                  data-bs-toggle="tooltip" title="{{ $post->updated_at->diffForHumans() }}">{{ $post->updated_at }}</time>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">状态</h5></div>
          <div class="col-auto"><span class="text-muted small">{{ $post->status_name }}</span></div>
        </div>
      </div>
    </div>
  </div>
</div>

