@extends('layouts.default')
@section('pageTitle', $article->title)
@section('pageDescription', $article->intro)

@section('mainBody')
  <nav id="section-breadcrumb" class="bg-gray-800">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Breadcrumb -->
          <ol class="breadcrumb breadcrumb-scroll">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">HEY社区</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.list') }}" class="text-white">文章</a></li>
            <li class="breadcrumb-item active"><span class="text-white">{{ $article->title }}</span></li>
          </ol>
        </div>
      </div>
    </div>
  </nav>

  <div id="section-site" class="page-x">
    <section class="bg-cover" style="background-image: url({{ $article->cover }});">
      <div style="background-color:rgba(255, 255, 255, 0.5);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 pt-8 pt-md-11">
            <h1 class="display-4 text-center">{{ $article->title }}</h1>
            <p class="lead mb-7 text-center">{{ $article->intro }}</p>

            <!-- Meta -->
            <div class="row align-items-center py-5 rounded-top" style="background-color: rgba(255, 255, 255, 0.8)">
              <div class="col-auto">
                <div class="avatar avatar-lg">
                  <img src="{{ asset('images/icon.png') }}" class="avatar-img rounded-circle">
                </div>
              </div>
              <div class="col ml-n5">
                <h5 class="text-uppercase mb-0">{{ $article->author }}</h5>
                <time class="font-size-sm text-muted" datetime="{{ $article->published_at }}">发布于 {{ $article->published_at }}</time>
              </div>

              <div class="col-auto">
                <span class="font-size-sm text-muted d-none d-md-inline mr-4">分享:</span>
                <ul class="d-inline list-unstyled list-inline list-social">
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="/assets/landkit/img/icons/social/instagram.svg" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="/assets/landkit/img/icons/social/facebook.svg" class="list-social-icon" alt="...">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item mr-3">
                    <a href="#!" class="text-decoration-none">
                      <img src="/assets/landkit/img/icons/social/twitter.svg" class="list-social-icon" alt="...">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <section class="pt-6 pt-md-8">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <div>{!! $article->content !!}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-8 mb-md-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <hr class="d-block mt-1 mb-3">
            <div class="py-5" style="background-color: rgba(200, 200, 200, 0.1)">
              <div class="text-center text-muted small">评论功能暂不可用</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
