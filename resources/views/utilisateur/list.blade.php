@extends('layout')

@section('content')

  {{-- Message flash de danger --}}
  @if (Session::has('danger'))
    <div class="alert alert-danger">
      <p>{{ Session::get('danger') }}</p>
    </div>
  @endif

  {{-- Tableau Récap des Utilisateurs inscrits en BDD --}}
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <!-- .box-header -->
        <div class="box-header">
          <h3 class="box-title"><span class="label label-primary">{{ count(\App\Utilisateur::all()) }}</span> Utilisateurs inscrits en Base de Données</h3>
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
                <th>Image</th>
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Date de Naissance</th>
                <th>Biographie</th>
                <th>Date de Création</th>
                <th>Facebook ID</th>
                <th>Twitter ID</th>
              </tr>
              @foreach(\App\Utilisateur::all() as $utilisateur)
                <tr>
                  <td><a href="{{ route('utilisateur/delete', [ "id" => $utilisateur->id]) }}"><i class="fa fa-trash-o"></i></a></td>
                  <td>{{ $utilisateur->id }}</td>
                  <td><img src="{{ asset('images/'.$utilisateur->image) }}" class="img-responsive" width="50" height="50" /></td>
                  <td>{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</td>
                  <td>{{ $utilisateur->email }}</td>
                  <td>{{ $utilisateur->telephone }}</td>
                  <td>{{ $utilisateur->code_postal }}</td>
                  <td>{{ $utilisateur->ville }}</td>
                  <td>
                    @if($utilisateur->date_naissance != NULL)
                      <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d', $utilisateur->date_naissance) ?>
                      {{ $date->format('d/m/Y') }}
                    @endif
                  </td>
                  <td>{{ strip_tags($utilisateur->biographie) }}</td>
                  <td>
                    <?php $date = Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $utilisateur->created_at) ?>
                    {{ $date->format('d/m/Y H:i') }}
                  </td>
                  <td>{{ $utilisateur->facebook_id }}</td>
                  <td>{{ $utilisateur->twitter_id }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
