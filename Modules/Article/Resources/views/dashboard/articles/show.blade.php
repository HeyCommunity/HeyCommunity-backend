@extends('dashboard.layouts.default')

@section('mainContent')
<style rel="stylesheet">
  .quill-html p {
    margin-bottom: 0 !important;
  }
</style>

<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="header">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Article Detail</h6>
                <h1 class="header-title">文章详情</h1>
              </div>

              <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-light lift"><i class="fe fe-chevron-left"></i> 返回</a>
                <a target="_blank" href="{{ route('web.articles.show', $article) }}" class="btn btn-light lift"><i class="fe fe-eye"></i> 前台查看</a>
              </div>
            </div>
          </div>
        </div>

        <div id="section-content">
          <div class="row">
            <div class="col-lg-8">
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

              <div class="card">
                <div class="card-header">
                  <div class="card-header-title">文章评论</div>
                  <div><span class="badge bg-secondary-soft">{{ $article->comments->count() }}</span></div>
                </div>
                <div class="card-body {{ $article->comments->count() ? 'mb-n3' : '' }}">
                  @if ($article->comments->count())
                    @foreach ($article->comments as $comment)
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

            <!-- 侧边栏 -->
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header"><h4 class="card-header-title">文章信息</h4></div>
                <div class="card-body">
                  <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">用户</h5></div>
                        <div class="col-auto">
                          <a class="avatar avatar-xs" onwheel="{{ route('dashboard.users.show', $article->user) }}">
                            <img class="avatar-img rounded-circle" src="{{ asset($article->user->avatar) }}">
                          </a>
                          <a class="avatar-xs small" href="{{ route('dashboard.users.show', $article->user) }}">{{ $article->user->nickname }}</a>
                        </div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">作者</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $article->author }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">点赞 / 评论</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $article->thumb_up_num }} / {{ $article->comment_num }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">发布时间</h5></div>
                        <div class="col-auto">
                          <time class="small text-muted" datetime="{{ $article->published_at }}" data-bs-toggle="tooltip" title="{{ $article->published_at->diffForHumans() }}">{{ $article->published_at }}</time>
                        </div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">创建时间</h5></div>
                        <div class="col-auto">
                          <time class="small text-muted" datetime="{{ $article->created_at }}" data-bs-toggle="tooltip" title="{{ $article->created_at->diffForHumans() }}">{{ $article->created_at }}</time>
                        </div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">更新时间</h5></div>
                        <div class="col-auto">
                          <time class="small text-muted" datetime="{{ $article->updated_at }}" data-bs-toggle="tooltip" title="{{ $article->updated_at->diffForHumans() }}">{{ $article->updated_at }}</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <div class="card-header-title">点赞的人</div>
                  <div><span class="badge bg-secondary-soft">{{ $article->upThumbs->count() }}</span></div>
                </div>
                <div class="card-body">
                  <div class="col-auto">
                    <div class="avatar-group">
                      @if ($article->upThumbs->count())
                        @foreach ($article->upThumbs as $thumb)
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
    </div>
  </div>
</div>
@endsection
