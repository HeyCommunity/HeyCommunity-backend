@extends('layouts.default')
@section('pageTitle', '所有文章')

@section('mainBody')
  <nav id="section-breadcrumb" class="bg-gray-800">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Breadcrumb -->
          <ol class="breadcrumb breadcrumb-scroll">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">HEY社区</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.list') }}" class="text-white">文章</a></li>
            <li class="breadcrumb-item active"><span class="text-white">所有文章</span></li>
          </ol>
        </div>
      </div>
    </div>
  </nav>

  <div id="section-site" class="page-x">
    <section class="mt-6">
      <div class="container">
        <ul class="nav justify-content-start nav-pills nav-fill">
          <li class="nav-item"><a class="nav-link btn-sm {{ request()->get('slug') ? 'text-dark' : 'bg-secondary text-white' }}" href="{{ route('articles.list') }}">所有</a></li>
          @foreach ($categories as $category)
            <li class="nav-item">
              <a class="nav-link btn-sm {{ request()->get('slug') === $category->slug ? 'bg-secondary text-white' : 'text-dark' }}"
                 href="{{ route('articles.list', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
            </li>
          @endforeach
        </ul>
      </div>
    </section>


    <!-- 文章卡片 -->
    <section class="">
      <div class="container">
        <div class="row">
          @foreach ($articles as $article)
            <div class="col-12 col-md-6 col-lg-4 d-flex mt-5">
              <div class="card shadow-light-lg lift lift-lg">
                <a class="card-img-top" href="{{ route('articles.show', $article) }}"><img src="{{ $article->cover }}" class="card-img-top"></a>

                <!-- Body -->
                <a class="card-body" href="{{ route('articles.show', $article) }}">
                  <h3>{{ $article->title }}</h3>
                  <p class="mb-0 text-muted">{{ $article->intro }}</p>
                </a>
              </div>
            </div>
          @endforeach
          @unless ($articles->count())
            <div class="col-12 mt-5">
              <div class="rounded bg-gray-200 text-gray-800 p-3 pl-4 text-center text-md-left">暂无内容</div>
            </div>
          @endunless
        </div>
      </div>

      <section class="my-7 container">
        <div class="d-none d-md-block">
          {{ $articles->onEachSide(1)->links() }}
        </div>
        <div class="d-block d-md-none">
          {{ $articles->links('pagination::simple-bootstrap-4') }}
        </div>
      </section>
      </section>
    </section>
  </div>
@endsection
