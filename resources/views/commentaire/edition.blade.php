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

  <div class="row">
    {{-- FORMULAIRE --}}
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h2 class="box-title"><i class="fa fa-commenting" aria-hidden="true"></i> Edition du Commentaire</h2>
        </div>
        <form role="form" method="post" action="" enctype="multipart/form-data">
          {{-- csrf_field() => Sécuriser le formulaire avec un Token unique --}}
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group @if($errors->has('content')) has-warning @endif">
              <label>Contenu</label>
              <textarea name="content" class="form-control" rows="8" placeholder="Minimum 15 caractères">{{ old('content') }}</textarea>
              @if ($errors->has('content'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('content') }}</span>
              @endif
              <script>
              CKEDITOR.replace( 'content', {
                language: 'fr',
                // uiColor: '#3C8DBC'
              });
              </script>
            </div>
            <div class="form-group @if($errors->has('note')) has-warning @endif">
              <label>Note</label>
              <select value="{{ old('note') }}" name="note" class="form-control">
                <option value=1 @if(old('note')==1) selected @endif>1</option>
                <option value=2 @if(old('note')==2) selected @endif>2</option>
                <option value=3 @if(old('note')==3) selected @endif>3</option>
                <option value=4 @if(old('note')==4) selected @endif>4</option>
                <option value=5 @if(old('note')==5) selected @endif>5</option>
              </select>
              @if ($errors->has('note'))
                <span class="help-block text-danger"><i class="fa fa-exclamation-triangle"></i> {{ $errors->first('note') }}</span>
              @endif
            </div>
          </div>

          <div class="box-footer container">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Editer</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Box Commentaires Enregistrés--}}
    <div class="col-md-3">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count(\App\Commentaire::all()) }}</h3>
          <p>Commentaires Enregistrés</p>
        </div>
        <div class="icon">
          <i class=" fa fa-commenting-o"></i>
        </div>
        <a href="{{ route('commentaire/list')}}" class="small-box-footer">Plus de détails <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>

@endsection
