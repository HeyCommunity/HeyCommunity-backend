@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Article Categories</h6>
            <h1 class="header-title">文章分类</h1>
          </div>
          <div class="col-auto">
            <a href="{{ route('dashboard.article-categories.create') }}" class="btn btn-primary lift">新增分类</a>
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
                @foreach ($articleCategories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->articles()->count() }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                      <a href="{{ route('dashboard.article-categories.edit', $category) }}" class="btn btn-sm btn-light lift"><i class="fe fe-edit"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $articleCategories->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
