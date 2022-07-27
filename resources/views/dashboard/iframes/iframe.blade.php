@extends('dashboard.layouts.default')

@section('mainContent')
<div class="main-content">
  <iframe src="{{ url($iframeUrl) }}" style="width:100%; height:100vh;"></iframe>
</div>
@endsection
