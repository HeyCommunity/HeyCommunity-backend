@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle">User Reports</h6>
            <h1 class="header-title">用户报告</h1>
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
                  <th>报告人</th>
                  <th>目标实体</th>
                  <th>时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userReports as $userReport)
                  <tr>
                    <td>{{ $userReport->id }}</td>
                    <td>
                      @if ($userReport->avatar)
                        <a href="{{ route('dashboard.users.show', $userReport->user) }}" class="avatar avatar-xs d-inline-block me-2">
                          <img src="{{ asset($userReport->user->avatar) }}" alt="{{ $userReport->user->nickname }}" class="avatar-img rounded-circle">
                        </a>
                      @endif
                      <a class="text-black" href="{{ route('dashboard.users.show', $userReport->user) }}">{{ $userReport->user->nickname ?: 'NULL' }}</a>
                    </td>

                    <td>
                      {{ $userReport->entity_class }}: {{ $userReport->entity_id }}
                    </td>

                    <td><span data-bs-toggle="tooltip" title="{{ $userReport->created_at->diffForHumans() }}">{{ $userReport->created_at }}</span></td>

                    <td><span class="text-muted">-</span></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-5">
          {{ $userReports->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
