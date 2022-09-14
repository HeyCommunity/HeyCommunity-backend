@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container">
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

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="table-responsive mb-0">
            <table class="table table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>封面</th>
                  <th>标题</th>
                  <th>分类</th>
                  <th>标签</th>
                  <th>点赞 / 评论</th>
                  <th>状态</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                  <tr>
                    <td>{{ $article->id }}</td>
                    <td>
                      <a target="_blank" href="{{ $article->cover }}">
                        <img src="{{ asset($article->cover) }}" style="height:40px;">
                      </a>
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>
                      @foreach ($article->categories as $category)
                        <span class="badge bg-primary-soft">{{ $category->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($article->tags as $tag)
                        <span class="badge bg-secondary-soft">{{ $tag->name }}</span>
                      @endforeach
                    </td>
                    <td>{{ $article->thumb_up_num }} / {{ $article->comment_num }}</td>
                    <!-- 状态 -->
                    <td>
                      @if ($article->status === 0)
                        <span class="badge bg-secondary-soft">{{ $article->status_name }}</span>
                      @elseif ($article->status === 1)
                        <span class="badge bg-success-soft">{{ $article->status_name }}</span>
                      @elseif ($article->status === 2)
                        <span class="badge bg-warning-soft">{{ $article->status_name }}</span>
                      @endif
                    </td>
                    <td>{{ $article->published_at }}</td>
                    <td>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.articles.edit', $article) }}"><i class="fe fe-edit"></i></a>
                      <a class="btn btn-light btn-sm lift" href="{{ route('dashboard.articles.show', $article) }}"><i class="fe fe-eye"></i></a>
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
