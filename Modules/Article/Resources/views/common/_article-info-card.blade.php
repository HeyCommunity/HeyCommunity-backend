<div class="card">
  <div class="card-header"><h4 class="card-header-title">文章信息</h4></div>
  <div class="card-body">
    <div class="list-group list-group-flush my-n3">
      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">用户</h5></div>
          <div class="col-auto">
            <a class="avatar avatar-xs" onwheel="{{ hcRoute('users.show', $article->user) }}">
              <img class="avatar-img rounded-circle" src="{{ asset($article->user->avatar) }}">
            </a>
            <a class="avatar-xs small" href="{{ hcRoute('users.show', $article->user) }}">{{ $article->user->nickname }}</a>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">作者</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $article->author }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">点赞 / 评论</h5></div>
          <div class="col-auto"><small class="text-muted">{{ $article->thumb_up_num }} / {{ $article->comment_num }}</small></div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">发布时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $article->published_at }}" data-bs-toggle="tooltip" title="{{ $article->published_at->diffForHumans() }}">{{ $article->published_at }}</time>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">创建时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $article->created_at }}" data-bs-toggle="tooltip" title="{{ $article->created_at->diffForHumans() }}">{{ $article->created_at }}</time>
          </div>
        </div>
      </div>

      <div class="list-group-item py-3">
        <div class="row align-items-center">
          <div class="col"><h5 class="mb-0">更新时间</h5></div>
          <div class="col-auto">
            <time class="small text-muted" datetime="{{ $article->updated_at }}" data-bs-toggle="tooltip" title="{{ $article->updated_at->diffForHumans() }}">{{ $article->updated_at }}</time>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

