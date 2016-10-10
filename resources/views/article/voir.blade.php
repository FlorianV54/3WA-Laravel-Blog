@extends('layout')

@section('content')

  <div class="col-md-8">
    <div class="box box-widget widget-user-2">
      <div class="widget-user-header bg-yellow">
        <div class="widget-user-image">
          <img class="img-circle" src="{{ $article->image }}">
        </div>
        <h3 class="widget-user-username">{{ $article->titre }}</h3>
        <h5 class="widget-user-desc">{{ $article->resume }}</h5>
      </div>
      <div class="box-footer no-padding">
        <div class="widget-user-header">
          <ul class="nav nav-stacked">
            <li>
              <div class="container-fluid">
                <strong>Description</strong><span class="pull-right">{{ $article->description }}</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="col-md-2">
        <a href="{{ route('article/exportPDF', [ "id" => $article->id]) }}" class="btn btn-block btn-primary">Export PDF</a>
      </div>
    </div>
  </div>

@endsection
