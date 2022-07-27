@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">ThumbUp</h6>
            <h1 class="header-title">点赞</h1>
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
                  <th>目标用户</th>
                  <th>目标实体</th>
                  <th>时间</th>
                  <th>操作</th>
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
                      <a href="{{ route('dashboard.users.show', $thumb->user) }}">{{ $thumb->user->nickname ?: 'NULL' }}</a>
                    </td>

                    <td>
                      <a href="{{ route('dashboard.users.show', $thumb->thumbable->user) }}" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($thumb->thumbable->user->avatar) }}" alt="{{ $thumb->thumbable->user->app_id }}" class="avatar-img rounded-circle">
                      </a>
                      <a href="{{ route('dashboard.users.show', $thumb->thumbable->user) }}">{{ $thumb->thumbable->user->nickname ?: 'NULL' }}</a>
                    </td>

                    <!-- 目标实体 -->
                    <td>
                      @if ($thumb->entity_class === \Modules\Post\Entities\Post::class)
                        <a href="{{ route('dashboard.posts.show', $thumb->entity_id) }}">{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</a>
                      @elseif ($thumb->entity_class === \App\Models\Common\Comment::class)
                        @if ($thumb->entity->entity_class === \Modules\Post\Entities\Post::class)
                          <a class="d-block" href="{{ route('dashboard.posts.show', $thumb->entity->entity_id) }}">{{ $thumb->entity->entity_name }}(ID:{{ $thumb->entity->entity_id }})</a>
                          <a href="{{ route('dashboard.comments.show', $thumb->entity->id) }}">{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</a>
                        @else
                          <span>{{ $thumb->entity_name }}(ID:{{ $thumb->entity_id }})</span>
                        @endif

                      @endif
                    </td>

                    <td><span data-bs-toggle="tooltip" title="{{ $thumb->created_at->diffForHumans() }}">{{ $thumb->created_at }}</span></td>
                    <td>/</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $thumbs->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
