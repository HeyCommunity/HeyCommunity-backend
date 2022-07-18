@extends('web.layouts.default')

@section('mainBody')
  <div class="container mt-4">
    <div class="row">
      <div class="col-12 col-md-8">
        @foreach ($posts as $post)
          @include('web.posts._item-post-card', ['post' => $post])
        @endforeach

        <div id="section-pagination">
          {{ $posts->links() }}
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">动态信息</h4>
            <span class="small text-muted">#{{ $post->id }}</span>
          </div>
          <div class="card-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">发布人</h5>
                  </div>
                  <div class="col-auto">
                    <a class="small" href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
