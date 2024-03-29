<div class="card">
  <div class="card-header">
    <h4 class="card-header-title">近 7 天新增点赞</h4>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive mb-0">
      <div class="table-responsive mb-0">
        <table class="table table-sm table-nowrap card-table">
          <thead>
          <tr>
            <th>ID</th>
            <th>用户</th>
            <th>目标用户</th>
            <th>目标实体</th>
            <th>时间</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($thumbs as $thumb)
            <tr>
              <td>{{ $thumb->id }}</td>
              <td>
                <a href="{{ route('dashboard.users.show', $thumb->user) }}" class="avatar avatar-xs d-inline-block me-2">
                  <img src="{{ asset($thumb->user->avatar) }}" alt="{{ $thumb->user->id }}" class="avatar-img rounded-circle">
                </a>
                <a class="text-reset" href="{{ route('dashboard.users.show', $thumb->user) }}">{{ $thumb->user->nickname ?: 'NULL' }}</a>
              </td>

              <td>
                <a href="{{ route('dashboard.users.show', $thumb->thumbable->user) }}" class="avatar avatar-xs d-inline-block me-2">
                  <img src="{{ asset($thumb->thumbable->user->avatar) }}" alt="{{ $thumb->thumbable->user->app_id }}" class="avatar-img rounded-circle">
                </a>
                <a class="text-reset" href="{{ route('dashboard.users.show', $thumb->thumbable->user) }}">{{ $thumb->thumbable->user->nickname ?: 'NULL' }}</a>
              </td>

              <!-- 目标实体 -->
              <td>
                @if ($thumb->entity_class === \Modules\Post\Entities\Post::class)
                  <a class="d-block text-reset" href="{{ route('dashboard.posts.show', $thumb->entity_id) }}">{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</a>
                @elseif ($thumb->entity_class === \App\Models\Common\Comment::class)
                  @if ($thumb->entity->entity_class === \Modules\Post\Entities\Post::class)
                    <a class="d-block text-reset" href="{{ route('dashboard.posts.show', $thumb->entity->entity_id) }}">{{ $thumb->entity->entity_name }}(ID:{{ $thumb->entity->entity_id }})</a>
                    <a class="d-block text-reset" href="{{ route('dashboard.comments.show', $thumb->entity->id) }}">{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</a>
                  @else
                    <span>{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</span>
                  @endif
                @endif
              </td>

              <td><span data-bs-toggle="tooltip" title="{{ $thumb->created_at }}">{{ $thumb->created_at->diffForHumans() }}</span></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
