<div class="col-12 col-md-6 col-xl-4">
  <div class="card">
    <a href="{{ route('web.activities.show', $activity) }}">
      <img src="{{ $activity->cover }}" class="card-img-top">
    </a>

    <div class="card-body">
      <h4 class="mb-2 name text-nowrap overflow-hidden text-truncate">
        <a href="{{ route('web.activities.show', $activity) }}">{{ $activity->title }}</a>
      </h4>

      <div class="card-text small">
        <div class="row">
          <div class="col">
            <div>{{ $activity->started_at->diffForHumans() }}</div>
          </div>

          <div class="col-auto">
            <div class="text-muted">{{ $activity->total_ticket_num - $activity->surplus_ticket_num }}/{{ $activity->total_ticket_num }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
