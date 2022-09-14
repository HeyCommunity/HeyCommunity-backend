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
        @include('post::common._item-post-card', ['post' => $post, 'showComments' => false])

        @include('common._comments-card', ['comments' => $post->comments])
      </div>

      <div class="col-lg-4">
        @include('post::common._post-info-card', ['post' => $post])

        @include('common._up-thumbs-card', ['thumbs' => $post->upThumbs])
      </div>
    </div>
  </div>
</div>
@endsection
