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
                  <th>状态</th>
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
                      <a class="text-black" href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname ?: 'NULL' }}</a>
                    </td>

                    <!-- 内容 -->
                    <td>
                      <div class="text-wrap" style="min-width:20em; max-width:35em;">
                        @if (Str::length($post->content) > 100)
                          {{ Str::limit($post->content, 100 * 2) }}
                        @else
                          {{ $post->content }}
                        @endif
                      </div>
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

                    <!-- 状态 -->
                    <td>
                      @if ($post->status === 0)
                        <span class="badge bg-secondary-soft">{{ $post->status_name }}</span>
                      @elseif ($post->status === 1)
                        <span class="badge bg-success-soft">{{ $post->status_name }}</span>
                      @elseif ($post->status === 2)
                        <span class="badge bg-warning-soft">{{ $post->status_name }}</span>
                      @endif
                    </td>

                    <!-- 操作 -->
                    <td>
                      <a href="{{ route('dashboard.posts.show', $post) }}" class="btn btn-sm btn-light d-inline-block lift">详情</a>

                      <div class="btn-group d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle lift" data-bs-toggle="dropdown"></button>
                        <div class="mt-1 dropdown-menu dropdown-menu-end dropdown-menu-sm">
                          <a class="dropdown-item" target="_blank" href="{{ route('web.posts.show', $post) }}">前台详情</a>
                          <div class="dropdown-divider my-1"></div>
                          @if ($post->status === 2)
                            <a class="dropdown-item" href="{{ route('dashboard.posts.set-visible', $post) }}">上架</a>
                          @elseif ($post->status === 1)
                            <a class="dropdown-item text-danger" href="{{ route('dashboard.posts.set-hidden', $post) }}">下架</a>
                          @endif
                          <a class="dropdown-item text-danger" href="{{ route('dashboard.posts.destroy', $post) }}">删除</a>
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
