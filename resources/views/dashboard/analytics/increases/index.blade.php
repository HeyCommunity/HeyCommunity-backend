@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header sticky-lg-top bg-light-soft">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Increases</h6>
            <h1 class="header-title">数据增长明细 <sup><span class="badge bg-light">近 7 天</span></sup></h1>
          </div>
          <div class="col-auto">
            <ul class="nav nav-tabs header-tabs">
              <li class="nav-item">
                <a href="#userActiveCard" class="nav-link text-center active" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">{{ $userActiveData->count() }}</h6>
                  <h3 class="mb-0">活跃用户</h3>
                </a>
              </li>
              <li class="nav-item">
                <a href="#userIncreaseCard" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">+{{ $userIncreaseData->count() }}</h6>
                  <h3 class="mb-0">用户</h3>
                </a>
              </li>
              <li class="nav-item">
                <a href="#postIncreaseCard" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">+{{ $postIncreaseData->count() }}</h6>
                  <h3 class="mb-0">动态</h3>
                </a>
              </li>
              <li class="nav-item">
                <a href="#commentIncreaseCard" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">+{{ $commentIncreaseData->count() }}</h6>
                  <h3 class="mb-0">评论</h3>
                </a>
              </li>
              <li class="nav-item">
                <a href="#thumbUpIncreaseCard" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">+{{ $thumbUpIncreaseData->count() }}</h6>
                  <h3 class="mb-0">点赞</h3>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CARDS -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="tab-content">
          <div id="userActiveCard" class="tab-pane fade active show">
            @include('dashboard.analytics.increases._users-active-card', ['users' => $userActiveData])
          </div>
          <div id="userIncreaseCard" class="tab-pane fade">
            @include('dashboard.analytics.increases._users-card', ['users' => $userIncreaseData])
          </div>
          <div id="postIncreaseCard" class="tab-pane fade">
            @include('dashboard.analytics.increases._posts-card', ['posts' => $postIncreaseData])
          </div>
          <div id="commentIncreaseCard" class="tab-pane fade">
            @include('dashboard.analytics.increases._comments-card', ['comments' => $commentIncreaseData])
          </div>
          <div id="thumbUpIncreaseCard" class="tab-pane fade">
            @include('dashboard.analytics.increases._thumbs-up-card', ['thumbs' => $thumbUpIncreaseData])
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
