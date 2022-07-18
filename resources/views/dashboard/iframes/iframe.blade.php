@extends('dashboard.layouts.default')

@section('mainBody')
  <iframe src="{{ url($iframeUrl) }}" style="width:100%; height:100vh;"></iframe>
@endsection
