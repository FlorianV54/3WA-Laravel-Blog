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

  {{-- Tableau Récap des Utilisateurs inscrits en BDD --}}
  <div class="row">
    <div class="col-md-9">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><span class="label label-primary">{{ count(\App\Commentaire::all()) }}</span> Commentaires inscrits en Base de Données</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>#</th>
                <th>Contenu</th>
                <th>Note</th>
                <th>Etat</th>
                <th>Date de Création</th>
                <th>Date de Modification</th>
              </tr>
              @foreach(\App\Commentaire::all() as $commentaire)
                <tr>
                  <td><a href="{{ route('commentaire/edition', [ "id" => $commentaire->id] ) }}">{{ $commentaire->id }}</a></td>
                  <td>{{ strip_tags($commentaire->content) }}</td>
                  <td><small class="label @if($commentaire->note >= 2) bg-green @else bg-red @endif">{{ $commentaire->note }}</small></td>
                  <td><a href="{{ route('commentaire/etat', [ "id" => $commentaire->id] ) }}"><i class="fa @if($commentaire->etat == 1) fa-circle-o text-green @elseif($commentaire->etat == 2) fa-circle-o text-yellow @else fa-circle-o text-red @endif"></i></a></td>
                  <td>
                    <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $commentaire->created_at) ?>
                    {{ $date->format('d/m/Y H:i') }}
                  </td>
                  <td>
                    <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $commentaire->updated_at) ?>
                    {{ $date->format('d/m/Y H:i') }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Widget Etat Commentaire --}}
    <div class="col-md-3">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Etat des commentaires</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body" style="display: block;">
          <i class="fa fa-circle-o text-green"></i> En ligne
          <span class="label label-primary pull-right">{{ (\App\Commentaire::where('etat', 1)->count()) }}</span><br>
          <i class="fa fa-circle-o text-yellow"></i> En relecture
          <span class="label label-primary pull-right">{{ (\App\Commentaire::where('etat', 2)->count()) }}</span><br>
          <i class="fa fa-circle-o text-red"></i> A Supprimer
          <span class="label label-primary pull-right">{{ (\App\Commentaire::where('etat', 0)->count()) }}</span>
        </div>
      </div>
    </div>

    {{-- Widget de Suppression --}}
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-trash-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Suppression Commentaire<span class="label bg-red pull-right">{{ \App\Commentaire::where('etat', 0)->count() }}</span>
          </span>
          @foreach(\App\Commentaire::all()->where('etat', 0) as $commentaire)
            <span class="info-box-number">#{{ $commentaire->id }} <i class="fa fa-hand-o-right animated rotateIn" aria-hidden="true"></i><a href="{{ route('commentaire/delete', [ "id" => $commentaire->id]) }}"> <i class="fa fa-trash-o"></i></a>
            </span>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection
