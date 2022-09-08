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
            <a target="_blank" href="{{ route('web.posts.show', $post) }}" class="btn btn-light lift"><i class="fe fe-eye"></i> 前台查看</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        @include('post::dashboard._item-post-card', ['post' => $post])

        <div class="card">
          <div class="card-header">
            <div class="card-header-title">动态评论</div>
            <div><span class="badge bg-secondary-soft">{{ $post->comments->count() }}</span></div>
          </div>
          <div class="card-body {{ $post->comments->count() ? 'mb-n3' : '' }}">
            @if ($post->comments->count())
              @foreach ($post->comments as $comment)
                <div class="comment mb-3">
                  <div class="row">
                    <div class="col-auto">
                      <a class="avatar" href="{{ route('dashboard.users.show', $comment->user) }}">
                        <img src="{{ $comment->user->avatar }}" class="avatar-img rounded-circle">
                      </a>
                    </div>
                    <div class="col ms-n2">
                      <div class="comment-body w-100">
                        <div class="row">
                          <div class="col">
                            <h5 class="comment-title"><a href="{{ route('dashboard.users.show', $comment->user)  }}">{{ $comment->user->nickname }}</a></h5>
                          </div>
                          <div class="col-auto">
                            <time class="comment-time" data-bs-toggle="tooltip" title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at }}</time>
                          </div>
                        </div>
                        <p class="comment-text">{{ $comment->content }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div><span class="text-muted fs-sm">暂无数据</span></div>
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">动态信息</h4>
            <span class="small text-muted">#{{ $post->id }}</span>
          </div>
          <div class="card-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item py-3">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">发布人</h5></div>
                  <div class="col-auto"><a class="small" href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname }}</a></div>
                </div>
              </div>

              <div class="list-group-item py-3">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">阅读 / 点赞 / 评论</h5></div>
                  <div class="col-auto"><small class="text-muted">{{ $post->read_num }} / {{ $post->thumb_up_num }} / {{ $post->comment_num }}</small></div>
                </div>
              </div>

              <div class="list-group-item py-3">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">发布时间</h5></div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $post->created_at }}"
                          data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</time>
                  </div>
                </div>
              </div>

              <div class="list-group-item py-3">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">更新时间</h5></div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $post->updated_at }}"
                          data-bs-toggle="tooltip" title="{{ $post->updated_at->diffForHumans() }}">{{ $post->updated_at }}</time>
                  </div>
                </div>
              </div>

              <div class="list-group-item py-3">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">状态</h5></div>
                  <div class="col-auto"><span class="text-muted small">{{ $post->status_name }}</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-header-title">点赞的人</div>
            <div><span class="badge bg-secondary-soft">{{ $post->upThumbs->count() }}</span></div>
          </div>
          <div class="card-body">
            <div class="col-auto">
              <div class="avatar-group">
                @if ($post->upThumbs->count())
                  @foreach ($post->upThumbs as $thumb)
                    <a href="{{ route('dashboard.users.show', $thumb->user) }}" class="avatar avatar-sm" data-bs-toggle="tooltip" title="" data-bs-original-title="{{ $thumb->user->nickname }}">
                      <img src="{{ asset($thumb->user->avatar) }}" alt="{{ $thumb->user->nickname }}" class="avatar-img rounded-circle">
                    </a>
                  @endforeach
                @else
                  <div><span class="text-muted fs-sm">暂无数据</span></div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
