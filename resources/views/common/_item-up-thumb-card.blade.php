<div class="card">
  <div class="card-header">
    <div class="card-header-title">点赞{{ $thumb->entity_name }}({{ $thumb->entity_id }})</div>
    <div><span class="text-muted">{{ $thumb->created_at }}</span></div>
  </div>
  <div class="card-body bg-light-soft">
    @switch($thumb->entity_class)
      @case(\App\Models\Common\Comment::class)
        @include('common._item-comment-card', ['comment' => $thumb->entity])
        @break
      @case(\Modules\Post\Entities\Post::class)
        @include('post::common._item-post-card', ['post' => $thumb->entity])
        @break
      @case(\Modules\Article\Entities\Article::class)
        @include('article::common._item-article-card', ['article' => $thumb->entity])
        @break
      @case(\Modules\Activity\Entities\Activity::class)
        @include('activity::common._item-activity-card', ['activity' => $thumb->entity])
        @break
      @default
        <div class="card">
          <div class="card-body">coming soon ..</div>
        </div>
    @endswitch
  </div>
</div>
