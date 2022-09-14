@if ($comments->isEmpty())
  <div class="card"><div class="card-body">暂无评论</div></div>
@else
  @foreach ($comments as $comment)
    @include('common.users._item-comment-card', ['comment' => $comment])
  @endforeach
@endif
