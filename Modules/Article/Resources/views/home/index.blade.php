@extends('layouts.default')
@section('pageTitle', '文章')

@section('mainBody')
  <nav id="section-breadcrumb" class="bg-gray-800">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Breadcrumb -->
          <ol class="breadcrumb breadcrumb-scroll">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">HEY社区</a></li>
            <li class="breadcrumb-item"><span class="text-white">文章</span></li>
          </ol>
        </div>
      </div>
    </div>
  </nav>

  <div id="section-site" class="page-x">
    <!-- 推荐文章 -->
    @if ($recommendArticles->count())
      <section class="pt-6">
        <div class="container">
          <div class="row align-items-center mb-5">
            <div class="col">
              <h3 class="mb-0">推荐阅读</h3>
              <p class="mb-0 text-muted">Recommend Articles</p>
            </div>
            <div class="col-auto">
              <a href="{{ route('articles.list') }}" class="btn btn-sm btn-primary-soft d-inline">所有文章</a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card card-row shadow-light-lg mb-6">
                <div class="row no-gutters">
                  <div class="col-12 col-md-6">
                    <div class="card-img-slider" style="min-height:200px;" data-flickity='{"fade": true, "imageLoaded": true, "pageDots": false, "prevNextButtons": false, "asNavFor": "#recommendArticleSlider", "draggable": false}'>
                      @foreach ($recommendArticles as $article)
                        <a class="bg-cover card-img-left" style="background-image: url({{ $article->cover }});" href="{{ route('articles.show', $article) }}">
                          <img src="{{ $article->cover }}" class="img-fluid d-md-none invisible">
                        </a>
                      @endforeach
                    </div>
                    <div class="shape shape-right shape-fluid-y svg-shim text-white d-none d-md-block">
                      <svg viewBox="0 0 112 690" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M116 0H51V172C76 384 0 517 0 517V690H116V0Z" fill="currentColor"></path>
                      </svg>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 position-static">
                    <div id="recommendArticleSlider" class="position-static flickity-button-white" data-flickity='{"wrapAround": true, "pageDots": false, "adaptiveHeight": true}' style="min-height:200px;">
                      @foreach ($recommendArticles as $article)
                        <div class="w-100">
                          <a class="card-body" href="{{ route('articles.show', $article) }}">
                            <h3>{{ $article->title }}</h3>
                            <p class="mb-0 text-muted">{{ $article->intro }}</p>
                          </a>

                          <!-- Meta -->
                          <a class="card-meta">
                            <hr class="card-meta-divider">

                            <div class="avatar avatar-sm mr-2">
                              <img src="{{ asset('images/icon.png') }}" class="avatar-img rounded-circle">
                            </div>

                            <h6 class="text-uppercase text-muted mr-2 mb-0">{{ $article->author }}</h6>
                            <p class="h6 text-uppercase text-muted mb-0 ml-auto"><time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('Y/m/d') }}</time></p>
                          </a>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

    <!-- 文章卡片 -->
    <section class="mt-7 mb-7">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col">
            <h3 class="mb-0">最新文章</h3>
            <p class="mb-0 text-muted">Latest Articles</p>
          </div>
          <div class="col-auto">
            <a href="{{ route('articles.list') }}" class="btn btn-sm btn-primary-soft d-inline">所有文章</a>
          </div>
        </div>
        <div class="row">
          @foreach ($latestArticles as $article)
            <div class="col-12 col-lg-4 d-flex">
              <div class="card mb-6 mb-lg-0 shadow-light-lg lift lift-lg">
                <a class="card-img-top" href="{{ route('articles.show', $article) }}"><img src="{{ $article->cover }}" class="card-img-top"></a>

                <!-- Body -->
                <a class="card-body" href="{{ route('articles.show', $article) }}">
                  <h3>{{ $article->title }}</h3>
                  <p class="mb-0 text-muted">{{ $article->intro }}</p>
                </a>

                <!-- Meta -->
                <a class="card-meta mt-auto">
                  <hr class="card-meta-divider">
                  <div class="avatar avatar-sm mr-2">
                    <img src="{{ asset('images/icon.png') }}" class="avatar-img rounded-circle">
                  </div>
                  <h6 class="text-uppercase text-muted mr-2 mb-0">{{ $article->author }}</h6>
                  <p class="h6 text-uppercase text-muted mb-0 ml-auto">
                    <time datetime="2019-05-02">{{ $article->created_at->format('Y/m/d') }}</time>
                  </p>
                </a>
              </div>
            </div>
          @endforeach
          @unless ($latestArticles->count())
            <div class="col-12">
              <div class="rounded bg-gray-200 text-gray-800 p-3 pl-4 text-center text-md-left">暂无内容</div>
            </div>
          @endunless
        </div>
      </div>
    </section>
  </div>
@endsection
