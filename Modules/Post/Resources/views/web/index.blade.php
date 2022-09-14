@extends('web.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="container mt-4">
      <div class="row">
        <div class="col-12 col-md-8">
          @foreach ($posts as $post)
            @include('post::common._item-post-card', ['post' => $post])
          @endforeach
          @unless ($posts->count())
            <div class="card">
              <div class="card-body">暂无动态</div>
            </div>
          @endunless

          <div id="section-pagination">
            <div class="d-none d-sm-block">
              {{ $posts->links() }}
            </div>
            <div class="d-sm-none d-flex justify-content-center">
              {{ $posts->links('pagination::simple-bootstrap-4') }}
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title">动态</h4>
              <span class="small text-muted">POSTS</span>
            </div>
            <div class="card-body">
              <div class="list-group list-group-flush my-n3">
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col">
                      <h5 class="mb-0">最近发布</h5>
                    </div>
                    <div class="col-auto">{{ $lastCreatePost ? $lastCreatePost->created_at->diffForHumans() : '-' }}</div>
                  </div>
                </div>
                <div class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col">
                      <h5 class="mb-0">总数量</h5>
                    </div>
                    <div class="col-auto">{{ $posts->total() }}</div>
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
