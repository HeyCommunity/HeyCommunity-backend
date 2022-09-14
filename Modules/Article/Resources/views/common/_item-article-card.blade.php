<div class="card">
  <img class="card-img-top" src="{{ asset($article->cover) }}" style="max-height:180px; object-fit:cover;">
  <div class="card-header py-3" style="height:auto;">
    <div>
      <h2 class="card-header-title">{{ $article->title }}</h2>
      <div><span class="text-muted fs-sm">{{ $article->author }}</span></div>
    </div>
    <div>
      <div><div class="text-muted text-end">#{{ $article->id }}</div></div>
      <div><span class="fs-sm text-muted">{{ $article->created_at }}</span></div>
    </div>
  </div>
  <div class="card-body">
    <div class="card card-inactive card-sm">
      <div class="card-body">
        <div class="h5 text-muted">文章简介</div>
        <div>{{ $article->intro }}</div>
      </div>
    </div>
    <div class="mb-3 quill-html">{!! $article->content !!}</div>
  </div>
</div>

