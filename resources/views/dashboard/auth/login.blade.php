@extends('dashboard.layouts.base')

@section('mainContent')
<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-5 col-xl-4 mb-5 mt-7">
        <h1 class="display-4 text-center mb-3">登入</h1>
        <p class="text-muted text-center mb-5">使用手机号码和密码登入到 {{ config('app.name') }}</p>

        <form method="POST" action="{{ route('dashboard.auth.login-handler') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label class="form-label">手机号码</label>
            <input required name="phone" type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="139xxxxxxxx" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
              <div class="mt-1 text-danger">{{ $errors->first('phone') }}</div>
            @endif
          </div>

          <div class="form-group">
            <label class="form-label">密码</label>
            <div class="input-group input-group-merge">
              <input required name="password" type="password" class="form-control" placeholder="请输入密码">
              <span class="input-group-text"><i class="fe fe-eye"></i></span>
            </div>
          </div>

          <button class="btn btn-lg w-100 btn-primary mb-3">登入</button>

          {{--
          <div class="d-none">
            <small class="text-muted">没有帐号？<a href="#!">现在注册</a></small>
            <small class="text-muted float-end"><a href="#!">忘记密码？</a></small>
          </div>
          --}}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
