@extends('layout')

@section('content')

  <div class="row">
    <div class="col-md-6">

      {{-- Message flash de success --}}
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif

      <div class="box box-primary">
        <!-- box-header -->
        <div class="box-header with-border">
          <h2 class="box-title"><i class="fa fa-youtube-play" aria-hidden="true"></i> Formulaire d'ajout Media</h2>
        </div>
        <!-- /.box-header -->

        <!-- form start -->
        <form role="form" method="post" action="">
          {{-- csrf_field() => Sécuriser le formulaire avec un Token unique --}}
          {{ csrf_field() }}

          <div class="box-body">
            <div class="form-group @if($errors->has('titre')) has-warning @endif">
              <label for="exampleInputName">Titre</label>
              <input value="{{ old('titre') }}" name="titre" type="text" class="form-control" placeholder="Titre de la vidéo">
              @if ($errors->has('titre'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('titre') }}</span>
              @endif
            </div>

            <div class="form-group  @if($errors->has('page')) has-warning @endif">
              <label>Page où sera affiché le média</label>
              <select name="page" class="form-control">
                {{-- Afficher tous les titres des pages dynamiquement --}}
                @foreach(\App\Page::all() as $page)
                  <option @if(old('page')=="{{ $page->id }}") selected @endif value="{{ $page->id }}">{{ $page->titre }}</option>
                @endforeach
              </select>
                @if($errors->has('page'))
                  <span class="help-block text-danger">{{ $errors->first('page') }}</span>
                @endif
            </div>

            <div class="form-group @if($errors->has('url')) has-warning @endif">
              <label for="exampleInputName">Vidéo</label>
              <input value="{{ old('url') }}" name="url" type="text" class="form-control" placeholder="URL de la vidéo">
              @if ($errors->has('url'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('url') }}</span>
              @endif
            </div>

            <div class="form-group @if($errors->has('visibilite')) has-warning @endif">
              <label>Visibilité</label>
              <div class="radio">
                <label>
                  <input @if(old("visibilite") == "1") checked @endif type="radio" name="visibilite" id="oui" value="1">Oui
                </label><br>
                <label>
                  <input @if(old("visibilite") == "0") checked @endif type="radio" name="visibilite" id="non" value="0">Non
                </label>
              </div>
            </div>

            <div class="form-group @if($errors->has('date_activation')) has-warning @endif">
              <label>Date d'activation</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input value="{{ old('date_activation') }}" name='date_activation' type="text" class="form-control pull-right" id="datepicker">
                @if ($errors->has('date_activation'))
                  <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('date_activation') }}</span>
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
