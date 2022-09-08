@extends('dashboard.layouts.default')

@section('mainContent')
<style rel="stylesheet">
  .quill-html p {
    margin-bottom: 0 !important;
  }
</style>

<div class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="header">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Activity Detail</h6>
                <h1 class="header-title">活动详情</h1>
              </div>
            </div>
          </div>
        </div>

        <div id="section-content">
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <img class="card-img-top" src="{{ asset($activity->cover) }}" style="max-height:180px;">
                <div class="card-header py-3" style="height:auto;">
                  <div>
                    <h2 class="card-header-title">{{ $activity->title }}</h2>
                    <div><span class="text-muted fs-sm">{{ $activity->user->nickname }}</span></div>
                  </div>
                  <div>
                    <div><div class="text-muted text-end">#{{ $activity->id }}</div></div>
                    <div><span class="fs-sm text-muted">{{ $activity->created_at }}</span></div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="card card-inactive card-sm">
                    <div class="card-body">
                      <div class="h5 text-muted">活动简介</div>
                      <div>{{ $activity->intro }}</div>
                    </div>
                  </div>
                  <div class="mb-3 quill-html">{!! $activity->content !!}</div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <div class="card-header-title">活动评论</div>
                  <div><span class="badge bg-secondary-soft">{{ $activity->comments->count() }}</span></div>
                </div>
                <div class="card-body {{ $activity->comments->count() ? 'mb-n3' : '' }}">
                  @if ($activity->comments->count())
                    @foreach ($activity->comments as $comment)
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
                <div class="card-header"><h4 class="card-header-title">活动信息</h4></div>
                <div class="card-body">
                  <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">票价</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->price }} RMB</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">报名人数</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->member_num }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">余票数 / 总票数</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->surplus_ticket_num }} / {{ $activity->total_ticket_num }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">点赞 / 评论</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->thumb_up_num }} / {{ $activity->comment_num }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">活动地点</h5></div>
                        <div class="col-auto">
                          <small class="text-muted" data-bs-toggle="tooltip" title="{{ $activity->address_full }} {{ $activity->address_name }}">{{ $activity->address_name }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">开始时间</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->started_at }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">结束时间</h5></div>
                        <div class="col-auto"><small class="text-muted">{{ $activity->ended_at }}</small></div>
                      </div>
                    </div>

                    <div class="list-group-item py-3">
                      <div class="row align-items-center">
                        <div class="col"><h5 class="mb-0">发布时间</h5></div>
                        <div class="col-auto">
                          <time class="small text-muted" datetime="{{ $activity->created_at }}" data-bs-toggle="tooltip" title="{{ $activity->created_at->diffForHumans() }}">{{ $activity->created_at }}</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <div class="card-header-title">点赞的人</div>
                  <div><span class="badge bg-secondary-soft">{{ $activity->upThumbs->count() }}</span></div>
                </div>
                <div class="card-body">
                  <div class="col-auto">
                    <div class="avatar-group">
                      @if ($activity->upThumbs->count())
                        @foreach ($activity->upThumbs as $thumb)
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

              <div class="card">
                <div class="card-header">
                  <div class="card-header-title">报名的人</div>
                  <div><span class="badge bg-secondary-soft">{{ $activity->members->count() }}</span></div>
                </div>
                <div class="card-body">
                  @if ($activity->members->count())
                    <div class="list-group list-group-flush my-n3">
                      @foreach ($activity->members as $user)
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <a href="{{ route('dashboard.users.show', $user) }}" class="avatar">
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->nickname }}" class="avatar-img rounded-circle">
                              </a>
                            </div>

                            <div class="col ms-n2">
                              <div class="mb-1">
                                <a class="h4 text-black" href="{{ route('dashboard.users.show', $user) }}">{{ $user->nickname }}</a>
                                <div class="float-end"><span class="text-muted fs-sm">{{ now()->diffForHumans() }}</span></div>
                              </div>
                              <p class="card-text text-muted small">{{ $user->bio }}</p>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
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
@endsection
