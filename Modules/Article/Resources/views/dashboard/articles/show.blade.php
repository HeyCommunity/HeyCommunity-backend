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
            <div class="col-12 col-lg-8">
              @include('article::common._article-card', ['article' => $article])

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
    </div>
  </div>
</div>
@endsection
