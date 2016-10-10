@extends('layout')

@section('content')

  {{-- FORMULAIRE --}}
  <div class="row">
    <div class="col-md-7">

      {{-- Message flash de success --}}
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif

      <div class="box box-primary">
        <!-- box-header -->
        <div class="box-header with-border">
          <h2 class="box-title"><i class="fa fa-user" aria-hidden="true"></i> Formulaire d'ajout Utilisateur</h2>
        </div>
        <!-- /.box-header -->

        <!-- form start -->
        <form role="form" method="post" action="" enctype="multipart/form-data">
          {{-- csrf_field() => Sécuriser le formulaire avec un Token unique --}}
          {{ csrf_field() }}

          <div class="box-body">
            <div class="form-group @if($errors->has('nom')) has-warning @endif">
              <label for="exampleInputName">Nom</label>
              <input value="{{ old('nom') }}" name="nom" type="text" class="form-control" placeholder="Nom">
              @if ($errors->has('nom'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('nom') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('prenom')) has-warning @endif">
              <label for="exampleInputName">Prénom</label>
              <input value="{{ old('prenom') }}" name="prenom" type="text" class="form-control" placeholder="Prénom">
              @if ($errors->has('prenom'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('prenom') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('email')) has-warning @endif">
              <label for="exampleInputEmail1">Adresse Email</label>
              <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Adresse email">
              @if ($errors->has('email'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('password')) has-warning @endif">
              <label for="exampleInputName">Mot de Passe</label>
              <input value="{{ old('password') }}" name="password" type="password" class="form-control" placeholder="Minimum 6 caractères (avec 1 Maj + 1 Min + 1 chiffre et 1 CharSpé)">
              @if ($errors->has('password'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('confirmationPassword')) has-warning @endif">
              <label for="exampleInputName">Confirmation</label>
              <input value="{{ old('confirmationPassword') }}" name="confirmationPassword" type="password" class="form-control" placeholder="Merci de confirmer votre mot de passe">
              @if ($errors->has('confirmationPassword'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('confirmationPassword') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('telephone')) has-warning @endif">
              <label for="exampleInputName">Téléphone</label>
              <input value="{{ old('telephone') }}" name="telephone" type="text" class="form-control phone" placeholder="Fixe ou Mobile">
              @if ($errors->has('telephone'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('telephone') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('code_postal')) has-warning @endif">
              <label for="exampleInputName">Code Postal</label>
              <input value="{{ old('code_postal') }}" name="code_postal" type="text" class="form-control cep" placeholder="ex. 69000">
              @if ($errors->has('code_postal'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('code_postal') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('ville')) has-warning @endif">
              <label for="exampleInputName">Ville</label>
              <input value="{{ old('ville') }}" name="ville" type="text" class="form-control" placeholder="Ville">
              @if ($errors->has('ville'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('ville') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('date_naissance')) has-warning @endif">
              <label for="exampleInputName">Date de Naissance</label>
              <input value="{{ old('date_naissance') }}" name="date_naissance" type="text" class="form-control date1 placeholderDate">
              @if ($errors->has('date_naissance'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('date_naissance') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('biographie')) has-warning @endif">
              <label>Biographie</label>
              <textarea name="biographie" class="form-control" rows="8" placeholder="Minimum 15 caractères">{{ old('biographie') }}</textarea>
              @if ($errors->has('biographie'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('biographie') }}</span>
              @endif
              <script>
              CKEDITOR.replace( 'biographie', {
                language: 'fr',
                // uiColor: '#3C8DBC'
              });
              </script>
            </div>

            <div class="form-group @if($errors->has('image')) has-warning @endif">
              <label for="exampleInputName">Image</label>
              <input name="image" type="file" accept="image/*" capture class="form-control">
              @if ($errors->has('image'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
              @endif
            </div>
          </div>

          {{-- Submit --}}
          <div class="box-footer container">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Envoyer</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Widget Utilisateurs Enregistrés--}}
    <div class="col-md-5">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count(\App\Utilisateur::all()) }}</h3>
          <p>Utilisateurs Enregistrés</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('utilisateur/list')}}" class="small-box-footer">Plus de détails <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

@endsection
