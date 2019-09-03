@extends('layouts.auth')

@section('page-extension', 'register-page')

@section('content')
<div class="register-box">

    <div class="register-logo">
        <a href=""><b>{{ config('app.name', 'Laravel') }}</b></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Send Password Reset Link To Your Email</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">

          @csrf

          <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>


          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Send Password Reset Link') }}</button>
            </div>
          </div>
        </form>

        <br/>
        <a href="{{ route('login') }}" class="text-center">Login Again ?</a>


    </div>
</div>
@endsection
