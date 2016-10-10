@extends('layout')

@section('content')

  {{-- Message flash de success --}}
  @if (Session::has('success'))
    <div class="alert alert-success">
      <p>{{ Session::get('success') }}</p>
    </div>
  @endif

  {{-- Message flash de danger --}}
  @if (Session::has('danger'))
    <div class="alert alert-danger">
      <p>{{ Session::get('danger') }}</p>
    </div>
  @endif

  {{-- Tableau Récap des Artilces inscrits en BDD --}}
  <div class="row">
    <div class="col-md-9">
      <div class="box">
        <!-- .box-header -->
        <div class="box-header">
          <h3 class="box-title"><span class="label label-primary">{{ count(\App\Article::all()) }}</span> Articles inscrits en Base de Données</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th><i class="fa fa-trash"></i></th>
                <th>#</th>
                <th>Favoris</th>
                <th>Image</th>
                <th>{{ trans('messages.titre')}}</th>
                <th>Résume</th>
                <th>Description</th>
                <th>Note</th>
                <th>Visibilité</th>
                <th>{{ trans('messages.published_at')}}</th>
                <th>Date de Création</th>
                <th>Date de Modification</th>
              </tr>
              @foreach(\App\Article::all() as $article)
                <tr>
                  <td><a href="{{ route('article/delete', [ "id" => $article->id]) }}"><i class="fa fa-trash-o"></i></a></td>
                  <td><a href="{{ route('article/voir', [ "id" => $article->id]) }}">{{ $article->id }}</a></td>
                  <td><a href="{{ route('article/favoris', [ "id" => $article->id] ) }}"><i class="fa @if($article->favoris == 1) fa-heart text-red @else fa-heart-o text-red @endif"></i></a></td>
                  <td><img src="{{ $article->image }}" class="img-responsive" width="50" height="50" /></td>
                  <td><a href="{{ route('article/voir', [ "id" => $article->id]) }}">{{ $article->titre }}</a></td>
                  <td>{{ mb_strimwidth(($article->resume),0,150,"...") }}</td>
                  <td>{{ mb_strimwidth(($article->description),0,500,"...") }}</td>
                  <td><small class="label pull-right @if($article->note >= 10) bg-green @else bg-red @endif">{{ $article->note }}</small></td>
                  <td><a href="{{ route('article/visibilite', [ "id" => $article->id] ) }}"><i class="fa @if($article->visibilite == 1) fa-check @else fa-times @endif"></i></a></td>
                  <td>{{ $article->annee_publication }}</td>
                  <td>
                    <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $article->date_creation) ?>
                    {{ $date->format('d/m/Y H:i') }}
                  </td>
                  <td>
                    <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $article->date_modification) ?>
                    {{ $date->format('d/m/Y H:i') }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    {{-- Articles Favoris --}}
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-heart-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Articles Favoris</span>
          <span class="info-box-number">{{ (\App\Article::where('favoris', 1)->count()) }}</span>
        </div>
      </div>
    </div>

    {{-- Changer la langue --}}
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-flag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Changer la langue</span>
          <a href="{{ route('langue', ['locale' => 'fr']) }}">Français</a><br>
          <a href="{{ route('langue', ['locale' => 'en']) }}">Anglais</a>
        </div>
      </div>
    </div>

  </div>

@endsection
