@if ($posts->isEmpty())
  <div class="card"><div class="card-body">暂无动态</div></div>
@else
  @foreach ($posts as $post)
    @include('post::common._post-profile')
  @endforeach
@endif
