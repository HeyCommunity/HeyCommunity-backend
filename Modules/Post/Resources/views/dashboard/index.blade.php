@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">Posts</h6>
            <h1 class="header-title">动态</h1>
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
                  <th>图片、视频</th>
                  <th>点赞/评论</th>
                  <th>更新时间</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                  <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                      <a href="{{ route('dashboard.users.show', $post->user) }}" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->nickname }}" class="avatar-img rounded-circle">
                      </a>
                      <a href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname ?: 'NULL' }}</a>
                    </td>

                    <!-- 内容 -->
                    <td>
                      @if (Str::length($post->content) > 100)
                        <span class="d-inline-block text-wrap" style="min-width:30em;">{{ Str::limit($post->content, 100 * 2) }}</span>
                      @else
                        <span>{{ $post->content }}</span>
                      @endif
                    </td>

                    <td>
                      @if ($post->video)
                        <a target="_blank" href="{{ $post->video->file_path }}">
                          <video src="{{ $post->video->file_path }}" style="margin:-10px 0; height:60px;"></video>
                        </a>
                      @endif
                      @if ($post->images)
                        @foreach ($post->images as $image)
                          <a target="_blank" href="{{ $image->file_path }}">
                            <img src="{{ asset($image->file_path) }}" style="height:40px; margin:-10px 0;">
                          </a>
                        @endforeach
                      @endif
                    </td>
                    <td>{{ $post->thumb_up_num }} / {{ $post->comment_num }}</td>
                    <td><span data-bs-toggle="tooltip" title="{{ $post->updated_at->diffForHumans() }}">{{ $post->updated_at }}</span></td>
                    <td><span data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</span></td>
                    <!-- 操作 -->
                    <td>
                      <a href="{{ route('dashboard.posts.show', $post) }}" class="btn btn-sm btn-light d-inline-block">详情</a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown"></button>
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

        <div class="mb-5">
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
