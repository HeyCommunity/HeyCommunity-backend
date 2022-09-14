@extends('web.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="container mt-4">
    <div class="row">
      <div class="col-12 col-md-8">
        @include('post::common._item-post-card', ['post' => $post, 'showComments' => false])

        @include('common._comments-card', ['comments' => $post->comments])
      </div>

      <div class="col-12 col-md-4">
        @include('post::common._post-info-card', ['post' => $post])

        @include('common._up-thumbs-card', ['thumbs' => $post->upThumbs])
      </div>
    </div>
  </div>
</div>
@endsection
