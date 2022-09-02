@extends('web.layouts.default')

@section('mainContent')
  <style rel="stylesheet">
    .quill-html p {
      margin-bottom: 0 !important;
    }
  </style>

  <div class="main-content">
    <div class="header mb-0">
      <div class="bg-cover header-img-top"
           style="background-image:url({{ $article->cover }}); height:300px"></div>
    </div>

    <div class="container mt-n6">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h2 class="h1 card-title">{{ $article->title }}</h2>
            <div class="card-text quill-html">{!! $article->content !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
