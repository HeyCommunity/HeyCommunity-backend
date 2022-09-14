@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  @include('dashboard.visitor-logs._header')

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-0">
            @include('dashboard.analytics.users._active-user-table', ['result' => $result])
          </div>
        </div>

        <div class="mb-5">
          {{ $result->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
