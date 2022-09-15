@extends('web.layouts.default')

@section('metaDescription', $activity->intro)

@section('mainContent')
  <style rel="stylesheet">
    .quill-html p {
      margin-bottom: 0 !important;
    }
  </style>

  <div class="main-content">
    <div class="header mb-0">
      <div class="bg-cover header-img-top"
           style="background-image:url({{ $activity->cover }}); height:300px"></div>
    </div>

    <div class="container mt-n6">
      <div class="row">
        <div class="col-12 col-lg-8">
          @include('activity::common._activity-profile', ['activity' => $activity, 'showTopCover' => false])

          <div class="d-block d-lg-none">
            @include('common._up-thumbs-card', ['thumbs' => $activity->upThumbs])

            @include('activity::common._activity-members-card', ['activity' => $activity])
          </div>

          @include('common._comments-card', ['comments' => $activity->comments])
        </div>

        <!-- 侧边栏 -->
        <div class="col-12 col-lg-4 d-none d-lg-block">
          @include('activity::common._activity-info-card', ['activity' => $activity])

          @include('common._up-thumbs-card', ['thumbs' => $activity->upThumbs])

          @include('activity::common._activity-members-card', ['activity' => $activity])
        </div>
      </div>
    </div>
  </div>
@endsection
