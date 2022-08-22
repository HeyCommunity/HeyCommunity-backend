  <div class="list-group-item">
    <div class="row">
      <div class="col-auto">
        <a class="avatar avatar-lg" href="{{ route('web.articles.show', $article) }}">
          <img src="{{ asset($article->cover) }}" class="avatar-img rounded">
        </a>
      </div>

      <div class="col ms-n2">
        <h4 class="text-body text-focus mb-1 name"><a href="{{ route('web.articles.show', $article) }}">{{ $article->title }}</a></h4>
        <p class="small text-muted mb-0">{{ $article->intro }}</p>
      </div>
    </div>
  </div>
