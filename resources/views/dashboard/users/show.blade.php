@extends('dashboard.layouts.default')

@section('mainBody')
<div class="header">
  <div class="bg-cover header-img-top" style="background-image:url({{ asset($user->cover) }}); height:260px"></div>

  <div class="container-fluid">

    <!-- Body -->
    <div class="header-body mt-n5 mt-md-n6">
      <div class="row align-items-end">
        <div class="col-auto">
          <div class="avatar avatar-xxl header-avatar-top">
            <img src="{{ $user->avatar }}" alt="{{ $user->nickname }}" class="avatar-img rounded-circle border border-4 border-body">
          </div>
        </div>

        <div class="col mb-3 ms-n3 ms-md-n2">
          <h6 class="header-pretitle">{{ $user->bio ?: 'No Bio' }}</h6>
          <h1 class="header-title">{{ $user->nickname }}</h1>
        </div>
        <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">

          <!-- Button -->
          <a href="#!" class="btn btn-primary d-block d-md-inline-block lift">
            Subscribe
          </a>

        </div>
      </div> <!-- / .row -->
      <div class="row align-items-center">
        <div class="col">

          <!-- Nav -->
          <ul class="nav nav-tabs nav-overflow header-tabs">
            <li class="nav-item">
              <a href="profile-posts.html" class="nav-link active">
                Posts
              </a>
            </li>
            <li class="nav-item">
              <a href="profile-groups.html" class="nav-link">
                Groups
              </a>
            </li>
            <li class="nav-item">
              <a href="profile-projects.html" class="nav-link">
                Projects
              </a>
            </li>
            <li class="nav-item">
              <a href="profile-files.html" class="nav-link">
                Files
              </a>
            </li>
            <li class="nav-item">
              <a href="profile-subscribers.html" class="nav-link">
                Subscribers
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div> <!-- / .header-body -->

  </div>
</div>


<!-- CONTENT -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-xl-8">

      <!-- Card -->
      <div class="card">
        <div class="card-body">

          <!-- Header -->
          <div class="mb-3">
            <div class="row align-items-center">
              <div class="col-auto">

                <!-- Avatar -->
                <a href="#!" class="avatar">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Title -->
                <h4 class="mb-1">
                  Dianna Smiley
                </h4>

                <!-- Time -->
                <p class="card-text small text-muted">
                  <span class="fe fe-clock"></span> <time datetime="2018-05-24">4hr ago</time>
                </p>

              </div>
              <div class="col-auto">

                <!-- Dropdown -->
                <div class="dropdown">
                  <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fe fe-more-vertical"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="#!" class="dropdown-item">
                      Action
                    </a>
                    <a href="#!" class="dropdown-item">
                      Another action
                    </a>
                    <a href="#!" class="dropdown-item">
                      Something else here
                    </a>
                  </div>
                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Text -->
          <p class="mb-3">
            I've been working on shipping the latest version of Launchday. The story I'm trying to focus on is something like "You're launching soon and need to be 100% focused on your product. Don't lose precious days designing, coding, and testing a product site. Instead, build one in minutes."
          </p>

          <!-- Text -->
          <p class="mb-4">
            What do you y'all think? Would love some feedback from <a href="#!" class="badge bg-primary-soft">@Ab</a> or <a href="#!" class="badge bg-primary-soft">@Adolfo</a>?
          </p>

          <!-- Image -->
          <p class="text-center mb-3">
            <img src="/assets/dashkit/img/posts/post-1.jpg" alt="..." class="img-fluid rounded">
          </p>

          <div class="mb-3">
            <div class="row">
              <div class="col">

                <!-- Buttons -->
                <a href="#!" class="btn btn-sm btn-white">
                  😬 1
                </a>
                <a href="#!" class="btn btn-sm btn-white">
                  👍 2
                </a>
                <a href="#!" class="btn btn-sm btn-white">
                  Add Reaction
                </a>

              </div>
              <div class="col-auto me-n3">

                <!-- Avatar group -->
                <div class="avatar-group d-none d-sm-flex">
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Ab Hadley">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Adolfo Hess">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Daniela Dewitt">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-4.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Miyah Myles">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-5.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                </div>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="#!" class="btn btn-sm btn-white">
                  Share
                </a>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Divider -->
          <hr>

          <!-- Comments -->
          <div class="comment mb-3">
            <div class="row">
              <div class="col-auto">

                <!-- Avatar -->
                <a class="avatar" href="profile-posts.html">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Body -->
                <div class="comment-body">

                  <div class="row">
                    <div class="col">

                      <!-- Title -->
                      <h5 class="comment-title">
                        Ab Hadley
                      </h5>

                    </div>
                    <div class="col-auto">

                      <!-- Time -->
                      <time class="comment-time">
                        11:12
                      </time>

                    </div>
                  </div> <!-- / .row -->

                  <!-- Text -->
                  <p class="comment-text">
                    Looking good Dianna! I like the image grid on the left, but it feels like a lot to process and doesn't really <em>show</em> me what the product does? I think using a short looping video or something similar demo'ing the product might be better?
                  </p>

                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <div class="comment mb-3">
            <div class="row">
              <div class="col-auto">

                <!-- Avatar -->
                <a class="avatar" href="profile-posts.html">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Body -->
                <div class="comment-body">

                  <div class="row">
                    <div class="col">

                      <!-- Title -->
                      <h5 class="comment-title">
                        Adolfo Hess
                      </h5>

                    </div>
                    <div class="col-auto">

                      <!-- Time -->
                      <time class="comment-time">
                        11:12
                      </time>

                    </div>
                  </div> <!-- / .row -->

                  <!-- Text -->
                  <p class="comment-text">
                    Any chance you're going to link the grid up to a public gallery of sites built with Launchday?
                  </p>

                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Divider -->
          <hr>

          <!-- Form -->
          <div class="row">
            <div class="col-auto">

              <!-- Avatar -->
              <div class="avatar avatar-sm">
                <img src="/assets/dashkit/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
              </div>

            </div>
            <div class="col ms-n2">

              <!-- Input -->
              <form class="mt-1">
                <label class="visually-hidden">Leave a comment...</label>
                <textarea class="form-control form-control-flush" data-autosize rows="1" placeholder="Leave a comment"></textarea>
              </form>

            </div>
            <div class="col-auto align-self-end">

              <!-- Icons -->
              <div class="text-muted mb-2">
                <a class="text-reset me-3" href="#" data-bs-toggle="tooltip" title="Add photo">
                  <i class="fe fe-camera"></i>
                </a>
                <a class="text-reset me-3" href="#" data-bs-toggle="tooltip" title="Attach file">
                  <i class="fe fe-paperclip"></i>
                </a>
                <a class="text-reset" href="#" data-bs-toggle="tooltip" title="Record audio">
                  <i class="fe fe-mic"></i>
                </a>
              </div>

            </div>
          </div> <!-- / .row -->

        </div>
      </div>

      <!-- Card -->
      <div class="card">
        <div class="card-body">

          <!-- Header -->
          <div class="mb-3">
            <div class="row align-items-center">
              <div class="col-auto">

                <!-- Avatar -->
                <a href="#!" class="avatar">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Title -->
                <h4 class="mb-1">
                  Dianna Smiley
                </h4>

                <!-- Time -->
                <p class="card-text small text-muted">
                  <span class="fe fe-clock"></span> <time datetime="2018-05-24">4hr ago</time>
                </p>

              </div>
              <div class="col-auto">

                <!-- Dropdown -->
                <div class="dropdown">
                  <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fe fe-more-vertical"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="#!" class="dropdown-item">
                      Action
                    </a>
                    <a href="#!" class="dropdown-item">
                      Another action
                    </a>
                    <a href="#!" class="dropdown-item">
                      Something else here
                    </a>
                  </div>
                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Text -->
          <p class="mb-3">
            I've spent a lot of time thinking about our design process and trying to figure out a better order for us to tackle things. Right now it feels like we're everywhere with tools and process, so here's my suggestion:
          </p>

          <!-- List -->
          <ol class="mb-3">
            <li><strong>Define the goals</strong>: Create a template for expressing what the purpose of a project is and why we're investing time and money in tackling it.</li>
            <li><strong>Sketch a solution</strong>: Use tried and true paper and pencil to express ideas and share them with others at the company before going too deep on design.</li>
            <li><strong>User test with Figma</strong>: Use the page linking in Figma to get a rough clickable prototype and test this with real users.</li>
            <li><strong>Prototype with code</strong>: Built and HTML/CSS with dummied data to test how things feel before building a true front-end.</li>
          </ol>

          <p class="mb-4">
            Wanna help me out <a href="#!" class="badge bg-primary-soft">@Ryu Duke</a> or <a href="#!" class="badge bg-primary-soft">@Miyah Miles</a>?
          </p>

          <div class="mb-3">
            <div class="row">
              <div class="col">

                <!-- Buttons -->
                <a href="#!" class="btn btn-sm btn-white">
                  😍 4
                </a>
                <a href="#!" class="btn btn-sm btn-white">
                  👍 3
                </a>
                <a href="#!" class="btn btn-sm btn-white">
                  Add Reaction
                </a>

              </div>
              <div class="col-auto me-n3">

                <!-- Avatar group -->
                <div class="avatar-group d-none d-sm-flex">
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Daniela Dewitt">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-4.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Ab Hadley">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                  <a href="profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Adolfo Hess">
                    <img src="/assets/dashkit/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                  </a>
                </div>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="#!" class="btn btn-sm btn-white">
                  Share
                </a>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Divider -->
          <hr>

          <!-- Comments -->

          <div class="comment mb-3">
            <div class="row">
              <div class="col-auto">

                <!-- Avatar -->
                <a class="avatar" href="profile-posts.html">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-5.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Body -->
                <div class="comment-body">

                  <div class="row">
                    <div class="col">

                      <!-- Title -->
                      <h5 class="comment-title">
                        Miyah Miles
                      </h5>

                    </div>
                    <div class="col-auto">

                      <!-- Time -->
                      <time class="comment-time">
                        11:12
                      </time>

                    </div>
                  </div> <!-- / .row -->

                  <!-- Text -->
                  <p class="comment-text">
                    I love this Dianna! Let's add to our wiki tomorrow!
                  </p>

                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <div class="comment mb-3">
            <div class="row">
              <div class="col-auto">

                <!-- Avatar -->
                <a class="avatar" href="profile-posts.html">
                  <img src="/assets/dashkit/img/avatars/profiles/avatar-6.jpg" alt="..." class="avatar-img rounded-circle">
                </a>

              </div>
              <div class="col ms-n2">

                <!-- Body -->
                <div class="comment-body">

                  <div class="row">
                    <div class="col">

                      <!-- Title -->
                      <h5 class="comment-title">
                        Ryu Duke
                      </h5>

                    </div>
                    <div class="col-auto">

                      <!-- Time -->
                      <time class="comment-time">
                        11:12
                      </time>

                    </div>
                  </div> <!-- / .row -->

                  <!-- Text -->
                  <p class="comment-text">
                    I'm onboard for sure. Sign me up to prototype anytime.
                  </p>

                </div>

              </div>
            </div> <!-- / .row -->
          </div>

          <!-- Divider -->
          <hr>

          <!-- Form -->
          <div class="row">
            <div class="col-auto">

              <!-- Avatar -->
              <div class="avatar avatar-sm">
                <img src="/assets/dashkit/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
              </div>

            </div>
            <div class="col ms-n2">

              <!-- Input -->
              <form class="mt-1">
                <label class="visually-hidden">Leave a comment...</label>
                <textarea class="form-control form-control-flush" data-autosize rows="1" placeholder="Leave a comment"></textarea>
              </form>

            </div>
            <div class="col-auto align-self-end">

              <!-- Icons -->
              <div class="text-muted mb-2">
                <a class="text-reset me-3" href="#" data-bs-toggle="tooltip" title="Add photo">
                  <i class="fe fe-camera"></i>
                </a>
                <a class="text-reset me-3" href="#" data-bs-toggle="tooltip" title="Attach file">
                  <i class="fe fe-paperclip"></i>
                </a>
                <a class="text-reset" href="#" data-bs-toggle="tooltip" title="Record audio">
                  <i class="fe fe-mic"></i>
                </a>
              </div>

            </div>
          </div> <!-- / .row -->

        </div>
      </div>

    </div>
    <div class="col-12 col-xl-4">

      <!-- Card -->
      <div class="card">
        <div class="card-body">

          <!-- List group -->
          <div class="list-group list-group-flush my-n3">
            <div class="list-group-item">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h5 class="mb-0">
                    Birthday
                  </h5>

                </div>
                <div class="col-auto">

                  <!-- Time -->
                  <time class="small text-muted" datetime="1988-10-24">
                    10/24/88
                  </time>

                </div>
              </div> <!-- / .row -->
            </div>
            <div class="list-group-item">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h5 class="mb-0">
                    Joined
                  </h5>

                </div>
                <div class="col-auto">

                  <!-- Time -->
                  <time class="small text-muted" datetime="2018-10-28">
                    10/24/18
                  </time>

                </div>
              </div> <!-- / .row -->
            </div>
            <div class="list-group-item">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h5 class="mb-0">
                    Location
                  </h5>

                </div>
                <div class="col-auto">

                  <!-- Text -->
                  <small class="text-muted">
                    Los Angeles, CA
                  </small>

                </div>
              </div> <!-- / .row -->
            </div>
            <div class="list-group-item">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h5 class="mb-0">
                    Website
                  </h5>

                </div>
                <div class="col-auto">

                  <!-- Link -->
                  <a href="#!" class="small">
                    themes.getbootstrap.com
                  </a>

                </div>
              </div> <!-- / .row -->
            </div>
          </div>

        </div>
      </div>

      <!-- Weekly Hours -->
      <div class="card">
        <div class="card-header">

          <!-- Title -->
          <h4 class="card-header-title">
            Weekly Hours
          </h4>

        </div>
        <div class="card-body">

          <!-- Chart -->
          <div class="chart chart-sm">
            <canvas id="weeklyHoursChart" class="chart-canvas"></canvas>
          </div>

        </div>
      </div>

    </div>
  </div> <!-- / .row -->
</div>

@endsection
