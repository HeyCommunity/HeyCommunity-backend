@extends('dashboard.layouts.default')

@section('mainBody')
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
                      <a href="#" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->nickname }}" class="avatar-img rounded-circle">
                      </a>
                      <span>{{ $post->user->nickname ?: 'NULL' }}</span>
                    </td>
                    <td><span data-bs-toggle="tooltip" title="{{ $post->content }}">{{ \Illuminate\Support\Str::limit($post->content, 50) }}</span></td>
                    <td>
                      @if ($post->video)
                        <video src="{{ $post->video->file_path }}" style="margin:-10px 0; height:60px;"></video>
                      @endif
                      @if ($post->images)
                        @foreach ($post->images as $image)
                            <img src="{{ asset($image->file_path) }}" class="" style="height:40px; margin:-10px 0;">
                        @endforeach
                      @endif
                    </td>
                    <td>{{ $post->thumb_up_num }} / {{ $post->comment_num }}</td>
                    <td><span data-bs-toggle="tooltip" title="{{ $post->updated_at->diffForHumans() }}">{{ $post->updated_at }}</span></td>
                    <td><span data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</span></td>
                    <td>/</td>
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
@endsection
