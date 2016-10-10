<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('welcome')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Blog</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Back-Office</b> BLOG</span>
  </a>
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i>
            <span class="label label-danger">{{ (\App\Article::where('favoris', 1)->count()) }}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header"><i class="fa fa fa-list text-yellow"></i> Vous avez {{ (\App\Article::where('favoris', 1)->count()) }} article(s) favoris en panier</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li style="text-align: center;">
                  @foreach(\App\Article::all()->where('favoris', 1) as $article)
                    <img src="{{ $article->image }}" class="img-responsive img-thumbnail" width="50" height="50" />
                    <a href="{{ route('article/voir', [ "id" => $article->id]) }}">{{ $article->titre }}</a>
                  @endforeach
                </li>
              </ul>
            </li>
            <li class="footer"><a href="{{ route('article.clear')}}"><i class="fa fa-trash text-red"></i>Vider de Panier</a></li>
            <li class="footer"><a href="{{ route('article/paiement')}}"><i class="fa fa-money text-green"></i>Paiement</a></li>
          </ul>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(Session::has('LoginMethode') && (Session::get('LoginMethode') == 'twitter' || Session::get('LoginMethode') == 'facebook'))
              <img src="{{ Auth::user()->image }}" class="user-image" alt="User Image">
            @else
              <img src="{{ asset('images/'. Auth::user()->image) }}" class="user-image" alt="User Image">
            @endif
            <span class="hidden-xs">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('images/'. Auth::user()->image) }}" alt="User Image">
              <p>
                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}<br>
                <small>Membre depuis le {{ Auth::user()->created_at->format('d/m/Y') }}</small>
              </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-warning btn-flat">Se déconnecter</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
