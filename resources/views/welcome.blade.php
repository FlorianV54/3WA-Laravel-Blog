@extends('layout')

@section('js')
  @parent

  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script type="text/javascript" src="{{ asset('plugins/morris/morris.min.js') }}"></script>
  {{-- JS pour Angular --}}
  <script type="text/javascript" src="{{ asset('js/TchatController.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/VideoController.js') }}"></script>

  <!-- Morris.js charts -->
  <script>
    $(function () {
      "use strict";

      // AJAX => Asynchronistation Javascript
      $.getJSON( "/admin/categories-stats",
      function(data) { // data est la fonction de retour
        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart1',
          resize: true,
          colors: ["#F39C12", "#3C8DBC", "#00A65A", "#DD4B39"],
          data: data,
          hideHover: 'auto'
        });
      });
    });
  </script>

  <!-- Morris.js charts -->
  <script>
    $(function () {
      "use strict";

      // AJAX => Asynchronistation Javascript
      $.getJSON( "/admin/commentaires-stats",
      function(data) { // data est la fonction de retour
        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart2',
          resize: true,
          colors: ["#F39C12", "#3C8DBC", "#00A65A", "#DD4B39"],
          data: data,
          hideHover: 'auto'
        });
      });
    });
  </script>

  {{-- Morris.js Line Chart --}}
  <script>
    $(function () {
      "use strict";
      $.getJSON( "/admin/commentaires_annee-stats",
      function(data) { // data est la fonction de retour
      // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: data,
          xkey: 'year',
          ykeys: ['value'],
          labels: 'value',
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });
      });
    });
  </script>

@endsection


@section('content')

  <div class="" ng-app="app">
    <div class="row">
      {{-- WIDGETS --}}
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Articles en ligne</span>
            <span class="info-box-number">{{ $nbArticles }}</span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Catégories remplies</span>
            <span class="info-box-number">{{ $nbCategories }}</span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-youtube-play"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Médias Utilisés</span>
            <span class="info-box-number">{{ $nbMedias }}</span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-commenting-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Commentaires actifs</span>
            <span class="info-box-number">{{ $nbCommentaires }}</span>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      {{-- DONUT Morris--}}
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Répartition des articles par catégories</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="sales-chart1" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="560" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"></svg></div>
          </div>
        </div>
      </div>

      {{-- DONUT Morris--}}
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Nombres de commentaires par articles</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="sales-chart2" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="560" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"></svg></div>
          </div>
        </div>
      </div>
    </div>

    {{-- Line Chart Morris --}}
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nombres de commentaires par année (sur les 5 dernières années)</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      {{-- CHAT --}}
      <div class="col-md-6" ng-controller="TchatController">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">#{ titre }#</h3>
          </div>
          <div>
            <div class="box-body chat" id="chat-box">
            <!-- chat item -->
            <div class="slimtest">
              <div class="item" ng-repeat="message in messages" style="margin-right: 15px">
                <img src="/img/user4-128x128.jpg" alt="user image" class="online">
                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> #{ message.created_at|ago }#</small>
                    ##{ message.id }#
                  </a>
                  #{ message.content }#
                </p>
                <hr>
              </div>
            </div>
            <!-- /.item -->
            </div>
          </div>
          <!-- /.chat -->
          <div class="box-footer">
            <div class="input-group">
              <form ng-submit="add()">
                {{ csrf_field() }}
                <input ng-model="content" class="form-control" placeholder="Saisissez votre message...">
              </form>
              <div class="input-group-btn">
                <form ng-submit="add()">
                  {{ csrf_field() }}
                  <button ng-click="content" type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Article Aléatoire + ajout de commentaires --}}
      <div class="col-md-6" ng-controller="CommentaireController">
        <!-- Box Comment -->
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block">
              <img class="img-circle" src="#{ article.image }#" alt="User Image">
              <span class="username"><a href="#">#{ article.titre }#</a></span>
              <span class="description">Catégorie <b>#{ categorie }#</b></span>
              <span class="description">Publié le <b>#{ article.created_at }#</b></span>
            </div>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- post text -->
            <p>#{ article.description }#</p>
            <!-- Social sharing buttons -->
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
            <span class="pull-right text-muted">#{ commentaires.length }# commentaires</span>
          </div>
          <!-- /.box-body -->
          <div class="box-footer box-comments slimtest">
            <div class="box-comment " ng-repeat="commentaire in commentaires" style="margin-right: 15px">
              <!-- User image -->
              <img class="img-circle img-sm" src="{{ asset('images/'.'#{ commentaire.image }#')}}" alt="User Image">
              <div class="comment-text">
                <span class="username">
                  #{ commentaire.prenom }# #{ commentaire.nom }#
                  <span class="text-muted pull-right"><i class="fa fa-clock-o"></i> #{ commentaire.updated_at|ago }#</span>
                  <span><i class="fa fa-star text-yellow"></i></span>
                </span>
              <!-- /.username -->
                <a href="#{ commentaire.delete }#"> <i class="fa fa-trash-o"></i></a>
                #{ commentaire.content|suppBalisesHTML }#
              </div>
              <!-- /.comment-text -->
            </div>
            <!-- /.box-comment -->
          </div>
          <!-- /.box-footer -->
          <div class="box-footer">
            <form ng-submit="add()">
              {{ csrf_field() }}
              <img class="img-responsive img-circle img-sm" src="{{ asset('images/'. Auth::user()->image) }}" alt="Alt Text">
              <div class="img-push">
                <input ng-model="content" class="form-control input-sm" placeholder="Postez votre commentaire...">
              </div>
            </form>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
    </div>

    {{-- Affichage de Vidéos --}}
    <div class="row" ng-controller="VideoController">
      <div class="col-md-12">
        <ul class="timeline">
          <!-- timeline time label -->
          <li class="time-label">
            <span class="bg-red">{{ Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>
          </li>
          <!-- /.timeline-label -->

          <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="fa fa-youtube-play bg-blue"></i>
            <div class="timeline-item">
              <h3 class="timeline-header"><a href="#">Vidéos postées</a></h3>

              <div class="col-md-4" ng-repeat="data in datas">
                <div class="timeline-body" >

                  <div class="timeline-item">
                    <h5 class="timeline-header">
                      <a href="#"><b>#{ data.titre }#</b></a>
                      <span class="time"> <i class="fa fa-clock-o"></i> #{ data.created_at|ago }#</span>
                      <p class="pull-right"><i ng-click="remove(data)" class="fa fa-times"></i></p>
                    </h5>

                    <div class="timeline-body">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="#{formattage(data.url)}#" frameborder="0" allowfullscreen=""></iframe>
                      </div>
                    </div>

                    <div class="timeline-footer">
                      <span>#{ data.description }#</span><span class="time"> <i class="fa fa-clock-o"></i> #{ data.annee }#</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- END timeline item -->
        </ul>
      </div>

      {{-- Ajout d'une vidéo --}}
      <div class="col-md-6">
        <div class="box box-primary">
          <!-- box-header -->
          <div class="box-header with-border">
            <h2 class="box-title"><i class="fa fa-video-camera" aria-hidden="true"></i> Poster une vidéo</h2>
          </div>
          <!-- /.box-header -->

          <!-- form start -->
          <form>
            <div class="box-body">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleInputName">Titre</label>
                <input class="form-control" type="text" ng-model="titre" required placeholder="Titre">
              </div>
              <div class="form-group">
                <label for="exampleInputName">Description</label>
                <textarea class="form-control"  ng-model="description" required placeholder="Description.."></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputName">URL</label>
                <input class="form-control" type="url" ng-model="url" required placeholder="Url: youtube, dailymotion">
              </div>
              <div class="form-group">
                <label for="exampleInputName">Année</label>
                <input class="form-control" type="text" ng-model="annee" required placeholder="Année de sortie">
              </div>
              <div class="form-group">
                <label for="exampleInputName">Date de Sortie</label>
                <input class="form-control" type="text" ng-model="created_at" required placeholder="Date de sortie">
              </div>
            </div>

            {{-- Submit --}}
            <div class="box-footer container">
              <button ng-click="add()" type="submit" class="btn btn-primary" name="button"><i class="fa fa-check"></i> Poster</button>
            </div>
          </form>
        </div>
      </div>

      {{-- Affichage + Ajout de tweets --}}
      <div class="col-md-6">
        <div class="box box-primary">
          <!-- box-header -->
          <div class="box-header with-border">
            <h2 class="box-title"><i class="fa fa-twitter" aria-hidden="true"></i> Twetter</h2>
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <div class="container-fluid">
              @foreach($tweets as $key => $tweet)
                <h5>{!! Twitter::linkify($tweet->text) !!}</h5>
                <p class="small">
                  <img src="{{ $tweet->user->profile_image_url }}" alt="" class="img-circle"/>
                  {{ $tweet->user->name}}
                </p>
                <p>
                  <i class="fa fa-clock-o"></i> {{ Twitter::ago($tweet->created_at) }}
                </p>
              @endforeach
            </div>
          </div>

          <div class="box-footer container">
            <form class="" action="{{ route('addTweet') }}" method="post">
              {{ csrf_field() }}
              <textarea name="tweet" required pattern="" rows="3" cols="10" class="form-control"></textarea>
              <div class="box-footer container">
                <button type="submit" class="btn btn-primary"><i class="fa fa-twitter"></i> Je tweet !</button>
              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </div>

@endsection
