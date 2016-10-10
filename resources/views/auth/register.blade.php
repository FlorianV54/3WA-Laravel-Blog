@extends('layout_logout')

@section('content')
  <div class="register-box" style="margin-left: 30%; width: 40%;">
    <div class="register-logo">
      <a href="{{ url('/login') }}"><b>BackOffice</b>BLOG</a>
    </div>

    <div class="register-box-body">
      <p class="login-box-msg"><i class="fa fa-plus"></i> S'INSCRIRE</p>

      <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
          <label for="image" class="col-md-4 control-label">Avatar</label>
          <div class="col-md-8">
            <input id="image" type="file" accept="image/*" class="form-control" name="image" placeholder="image" value="{{ old('image') }}">
            @if ($errors->has('image'))
              <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
          <label for="nom" class="col-md-4 control-label">Nom</label>
          <div class="col-md-8">
            <input id="nom" type="text" class="form-control" name="nom" placeholder="Nom" value="{{ old('nom') }}" autofocus>
            @if ($errors->has('nom'))
              <span class="help-block">
                <strong>{{ $errors->first('nom') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
          <label for="prenom" class="col-md-4 control-label">Prénom</label>
          <div class="col-md-8">
            <input id="prenom" type="text" class="form-control" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}">
            @if ($errors->has('prenom'))
              <span class="help-block">
                <strong>{{ $errors->first('prenom') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
          <label for="ville" class="col-md-4 control-label">Ville</label>
          <div class="col-md-8">
            <input id="ville" type="text" class="form-control" name="ville" placeholder="Ville" value="{{ old('ville') }}">
            @if ($errors->has('ville'))
              <span class="help-block">
                <strong>{{ $errors->first('ville') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('code_postal') ? ' has-error' : '' }}">
          <label for="code_postal" class="col-md-4 control-label">Code Postal</label>
          <div class="col-md-8">
            <input id="code_postal" type="text" class="form-control" name="code_postal" placeholder="ex. 69000" value="{{ old('code_postal') }}">
            @if ($errors->has('code_postal'))
              <span class="help-block">
                <strong>{{ $errors->first('code_postal') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('date_naissance') ? ' has-error' : '' }}">
          <label for="date_naissance" class="col-md-4 control-label">Date de naissance</label>
          <div class="col-md-8">
            <input id="date_naissance" type="text" class="form-control" name="date_naissance" placeholder="jj/MM/YYYY" value="{{ old('date_naissance') }}">
            @if ($errors->has('date_naissance'))
              <span class="help-block">
                <strong>{{ $errors->first('date_naissance') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
          <label for="telephone" class="col-md-4 control-label">Téléphone</label>
          <div class="col-md-8">
            <input id="telephone" type="text" class="form-control" name="telephone" placeholder="fixe ou mobile" value="{{ old('telephone') }}">
            @if ($errors->has('telephone'))
              <span class="help-block">
                <strong>{{ $errors->first('telephone') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('biographie') ? ' has-error' : '' }}">
          <label for="biographie" class="col-md-4 control-label">Biographie</label>
          <div class="col-md-8">
            <textarea id="biographie" name="biographie" class="form-control" rows="8" placeholder="Minimum 15 caractères" value="{{ old('biographie') }}"></textarea>
            @if ($errors->has('biographie'))
              <span class="help-block">
                <strong>{{ $errors->first('biographie') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-Mail</label>
          <div class="col-md-8">
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
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
            <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe">
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label for="password_confirmation" class="col-md-4 control-label">Confirmation</label>
          <div class="col-md-8">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe">
            @if ($errors->has('password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> S'inscrire</button>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection
