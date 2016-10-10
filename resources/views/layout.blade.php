<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BackOffice - Blog</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
    {{-- Animate --}}
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    {{-- Bootstrap datepicker --}}
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    {{-- CDN CKEditor (obligé de le placer dans le header sinon ne fonctionne pas) --}}
    <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    {{-- CSS pour le Line Chart de Morris --}}
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">
    {{-- CSS pour le style "général" --}}
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      @include('partials/_header')
      @include('partials/_leftside')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="content">
          @section('content')
          @show
        </div>
      </div>
      @include('partials/_footer')
    </div>
    <!-- ./wrapper -->

    @section('js')
      <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      {{-- CDN Angular --}}
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>


      {{-- Script pour le Date Picker dans le formulaire de media --}}
      <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
      <script type="text/javascript">
        $('#datepicker').datepicker({
          autoclose: true,
          // format: 'dd/mm/yyyy',
          startDate: 'd', // pour ne pas pouvoir séléctionner une date antérieur à aujourd'hui
          todayHighlight: true, // a l'ouveture du datePicker, affiche le jour en cours en surbrillance
        });
      </script>

      {{-- Script pour le slimScroll --}}
      <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
      <script type="text/javascript">
        $(function(){
          $(".slimtest").slimScroll({
            railVisible: true,
            // alwaysVisible: true
          });
        });
      </script>

      {{-- CDN Moment JS --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
      {{-- CDN Jquery Mask Plugin --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
      {{-- JS pour le theme front-end AdminLTE --}}
      <script src="{{ asset('js/app.min.js') }}"></script>
      {{-- JS pour les plugins utilisés et autres --}}
      <script src="{{ asset('js/main.js') }}"></script>


      {{-- CDN FIREBASE --}}
      <script src="https://www.gstatic.com/firebasejs/3.4.0/firebase.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/angularFire/2.0.2/angularfire.js"></script>
      {{-- + le script Firebase --}}
      <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyARyRTdBC1a8PAjdAm5YcmgSi3gkrXOvIk",
        authDomain: "videos-7ddfb.firebaseapp.com",
        databaseURL: "https://videos-7ddfb.firebaseio.com",
        storageBucket: "videos-7ddfb.appspot.com",
        messagingSenderId: "920426966939"
      };
      firebase.initializeApp(config);
      </script>

    @show
  </body>
</html>
