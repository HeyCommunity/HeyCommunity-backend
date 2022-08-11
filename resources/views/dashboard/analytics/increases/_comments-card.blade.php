<div class="card">
  <div class="card-header">
    <h4 class="card-header-title">近 7 天新增评论</h4>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive mb-0">
      <div class="table-responsive mb-0">
        <table class="table table-sm table-nowrap card-table">
          <thead>
          <tr>
            <th>ID</th>
            <th>用户</th>
            <th>目标用户</th>
            <th>目标实体</th>
            <th style="max-width:370px;">内容</th>
            <th>点赞/评论</th>
            <th>发布时间</th>
            <th>操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($comments as $comment)
            <tr>
              <td>{{ $comment->id }}</td>
              <td>
                <a href="{{ route('dashboard.users.show', $comment->user) }}" class="avatar avatar-xs d-inline-block me-2">
                  <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->app_id }}" class="avatar-img rounded-circle">
                </a>
                <a class="text-reset" href="{{ route('dashboard.users.show', $comment->user) }}">{{ $comment->user->nickname ?: 'NULL' }}</a>
              </td>

              <!-- 目标用户 -->
              <td>
                <a href="{{ route('dashboard.users.show', $comment->commentable->user) }}" class="avatar avatar-xs d-inline-block me-2">
                  <img src="{{ asset($comment->commentable->user->avatar) }}" alt="{{ $comment->commentable->user->app_id }}" class="avatar-img rounded-circle">
                </a>
                <a class="text-reset" href="{{ route('dashboard.users.show', $comment->commentable->user) }}">{{ $comment->commentable->user->nickname ?: 'NULL' }}</a>
              </td>

              <!-- 目标实体 -->
              <td>
                @if ($comment->entity_class === \Modules\Post\Entities\Post::class)
                  <a class="text-reset d-block" href="{{ route('dashboard.posts.show', $comment->entity_id) }}">{{ $comment->entity_name }}(ID:{{ $comment->entity_id }})</a>
                @else
                  <span class="text-reset d-block">{{ $comment->entity_name }}(ID:{{ $comment->entity_id }})</span>
                @endif

                @if ($comment->parent)
                  @if ($comment->parent->entity_class === \Modules\Post\Entities\Post::class)
                    <a class="text-reset d-block mt-1" href="{{ route('dashboard.comments.show', $comment->parent->id) }}">评论(ID:{{ $comment->parent->id }})</a>
                  @else
                    <a class="text-reset d-block mt-1" href="{{ route('dashboard.comments.show', $comment->parent->id) }}">评论(ID:{{ $comment->parent->id }})</a>
                  @endif
                @endif
              </td>

              <!-- 内容 -->
              <td class="text-wrap">
                @if (Str::length($comment->content) > 100)
                  <span>{{ Str::limit($comment->content, 100 * 2) }}</span>
                @else
                  <span>{{ $comment->content }}</span>
                @endif
              </td>

              <td><span class="badge bg-light">{{ $comment->thumb_up_num }} / {{ $comment->comment_num }}</span></td>
              <td><span data-bs-toggle="tooltip" title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span></td>
              <td>
                <a href="{{ route('dashboard.comments.show', $comment) }}" class="btn btn-sm btn-light d-inline-block">详情</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
