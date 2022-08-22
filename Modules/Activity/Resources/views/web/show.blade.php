@extends('web.layouts.default')

@section('mainContent')
  <div class="main-content">
    <div class="header mb-0">
      <div class="bg-cover header-img-top"
           style="background-image:url({{ $activity->cover }}); height:300px"></div>
    </div>

    <div class="container mt-n6">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h2 class="h1 card-title">{{ $activity->title }}</h2>
            <div class="card-text">{!! $activity->content !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
