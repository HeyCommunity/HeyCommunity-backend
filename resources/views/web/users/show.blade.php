@extends('web.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="bg-cover header-img-top" style="background-image:url({{ asset($user->cover) }}); height:200px"></div>

    <div class="container">
      <div class="header-body mt-n5 mt-md-n6">
        <div class="row align-items-end">
          <div class="col-auto">
            <div class="avatar avatar-xxl header-avatar-top">
              <img src="{{ $user->avatar }}" alt="{{ $user->nickname }}" class="avatar-img rounded border border-4 border-body">
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
              <li class="nav-item d-inline-block d-lg-none"><a href="#tab-info" class="nav-link" data-bs-toggle="tab">信息</a></li>
              <li class="nav-item"><a href="#tab-posts" class="nav-link active" data-bs-toggle="tab">动态</a></li>
              <li class="nav-item"><a href="#tab-comments" class="nav-link" data-bs-toggle="tab">评论</a></li>
              <li class="nav-item"><a href="#tab-up-thumbs" class="nav-link" data-bs-toggle="tab">点赞</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-8">
        <div id="tabs" class="tab-content">
          <style rel="stylesheet">
            #tabs .tab-pane > .card > .card-body > .card {
              margin-bottom: 0;
            }
          </style>

          <div id="tab-info" class="tab-pane fade">
            @include('common.users._user-info-card', ['user' => $user])
          </div>

          <div id="tab-posts" class="tab-pane fade active show">
            @include('post::common._post-list', ['posts' => $user->posts])
          </div>

          <div id="tab-comments" class="tab-pane fade">
            @include('common.users._items-comment-card', ['comments' => $user->comments])
          </div>

          <div id="tab-up-thumbs" class="tab-pane fade">
            @include('common.users._items-up-thumb-card', ['thumbs' => $user->upThumbs])
          </div>
        </div>
      </div>

      <!-- 侧边栏 -->
      <div class="col-12 col-lg-4 d-none d-lg-block">
        @include('common.users._user-info-card', ['user' => $user])
      </div>
    </div>
  </div>
</div>
@endsection
