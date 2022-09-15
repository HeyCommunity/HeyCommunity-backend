@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Edit Activity</h6>
            <h1 class="header-title">编辑活动</h1>
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
              <script type="text/javascript">
                function formSubmit(event) {
                  document.querySelector('#input-content').value = document.querySelector('#quill-content').firstChild.innerHTML;
                  // event.preventDefault();
                }
              </script>

              <form id="form" action="{{ route('dashboard.activities.update', $activity) }}" method="POST"
                    enctype="multipart/form-data"
                    onsubmit="formSubmit(event)">
                {{ csrf_field() }}

                @include('activity::dashboard._form')

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
