@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Edit ArticleCategory</h6>
            <h1 class="header-title">更新文章分类</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div id="section-content">
              <form id="form-article" action="{{ route('dashboard.article-categories.update', $articleCategory) }}" method="POST">
                @method('patch')
                @csrf

                @include('article::dashboard.article-categories._form')

                <button type="submit" class="btn w-100 btn-primary">更新</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
