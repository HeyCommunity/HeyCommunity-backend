@php
  if (! isset($title)) $title = '评论';

  // users.show routeName
  if (! isset($userShowRouteName)) $userShowRouteName = 'web.users.show';
  if (request()->routeIs('dashboard.*')) $userShowRouteName = 'dashboard.users.show';
@endphp

<div class="card">
  <div class="card-header">
    <div class="card-header-title">{{ $title }}</div>
    <div><span class="badge bg-secondary-soft">{{ $comments->count() }}</span></div>
  </div>
  <div class="card-body {{ $comments->count() ? 'mb-n3' : '' }}">
    @if ($comments->count())
      @foreach ($comments as $comment)
        <div class="comment mb-3">
          <div class="row">
            <div class="col-auto">
              <a class="avatar" href="{{ route($userShowRouteName, $comment->user) }}">
                <img src="{{ $comment->user->avatar }}" class="avatar-img rounded-circle">
              </a>
            </div>
            <div class="col ms-n2">
              <div class="comment-body w-100">
                <div class="row">
                  <div class="col">
                    <h5 class="comment-title"><a href="{{ route($userShowRouteName, $comment->user)  }}">{{ $comment->user->nickname }}</a></h5>
                  </div>
                  <div class="col-auto">
                    <time class="comment-time" data-bs-toggle="tooltip" title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at }}</time>
                  </div>
                </div>
                <p class="comment-text">{{ $comment->content }}</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div><span class="text-muted fs-sm">暂无数据</span></div>
    @endif
  </div>
</div>

