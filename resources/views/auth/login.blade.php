@extends('layout_logout')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <b>BackOffice</b>BLOG
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">SE CONNECTER</p>
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">Login</label>
          <div class="col-md-8">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Mot de passe</label>
          <div class="col-md-8">
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required >
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember">Mémoriser</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Se connecter</button>
          </div>
          <div class="text-center">
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OU -</p>
        <a href="auth/facebook" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</a>
        <a href="auth/twitter" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Twitter</a>
      </div>

      <div class="text-center">
        <a href="{{ url('/register')}}" class="btn btn-success"><i class="fa fa-plus"></i> S'inscrire</a>
      </div>
    </div>
  </div>
@endsection
