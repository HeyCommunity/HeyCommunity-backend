<a class="list-group-item list-group-item-action p-4" href="{{ route('web.articles.show', $article) }}">
  <div class="row align-items-center">
    <div class="col-auto">
      <div class="avatar avatar-lg">
        <img src="{{ asset($article->cover) }}" class="avatar-img rounded">
      </div>
    </div>

    <div class="col ms-n2">
      <h2 class="h3 mb-2 text-body text-focus">{{ $article->title }}</h2>
      <p class="small text-muted mb-0">{{ $article->intro }}</p>
    </div>
  </div>
</a>
