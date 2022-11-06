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
          <div class="col-auto">
            <a href="{{ route('dashboard.carousels.create', ['type' => request('type')]) }}" class="btn btn-primary lift"><i class="fe fe-plus"></i> 新增</a>
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
                  <th>类型</th>
                  <th>图片</th>
                  <th>标题</th>
                  <th>链接</th>
                  <th>排序</th>
                  <th>状态</th>
                  <th>创建时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @unless($carousels->count())
                  <tr><td colspan="100">暂无数据</td></tr>
                @endunless

                @foreach ($carousels as $carousel)
                  <tr>
                    <td>{{ $carousel->id }}</td>
                    <td>{{ \App\Models\Carousel::$types[$carousel->type] ?? '未知' }}</td>
                    <td>
                      <a target="_blank" href="{{ asset($carousel->image_path) }}">
                        <img src="{{ asset($carousel->image_path) }}" style="height:40px;">
                      </a>
                    </td>
                    <td>{{ $carousel->title }}</td>
                    <td>{{ $carousel->link }}</td>
                    <td>{{ $carousel->sort }}</td>
                    <td>{{ \App\Models\Carousel::$statuses[$carousel->status] ?? '未知' }}</td>
                    <td>{{ $carousel->created_at }}</td>
                    <td>
                      <a href="{{ route('dashboard.carousels.edit', $carousel) }}" class="btn btn-sm btn-light d-inline-block lift"><i class="fe fe-edit-2"></i></a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle lift" data-bs-toggle="dropdown"></button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                          <a class="dropdown-item text-danger" href="{{ route('dashboard.carousels.delete', $carousel) }}">删除</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">{{ $carousels->links() }}</div>
      </div>
    </div>
  </div>
</div>
@endsection
