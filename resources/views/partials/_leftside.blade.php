<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('images/'. Auth::user()->image) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>Utilisateur</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('utilisateur/add')}}"><i class="fa fa-plus text-aqua"></i> Ajouter</a></li>
          <li><a href="{{ route('utilisateur/list')}}"><i class="fa fa fa-list text-yellow"></i> Lister</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Article</span>
          <span class="pull-right-container">
            <span class="label bg-aqua pull-right">{{ count(\App\Article::all()) }}</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('article/list')}}"><i class="fa fa fa-list text-yellow"></i> Lister</a></li>
          <li><a href="{{ route('article/paiement')}}"><i class="fa fa fa-money text-green"></i> Paiement</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-commenting-o"></i>
          <span>Commentaire</span>
          <span class="pull-right-container">
            <span class="label label-danger pull-right">{{ count(\App\Commentaire::all()) }}</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('commentaire/list')}}"><i class="fa fa fa-list text-yellow"></i> Lister</a></li>
        </ul>
      </li>

      <li>
        <a href="{{ route('media')}}">
          <i class="fa fa-youtube-play"></i> <span>Média</span>
          <span class="pull-right-container"></span>
        </a>
      </li>

      <li>
        <a href="{{ route('contact')}}">
          <i class="fa fa-envelope-o"></i> <span>Contact</span>
          <span class="pull-right-container">
            <span class="label label-success pull-right">New</span>
          </span>
        </a>
      </li>
    </ul>
  </section>
</aside>
