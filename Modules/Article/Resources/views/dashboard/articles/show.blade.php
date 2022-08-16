@extends('dashboard.layouts.default')

@section('mainBody')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="header">
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                <h6 class="header-pretitle">Article Detail</h6>
                <h1 class="header-title">文章详情</h1>
              </div>
            </div>
          </div>
        </div>

        <div id="section-content">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title">{{ $article->title }}</h4>
            </div>
            <div class="card-body">
              <div class="mb-3">{!! $article->content !!}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection