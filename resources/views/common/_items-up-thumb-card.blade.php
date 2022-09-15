@if ($thumbs->isEmpty())
  <div class="card"><div class="card-body">暂无点赞</div></div>
@else
  @foreach ($thumbs as $thumb)
    @include('common._item-up-thumb-card')
  @endforeach
@endif
