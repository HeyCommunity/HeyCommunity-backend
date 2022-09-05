@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="bg-cover header-img-top" style="background-image:url({{ asset($user->cover) }}); background-color:#ddd; height:260px"></div>

    <div class="container-fluid">
      <div class="header-body mt-n5 mt-md-n6">
        <div class="row align-items-end">
          <div class="col-auto">
            <div class="avatar avatar-xxl header-avatar-top">
              <img src="{{ $user->avatar }}" alt="{{ $user->nickname }}" class="avatar-img rounded-circle border border-4 border-body">
            </div>
          </div>

          <div class="col mb-3 ms-n3 ms-md-n2">
            <h6 class="header-pretitle">{{ $user->bio ?: 'No Bio' }}</h6>
            <h1 class="header-title">{{ $user->nickname }}</h1>
          </div>
          <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
            <a href="{{ url()->previous() }}" class="btn btn-light lift"><i class="fe fe-chevron-left"></i> 返回</a>
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col">
            <ul class="nav nav-tabs nav-overflow header-tabs">
              <li class="nav-item"><a href="#" class="nav-link active">动态</a></li>
              <li class="nav-item"><a href="#" class="nav-link disabled">评论</a></li>
              <li class="nav-item"><a href="#" class="nav-link disabled">点赞</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-xl-8 order-2 order-md-1">
        @foreach ($user->posts as $post)
          @include('post::dashboard._item-post-card', ['post' => $post])
        @endforeach
      </div>

      <div class="col-12 col-xl-4 order-1 order-md-2">
        <div class="card">
          <div class="card-header">
            <h4 class="card-header-title"><i class="fe fe-user"></i> 用户信息</h4>
            <span class="small text-muted">#{{ $user->id }}</span>
          </div>
          <div class="card-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">动态/评论/点赞</h5></div>
                  <div class="col-auto"><small class="text-muted">{{ $user->post_num }} / {{ $user->comment_num }} / {{ $user->thumb_up_num }}</small></div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">活跃天数</h5></div>
                  <div class="col-auto"><small class="text-muted">{{ $user->active_day_num }}</small></div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">最近活跃时间</h5></div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $user->last_active_at }}"
                          data-bs-toggle="tooltip" title="{{ optional($user->last_active_at)->diffForHumans() }}">{{ $user->last_active_at ?? 'NULL' }}</time>
                  </div>
                </div>
              </div>

              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col"><h5 class="mb-0">注册时间</h5></div>
                  <div class="col-auto">
                    <time class="small text-muted" datetime="{{ $user->created_at }}"
                          data-bs-toggle="tooltip" title="{{ $user->created_at->diffForHumans() }}">{{ $user->created_at }}</time>
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
