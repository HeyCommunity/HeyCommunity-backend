@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <div class="header bg-dark pb-5">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle text-secondary">Visitor Analytics</h6>

            <h1 class="header-title text-white">访客分析</h1>
          </div>
          <div class="col-auto">

            <!-- Nav -->
            <ul class="nav nav-tabs header-tabs">
              <li class="nav-item" data-toggle="chart" data-target="#audienceChart" data-trigger="click" data-action="toggle" data-dataset="0">
                <a href="#" class="nav-link text-center active" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    Customers
                  </h6>
                  <h3 class="text-white mb-0">
                    73.2k
                  </h3>
                </a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#audienceChart" data-trigger="click" data-action="toggle" data-dataset="1">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    Sessions
                  </h6>
                  <h3 class="text-white mb-0">
                    92.1k
                  </h3>
                </a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#audienceChart" data-trigger="click" data-action="toggle" data-dataset="2">
                <a href="#" class="nav-link text-center" data-bs-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    Conversion
                  </h6>
                  <h3 class="text-white mb-0">
                    50.2%
                  </h3>
                </a>
              </li>
            </ul>

          </div>
        </div><!-- / .row -->
      </div> <!-- / .header-body -->

      <!-- Footer -->
      <div class="header-footer">
        <!-- Chart -->
        <div class="chart">
          <canvas id="audienceChart" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>


  <!-- CARDS -->
  <div class="container-fluid mt-n6">
    <div class="row">
      <div class="col-12 col-xl-8">

        <!-- Orders -->
        <div class="card">
          <div class="card-header">

            <!-- Title -->
            <h4 class="card-header-title">
              Orders
            </h4>

            <!-- Caption -->
            <span class="text-muted me-3">
                  Show affiliate:
                </span>

            <!-- Switch -->
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="cardToggle" data-toggle="chart" data-target="#ordersChart" data-trigger="change" data-action="add" data-dataset="1" />
              <label class="form-check-label" for="cardToggle"></label>
            </div>

          </div>
          <div class="card-body">

            <!-- Chart -->
            <div class="chart">
              <canvas id="ordersChart" class="chart-canvas"></canvas>
            </div>

          </div>
        </div>
      </div>
      <div class="col-12 col-xl-4">

        <!-- Traffic -->
        <div class="card">
          <div class="card-header">

            <!-- Title -->
            <h4 class="card-header-title">
              Traffic Channels
            </h4>

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
              <li class="nav-item" data-toggle="chart" data-target="#trafficChart" data-trigger="click" data-action="toggle" data-dataset="0">
                <a href="#" class="nav-link active" data-bs-toggle="tab">
                  All
                </a>
              </li>
              <li class="nav-item" data-toggle="chart" data-target="#trafficChart" data-trigger="click" data-action="toggle" data-dataset="1">
                <a href="#" class="nav-link" data-bs-toggle="tab">
                  Direct
                </a>
              </li>
            </ul>

          </div>
          <div class="card-body">

            <!-- Chart -->
            <div class="chart chart-appended">
              <canvas id="trafficChart" class="chart-canvas" data-toggle="legend" data-target="#trafficChartLegend"></canvas>
            </div>

            <!-- Legend -->
            <div id="trafficChartLegend" class="chart-legend"></div>

          </div>
        </div>

      </div>
    </div> <!-- / .row -->
    <div class="row">
      <div class="col-12 col-lg-6 col-xl">

        <!-- Card -->
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                  Weekly Sales
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                      $24,500
                    </span>

                <!-- Badge -->
                <span class="badge bg-success-soft mt-n1">
                      +3.5%
                    </span>

              </div>
              <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

      </div>
      <div class="col-12 col-lg-6 col-xl">

        <!-- Card -->
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                  Orders Placed
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                      763.5
                    </span>

              </div>
              <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-briefcase text-muted mb-0"></span>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

      </div>
      <div class="col-12 col-lg-6 col-xl">

        <!-- Card -->
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                  Conversion Rate
                </h6>

                <div class="row align-items-center g-0">
                  <div class="col-auto">

                    <!-- Heading -->
                    <span class="h2 me-2 mb-0">
                          84.5%
                        </span>

                  </div>
                  <div class="col">

                    <!-- Progress -->
                    <div class="progress progress-sm me-4">
                      <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                  </div>
                </div> <!-- / .row -->
              </div>
              <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-clipboard text-muted mb-0"></span>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

      </div>
      <div class="col-12 col-lg-6 col-xl">

        <!-- Card -->
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center gx-0">
              <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                  Avg. Value
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                      $85.50
                    </span>

              </div>
              <div class="col-auto">

                <!-- Chart -->
                <div class="chart chart-sparkline">
                  <canvas class="chart-canvas" id="sparklineChart"></canvas>
                </div>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

      </div>
    </div> <!-- / .row -->
    <div class="row">
      <div class="col-12 col-xl-4">

        <!-- Activity -->
        <div class="card-adjust-xl">
          <div class="card">
            <div class="card-header">

              <!-- Title -->
              <h4 class="card-header-title">
                Recent Activity
              </h4>

              <!-- Button -->
              <a class="small" href="#!">View all</a>

            </div>
            <div class="card-body">

              <!-- List group -->
              <div class="list-group list-group-flush list-group-activity my-n3">
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Dianna Smiley</strong> shared your post with Ab Hadley, Adolfo
                        Hess, and 3 others.
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Ab Hadley</strong> reacted to your post with a 😍
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Adolfo Hess</strong> commented
                        <blockquote class="mb-0">
                          “I don’t think this really makes sense to do without approval from
                          Johnathan since he’s the one...”
                        </blockquote>
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-4.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Daniela Dewitt</strong> subscribed to you.
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-5.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Miyah Myles</strong> shared your post with Ryu Duke, Glen Rouse,
                        and 3 others.
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="/assets/dashkit/img/avatars/profiles/avatar-6.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>

                    </div>
                    <div class="col ms-n2">

                      <!-- Content -->
                      <div class="small">
                        <strong>Ryu Duke</strong> reacted to your post with a 😍
                      </div>

                      <!-- Time -->
                      <small class="text-muted">
                        2m ago
                      </small>

                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
      <div class="col-12 col-xl-8">

        <!-- Products -->
        <div class="card">
          <div class="card-header">

            <!-- Title -->
            <h4 class="card-header-title">
              Best Selling Products
            </h4>

            <!-- Button -->
            <a href="#!" class="btn btn-sm btn-white">
              Export
            </a>

          </div>
          <div class="table-responsive mb-0" data-list='{"valueNames": ["products-product", "products-stock", "products-price", "products-sales"]}' id="productsList">
            <table class="table table-sm table-nowrap table-hover card-table">
              <thead>
              <tr>
                <th>
                  <a href="#" class="text-muted list-sort" data-sort="products-product">
                    Product
                  </a>
                </th>
                <th>
                  <a href="#" class="text-muted list-sort" data-sort="products-stock">
                    Stock
                  </a>
                </th>
                <th>
                  <a href="#" class="text-muted list-sort" data-sort="products-price">
                    Price
                  </a>
                </th>
                <th colspan="2">
                  <a href="#" class="text-muted list-sort" data-sort="products-sales">
                    Monthly Sales
                  </a>
                </th>
              </tr>
              </thead>
              <tbody class="list">
              <tr>
                <td class="products-product">
                  <div class="d-flex align-items-center">

                    <!-- Image -->
                    <div class="avatar">
                      <img class="avatar-img rounded me-3" src="/assets/dashkit/img/avatars/products/product-1.jpg" alt="..." />
                    </div>

                    <div class="ms-3">

                      <!-- Heading -->
                      <h4 class="fw-normal mb-1">Sketchpad</h4>

                      <!-- Text -->
                      <small class="text-muted">3" x 5" Size</small>

                    </div>

                  </div>
                </td>
                <td class="products-stock">

                  <!-- Badge -->
                  <span class="badge bg-success-soft">Available</span>

                </td>
                <td class="products-price">
                  $14.99
                </td>
                <td class="products-sales">
                  $3,145.23
                </td>
                <td class="text-end">

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

                </td>
              </tr>
              <tr>
                <td class="products-product">
                  <div class="d-flex align-items-center">

                    <!-- Image -->
                    <div class="avatar">
                      <img class="avatar-img rounded me-3" src="/assets/dashkit/img/avatars/products/product-2.jpg" alt="..." />
                    </div>

                    <div class="ms-3">

                      <!-- Heading -->
                      <h4 class="fw-normal mb-1">Turtleshell Shades</h4>

                      <!-- Text -->
                      <small class="text-muted">UV + Blue Light</small>

                    </div>

                  </div>
                </td>
                <td class="products-stock">

                  <!-- Badge -->
                  <span class="badge bg-warning-soft">Unavailable</span>

                </td>
                <td class="products-price">
                  $39.99
                </td>
                <td class="products-sales">
                  $2,611.82
                </td>
                <td class="text-end">

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

                </td>
              </tr>
              <tr>
                <td class="products-product">
                  <div class="d-flex align-items-center">

                    <!-- Image -->
                    <div class="avatar">
                      <img class="avatar-img rounded me-3" src="/assets/dashkit/img/avatars/products/product-3.jpg" alt="..." />
                    </div>

                    <div class="ms-3">

                      <!-- Heading -->
                      <h4 class="fw-normal mb-1">Nike "Go Bag"</h4>

                      <!-- Text -->
                      <small class="text-muted">Leather + Gortex</small>

                    </div>

                  </div>
                </td>
                <td class="products-stock">

                  <!-- Badge -->
                  <span class="badge bg-success-soft">Available</span>

                </td>
                <td class="products-price">
                  $149.99
                </td>
                <td class="products-sales">
                  $2,372.19
                </td>
                <td class="text-end">

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

                </td>
              </tr>
              <tr>
                <td class="products-product">
                  <div class="d-flex align-items-center">

                    <!-- Image -->
                    <div class="avatar">
                      <img class="avatar-img rounded me-3" src="/assets/dashkit/img/avatars/products/product-4.jpg" alt="..." />
                    </div>

                    <div class="ms-3">

                      <!-- Heading -->
                      <h4 class="fw-normal mb-1">Swell Bottle</h4>

                      <!-- Text -->
                      <small class="text-muted">Bone Clay White</small>

                    </div>

                  </div>
                </td>
                <td class="products-stock">

                  <!-- Badge -->
                  <span class="badge bg-success-soft">Available</span>

                </td>
                <td class="products-price">
                  $24.99
                </td>
                <td class="products-sales">
                  $1,145.23
                </td>
                <td class="text-end">

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

                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
