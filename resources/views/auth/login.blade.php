@extends('layouts.auth')

@section('content')
<div class="login-box">

    <div class="login-logo">
        <a href=""><b>{{ config('app.name', 'Laravel') }}</b></a>
    </div>

    <div class="login-box-body">

        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf

          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>


            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

          </div>


          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

          </div>

          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

        <br/>

        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
        <a href="{{ route('register') }}">Register a new membership</a>

    </div>

</div>
@endsection
