@extends('web.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="container mt-4">
      <div class="row">
        <div class="col-12 col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="list-group list-group-lg list-group-flush list-group-focus">
                @foreach ($articles as $article)
                  @include('article::web._item-article-card', ['article' => $article])
                @endforeach
              </div>
            </div>
          </div>

          @unless ($articles->count())
            <div class="card">
              <div class="card-body">暂无文章</div>
            </div>
          @endunless

          <div id="section-pagination">
            <div class="d-none d-sm-block">
              {{ $articles->links() }}
            </div>
            <div class="d-sm-none d-flex justify-content-center">
              {{ $articles->links('pagination::simple-bootstrap-4') }}
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title">文章</h4>
              <span class="small text-muted">ARTICLES</span>
            </div>
            <div class="card-body">
              <div class="list-group list-group-flush my-n3">
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col">
                      <h5 class="mb-0">总数量</h5>
                    </div>
                    <div class="col-auto">{{ $articles->total() }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
