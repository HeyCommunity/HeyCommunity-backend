<div class="card">
  <div class="card-body">
    <!-- Header -->
    <div class="">
      <div class="row align-items-center">
        <div class="col-auto">
          <a href="{{ route('dashboard.users.show', $post->user) }}" class="avatar">
            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->nickname }}" class="avatar-img rounded-circle">
          </a>
        </div>

        <div class="col ms-n2">
          <h4 class="mb-1"><a href="{{ route('dashboard.users.show', $post->user) }}">{{ $post->user->nickname }}</a></h4>
          <p class="card-text small text-muted">
            <span class="fe fe-clock"></span>
            <time data-bs-toggle="tooltip" title="{{ $post->created_at->diffForHumans() }}">{{ $post->created_at }}</time>
          </p>
        </div>

        <div class="col-auto">
          <div class="dropdown">
            <a href="#" class="dropdown-ellipses dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fe fe-more-vertical"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <a href="#!" class="dropdown-item text-muted">No Operations</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="mt-3">{!! $post->content !!}</div>

    <!-- Images -->
    <div class="row mt-1 g-2">
      @foreach ($post->images as $image)
        <div class="col col-sm-6 col-md-4 col-auto">
          <img src="{{ $image->file_path }}" class="img-fluid rounded">
        </div>
      @endforeach
    </div>

    <!-- Footer -->
    <div class="mt-3">
      <div class="row">
        <div class="col">
          <a class="btn btn-sm btn-white">
            <i class="fe fe-thumbs-up"></i> {{ $post->thumb_up_num ?: null }}
          </a>
          <a class="btn btn-sm btn-white">
            <i class="fe fe-message-square"></i> {{ $post->comment_num ?: null }}
          </a>
        </div>
      </div>
    </div>
    <hr>

    <!-- Comments -->
    <div>
      @foreach ($post->comments as $comment)
        <div class="comment mb-0 mt-3">
          <div class="row">
            <div class="col-auto">
              <a class="avatar" href="{{ route('dashboard.users.show', $comment->user) }}">
                <img src="{{ $comment->user->avatar }}" class="avatar-img rounded-circle">
              </a>
            </div>
            <div class="col ms-n2">
              <div class="comment-body">
                <div class="row">
                  <div class="col">
                    <h5 class="comment-title"><a href="{{ route('dashboard.users.show', $comment->user) }}">{{ $comment->user->nickname }}</a></h5>
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
      @unless ($post->comments->count())
        <div class="small text-muted">无评论</div>
      @endunless
    </div>
  </div>
</div>

