@if ($comments->isEmpty())
  <div class="card"><div class="card-body">暂无评论</div></div>
@else
  @foreach ($comments as $comment)
    <div class="card">
      <div class="card-body">{{ $comment->content }}</div>
      <div class="card-footer py-2 bg-light-soft">
        <div class="row">
          <div class="col">
            <span class="text-muted small">{{ $comment->entity_name }}({{ $comment->entity_id }})</span>
          </div>
          <div class="col-auto">
            <span class="text-muted small">{{ $comment->created_at }}</span>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endif
