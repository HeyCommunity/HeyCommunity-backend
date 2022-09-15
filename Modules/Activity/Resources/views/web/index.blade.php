@extends('web.layouts.default')

@section('mainContent')
  <div class="main-content">
    <div class="container mt-4">
      <div class="row">
        @foreach ($activities as $activity)
          <div class="col-12 col-md-6 col-xl-3">
            @include('activity::common._activity-lite-card', ['activity' => $activity])
          </div>
        @endforeach

        @unless ($activities->count())
          <div class="card">
            <div class="card-body">暂无活动</div>
          </div>
        @endunless

        <div id="section-pagination">
          <div class="d-none d-sm-block">
            {{ $activities->links() }}
          </div>
          <div class="d-sm-none d-flex justify-content-center">
            {{ $activities->links('pagination::simple-bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
