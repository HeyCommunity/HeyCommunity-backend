<div class="card">
  <div class="card-header">
    <h4 class="card-header-title">近 7 天动态增长</h4>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive mb-0">
      <div class="table-responsive mb-0">
        <table class="table table-sm table-nowrap card-table">
          <thead>
          <tr>
            <th>ID</th>
            <th>作者</th>
            <th>内容</th>
            <th>图片/视频</th>
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
                <a class="text-reset" href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname ?: 'NULL' }}</a>
              </td>

              <!-- 内容 -->
              <td><span class="d-inline-block text-wrap" style="min-width:20em;">{{ Str::limit($post->content, 80) }}</span></td>

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
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
