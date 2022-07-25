@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
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
                  <th>用户</th>
                  <th>目标实体</th>
                  <th>目标用户</th>
                  <th>内容</th>
                  <th>点赞/评论</th>
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
                    <td>
                      <a class="d-block" href="#">{{ $comment->entity_name }}({{ $comment->entity_id }})</a>
                      @if ($comment->parent)
                        <a class="d-block mt-1" href="#">评论({{ $comment->parent->id }})</a>
                      @endif
                    </td>
                    @if ($comment->parent)
                      <td>
                        <a href="#" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($comment->parent->user->avatar) }}" alt="{{ $comment->parent->user->app_id }}" class="avatar-img rounded-circle">
                        </a>
                        <span>{{ $comment->parent->user->nickname ?: 'NULL' }}</span>
                      </td>
                    @else
                      <td>
                        <a href="#" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($comment->commentable->user->avatar) }}" alt="{{ $comment->commentable->user->app_id }}" class="avatar-img rounded-circle">
                        </a>
                        <span>{{ $comment->commentable->user->nickname ?: 'NULL' }}</span>
                      </td>
                    @endif
                    <td><span data-bs-toggle="tooltip" title="{{ $comment->content }}">{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</span></td>
                    <td>{{ $comment->thumb_up_num }} / {{ $comment->comment_num }}</td>
                    <td><span data-bs-toggle="tooltip" title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at }}</span></td>
                    <td>/</td>
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
</div>
@endsection
