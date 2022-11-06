@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Article Tags</h6>
            <h1 class="header-title">文章标签</h1>
          </div>
          <div class="col-auto">
            <a href="{{ route('dashboard.article-tags.create') }}" class="btn btn-primary lift">新增标签</a>
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
                  <th>标识</th>
                  <th>名称</th>
                  <th>描述</th>
                  <th>文章数</th>
                  <th>创建时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articleTags as $tag)
                  <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->description }}</td>
                    <td>{{ $tag->articles()->count() }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>
                      <a href="{{ route('dashboard.article-tags.edit', $tag) }}" class="btn btn-sm btn-light lift"><i class="fe fe-edit"></i></a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle lift" data-bs-toggle="dropdown"></button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                          <a class="dropdown-item text-danger" href="{{ route('dashboard.article-tags.delete', $tag) }}">删除</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $articleTags->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
