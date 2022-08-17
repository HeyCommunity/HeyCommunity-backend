@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Articles</h6>
            <h1 class="header-title">文章</h1>
          </div>
          <div class="col-auto">
            <a href="{{ route('dashboard.articles.create') }}" class="btn btn-primary lift">创建文章</a>
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
                  <th>标题</th>
                  <th>作者</th>
                  <th>分类</th>
                  <th>标签</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                  <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->author }}</td>
                    <td>
                      @foreach ($article->categories as $category)
                        <span class="badge bg-primary-soft">{{ $category->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($article->tags as $tag)
                        <span class="badge bg-info-soft">{{ $tag->name }}</span>
                      @endforeach
                    </td>
                    <td>{{ $article->created_at }}</td>
                    <td>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.articles.edit', $article) }}">编辑</a>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.articles.show', $article) }}">详情</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $articles->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
