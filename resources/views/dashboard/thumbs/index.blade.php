@extends('dashboard.layouts.default')

@section('mainBody')
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
                  <th>目标实体</th>
                  <th>目标用户</th>
                  <th>时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($thumbs as $thumb)
                  <tr>
                    <td>{{ $thumb->id }}</td>
                    <td>
                      <a href="#" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($thumb->user->avatar) }}" alt="{{ $thumb->user->app_id }}" class="avatar-img rounded-circle">
                      </a>
                      <span>{{ $thumb->user->nickname ?: 'NULL' }}</span>
                    </td>
                    <td><a>{{ $thumb->entity_name }}({{ $thumb->entity_id }})</a></td>
                    <td>
                      <a href="#" class="avatar avatar-xs d-inline-block me-2">
                        <img src="{{ asset($thumb->entity->user->avatar) }}" alt="{{ $thumb->entity->user->app_id }}" class="avatar-img rounded-circle">
                      </a>
                      <span>{{ $thumb->entity->user->nickname ?: 'NULL' }}</span>
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
@endsection
