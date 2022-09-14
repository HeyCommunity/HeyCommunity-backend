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
                <h6 class="header-pretitle">Activity Detail</h6>
                <h1 class="header-title">活动详情</h1>
              </div>

              <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-light lift"><i class="fe fe-chevron-left"></i> 返回</a>
                <a target="_blank" href="{{ route('web.activities.show', $activity) }}" class="btn btn-light lift"><i class="fe fe-eye"></i> 前台查看</a>
              </div>
            </div>
          </div>
        </div>

        <div id="section-content">
          <div class="row">
            <div class="col-12 col-lg-8">
              @include('activity::common._activity-profile', ['activity' => $activity])

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
    </div>
  </div>
</div>
@endsection
