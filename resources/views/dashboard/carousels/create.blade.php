@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Carousels</h6>
            <h1 class="header-title">焦点图</h1>
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
              <form id="form-article" action="{{ route('dashboard.carousels.store') }}" method="POST"
                    enctype="multipart/form-data"
                    onsubmit="formSubmit(event)">
                {{ csrf_field() }}

                @include('dashboard.carousels._form')

                <button type="submit" class="btn w-100 btn-primary">创建</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
