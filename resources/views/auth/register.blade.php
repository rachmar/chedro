@extends('layouts.auth')

@section('content')
<div class="register-box">

  <div class="register-logo">
    <a href=""><b>{{ config('app.name', 'Laravel') }}</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">

      @csrf

      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full name">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password"  name="password"  class="form-control" placeholder="Password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      </div>

    </form>

    <br/>
    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>

  </div>

</div>
@endsection

