@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="header">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">New ArticleTag</h6>
                <h1 class="header-title">新增文章标签</h1>
              </div>
            </div>
          </div>
        </div>

        <div id="section-content">
          <form id="form-article" class="mb-4" action="{{ route('dashboard.article-tags.store') }}" method="POST">
            {{ csrf_field() }}

            @include('article::dashboard.article-tags._form')

            <button type="submit" class="btn w-100 btn-primary">创建</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
