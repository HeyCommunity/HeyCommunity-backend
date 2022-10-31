@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Template</h6>
            <h1 class="header-title">模板</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="table-responsive mb-0">
            <table class="table table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>创建时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @unless($models->count())
                  <tr><td colspan="100">暂无数据</td></tr>
                @endunless

                @foreach ($models as $model)
                  <tr>
                    <td>{{ $model->id }}</td>
                    <td>{{ $model->created_at }}</td>
                    <td>
                      <a href="" class="btn btn-sm btn-light d-inline-block lift"><i class="fe fe-eye"></i></a>
                      <a href="" class="btn btn-sm btn-light d-inline-block lift"><i class="fe fe-edit-2"></i></a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle lift" data-bs-toggle="dropdown"></button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                          <a class="dropdown-item text-muted">No Operations</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">{{ $models->links() }}</div>
      </div>
    </div>
  </div>
</div>
@endsection
