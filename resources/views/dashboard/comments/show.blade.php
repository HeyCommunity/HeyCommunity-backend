@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Comment Detail</h6>
            <h1 class="header-title">评论详情</h1>
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
        <div class="card">
          <div class="card-body">
            <!-- Header -->
            <div class="">
              <div class="row align-items-center">
                <div class="col-auto">
                  <a href="{{ route('dashboard.users.show', $comment->user) }}" class="avatar">
                    <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->nickname }}" class="avatar-img rounded-circle">
                  </a>
                </div>

                <div class="col ms-n2">
                  <h4 class="mb-1"><a href="{{ route('dashboard.users.show', $comment->user) }}">{{ $comment->user->nickname }}</a></h4>
                  <p class="card-text small text-muted">
                    <span class="fe fe-clock"></span>
                    <time data-bs-toggle="tooltip" title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at }}</time>
                  </p>
                </div>

                <div class="col-auto">
                  <div class="dropdown">
                    <a href="#" class="dropdown-ellipses dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="fe fe-more-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="#!" class="dropdown-item text-muted">No Operations</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content -->
            <div class="mt-3">{!! $comment->content !!}</div>


            <!-- 父评论 -->
            @if ($comment->parent)
              <figure class="mt-3 mb-0" style="padding-left:20px; border-left:8px solid #DDD;">
                <blockquote class="bg-light p-3 rounded">
                  {!! $comment->parent->content !!}
                </blockquote>
                <figcaption class="blockquote-footer mt-0 mb-0">
                  {{ $comment->parent->user->nickname }}
                </figcaption>
              </figure>
            @endif
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title">评论信息</h4>
            <span class="small text-muted">#{{ $comment->id }}</span>
          </div>
          <div class="card-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">发布人</h5>
                  </div>
                  <div class="col-auto">
                    <a class="small" href="{{ route('dashboard.users.show', $comment->user) }}">{{ $comment->user->nickname }}</a>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">目标用户</h5>
                  </div>
                  <div class="col-auto">
                    <a class="small" href="{{ route('dashboard.users.show', $comment->commentable->user) }}">{{ $comment->commentable->user->nickname }}</a>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">目标实体</h5>
                  </div>
                  <div class="col-auto">
                    @if ($comment->entity_class === \Modules\Post\Entities\Post::class)
                      <a class="small" href="{{ route('dashboard.posts.show', $comment->entity_id) }}">{{ $comment->entity_name }}(ID:{{ $comment->entity_id }})</a>
                    @else
                      <span class="small">{{ $comment->entity_name }}(ID:{{ $comment->entity_id }})</span>
                    @endif

                    @if ($comment->parent)
                      /
                      @if ($comment->parent->entity_class === \Modules\Post\Entities\Post::class)
                        <a class="small" href="{{ route('dashboard.comments.show', $comment->parent->id) }}">评论(ID:{{ $comment->parent->id }})</a>
                      @else
                        <span class="small">评论(ID:{{ $comment->parent->id }})</span>
                      @endif
                    @endif
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">点赞/评论</h5>
                  </div>
                  <div class="col-auto">
                    <small class="text-muted">
                      {{ $comment->thumb_up_num }} / {{ $comment->comment_num }}
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
                    <time class="small text-muted" datetime="{{ $comment->updated_at }}"
                          data-bs-toggle="tooltip" title="{{ $comment->updated_at->diffForHumans() }}">{{ $comment->updated_at }}</time>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="mb-0">发布时间</h5>
                  </div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $comment->created_at }}"
                          data-bs-toggle="tooltip" title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at }}</time>
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
