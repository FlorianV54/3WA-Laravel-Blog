@extends('layout')

@section('content')

  {{-- Message flash de success --}}
  @if (Session::has('success'))
    <div class="alert alert-success">
      <p>{{ Session::get('success') }}</p>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
          <!-- box-header -->
          <div class="box-header with-border">
            <h2 class="box-title"><i class="fa fa-envelope" aria-hidden="true"></i> Formulaire de Contact</h2>
          </div>
          <!-- /.box-header -->

          <!-- form start -->
          <form role="form" method="post" action="">
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

              <div class="form-group @if($errors->has('email')) has-warning @endif">
                <label for="exampleInputEmail1">Adresse Email</label>
                <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Adresse email">
                @if ($errors->has('email'))
                  <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                @endif
              </div>

              <div class="form-group @if($errors->has('site')) has-warning @endif">
                <label for="exampleInputName">Site Web</label>
                <input value="{{ old('site') }}" name="site" type="text" class="form-control" placeholder="URL ...">
                @if ($errors->has('site'))
                  <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('site') }}</span>
                @endif
              </div>

              <div class="form-group @if($errors->has('sujet')) has-warning @endif">
                <label>Sujet</label>
                <select value="{{ old('sujet') }}" name="sujet" class="form-control">
                  <option value="contact" @if(old('sujet')=='contact') selected @endif>Prise de contact</option>
                  <option value="article" @if(old('sujet')=='article') selected @endif>Rédaction d'un article</option>
                  <option value="demande" @if(old('sujet')=='demande') selected @endif>Demande de partenariat</option>
                  <option value="autre" @if(old('sujet')=='autre') selected @endif>Autre</option>
                </select>
                @if ($errors->has('sujet'))
                  <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('sujet') }}</span>
                @endif
              </div>

              <div class="form-group @if($errors->has('message')) has-warning @endif">
                <label>Message</label>
                <textarea name="message" class="form-control" rows="8" placeholder="Votre contenu nous intéresse">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                  <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('message') }}</span>
                @endif
              </div>

              <div class="form-group @if($errors->has('genre')) has-warning @endif">
                <label>Sexe</label>
                <div class="radio">
                  <label>
                    <input @if(old("genre") == "masculin") checked @endif type="radio" name="genre" id="masculin" value="masculin">Masculin
                  </label><br>
                  <label>
                    <input @if(old("genre") == "feminin") checked @endif type="radio" name="genre" id="feminin" value="feminin">Féminin
                  </label>
                  @if ($errors->has('genre'))
                    <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('genre') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-group @if($errors->has('cgu')) has-warning @endif">
                <div class="checkbox">
                  <label>
                    <input name="cgu" type="checkbox">J'accepte les CGU
                  </label>
                  @if ($errors->has('cgu'))
                    <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('cgu') }}</span>
                  @endif
                </div>
              </div>
            </div>

            {{-- Submit --}}
            <div class="box-footer container">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Envoyer</button>
            </div>
          </form>
        </div>
    </div>
  </div>

@endsection
