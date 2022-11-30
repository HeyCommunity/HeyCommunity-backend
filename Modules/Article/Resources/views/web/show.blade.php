@extends('web.layouts.default')

@section('metaDescription', $article->intro)

@section('mainContent')
  <div class="main-content">
    <div class="header mb-0">
      <div class="bg-cover header-img-top"
           style="background-image:url({{ $article->cover }}); height:300px"></div>
    </div>

    <div class="container mt-n6">
      <div class="row">
        <div class="col-12 col-lg-8">
          @include('article::common._article-profile', ['article' => $article, 'showArticleTopCover' => false])

          <div class="d-block d-lg-none">
            @include('common._up-thumbs-card', ['thumbs' => $article->upThumbs])
          </div>

          @include('common._comments-card', ['comments' => $article->comments])
        </div>

        <!-- 侧边栏 -->
        <div class="col-12 col-lg-4 d-none d-lg-block">
          @include('article::common._article-info-card', ['article' => $article])

          @include('common._up-thumbs-card', ['thumbs' => $article->upThumbs])
        </div>
      </div>
    </div>
  </div>
@endsection
