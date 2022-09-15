<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

  <title>{{ config('app.name') }}</title>
  <!-- TODO: Website description -->
  <meta name="description" content="{{ config('app.name') }}" />

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/libs.bundle.css') }}" />

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashkit/css/theme.bundle.css') }}" id="stylesheetLight" />
</head>

<body>
  <!-- NAVIGATION -->
  @include('web.layouts._navbar')

  <!-- MAIN CONTENT -->
  @yield('mainContent')

  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/dashkit/js/vendor.bundle.js') }}" defer></script>
  <script src="{{ asset('assets/dashkit/js/theme.bundle.js') }}" defer></script>

  <!-- Laravel Flash -->
  {{-- @include('dashboard.layouts._flash') --}}

  <!-- Laravel Notify -->
  {{-- @include('dashboard.layouts._laravel-notify') --}}

  <!-- Google Analytics -->
  @include('common._google-analytics')

  <!-- Page Script -->
  @yield('pageScript')
</body>
</html>
