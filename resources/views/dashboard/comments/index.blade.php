@extends('dashboard.layouts.default')

@section('mainBody')
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Comments</h6>
            <h1 class="header-title">评论</h1>
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
                  <th>作者</th>
                  <th>内容</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($comments as $comment)
                  <tr>
                    <td>{{ $comment->id }}</td>
                    <td>
                      <a href="#" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->app_id }}" class="avatar-img rounded-circle">
                      </a>
                      <span>{{ $comment->user->nickname ?: 'NULL' }}</span>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $comments->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
