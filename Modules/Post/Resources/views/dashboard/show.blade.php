@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Post Detail</h6>
            <h1 class="header-title">动态详情</h1>
          </div>
          <div class="col-auto">
            <a href="{{ url()->previous() }}" class="btn btn-light lift"><i class="fe fe-chevron-left"></i> 返回</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-xl-8">
        @include('post::dashboard._item-post-card', ['post' => $post])
      </div>

      <div class="col-12 col-xl-4">
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

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">阅读/点赞/评论</h5>
                  </div>
                  <div class="col-auto">
                    <small class="text-muted">
                      {{ $post->read_num }} / {{ $post->thumb_up_num }} / {{ $post->comment_num }}
                    </small>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">更新时间</h5>
                  </div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $post->updated_at }}"
                          data-bs-toggle="tooltip" title="{{ $post->updated_at->diffForHumans() }}">{{ $post->updated_at }}</time>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">发布时间</h5>
                  </div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $post->created_at }}"
                          data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</time>
                  </div>
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
