<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route pour l'authentification via un commpte Twitter
Route::get('auth/twitter', 'Auth\AuthController@redirectToProviderTwitter');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderCallbackTwitter');

// Route de Sign In pour se loguer via un compte Facebook
Route::get('auth/facebook', 'Auth\AuthController@redirectToProviderFacebook');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallbackFacebook');

// Route::group (pour grouper plusieurs route d'un prefix)
Route::group(
['prefix' => 'admin', // prefixage d'URI "admin"
'middleware' => 'auth'], function() {
// middleware => filtre d'authentification uniquemet si il est connecté

  // Routes par la HomePage (Dashboard)
  Route::get('/', 'WelcomeController@welcome')->name('welcome');

  // Route pour changer la langue (dans article/list)
  Route::get('/langue/{locale}', 'WelcomeController@langue')->name('langue');

  // Route pour ajouter un tweet
  Route::post('/add-tweet', 'WelcomeController@addTweet')->name('addTweet');

  // Routes pour les 4 widgets en haut du dashboard
  Route::get('/categories-stats', 'WelcomeController@statsCategories')->name('statsCategories');
  Route::get('/commentaires-stats', 'WelcomeController@statsCommentaires')->name('statsCommentaires');
  Route::get('/commentaires_annee-stats', 'WelcomeController@statsCommentairesAnnee')->name('statsCommentairesAnnee');

  // Route pour afficher les message de Tchat (par "bloc de 5")
  Route::get('/tchat/{skip?}/{take?}', function($skip = 0, $take = 5){
    // take() => limit à 5
    // orderBy: trier par id descendante
    return App\Tchat::skip($skip)->take($take)->orderBy('id', 'desc')->get();
  })
  ->name('tchat');

  // Route pour ajouter un message dans le Tchat
  Route::post('/tchat-add', 'TchatController@add')->name('tchat-add');

  // Route pour afficher un article aléatoirement
  Route::get('/article-aleatoire', function(){
    return App\Article::all()->random();
  });

  // Route pour ajouter un commentaire
  Route::post('/commentaire-add', 'CommentaireController@add')->name('commentaire-add');

  // Route pour afficher les commentaires en fonction de l'article aléatoire affiché
  Route::get('/commentaires/article-{id}/{take?}', function($id, $take = 5){
    return App\Commentaire::select('comments.id', 'comments.content', 'user.nom', 'user.image', 'user.prenom', 'comments.updated_at')
    ->where('article_id', '=', $id)
    ->join('user', 'user.id', '=', 'comments.user_id')
    ->get();
  });

  // Route pour afficher la catégorie en fonction de l'article aléatoire affiché
  Route::get('/commentaires/categorie-{id}', function($id){
    return App\Article::select('categorie.titre')
    ->where('categorie_id', '=', $id)
    ->join('categorie', 'categorie.id', '=', 'articles.categorie_id')
    ->get();
  });


  // Récupérer l'URI /utilisateur et renvoyer une vue utilisateur
  Route::any('/utilisateur', 'UtilisateurController@utilisateur')->name('utilisateur');

  // Récupérer l'URI /article et renvoyer une vue article
  Route::any('/article', 'ArticleController@article')->name('article');

  // Récupérer l'URI /commentaire et renvoyer une vue commentaire
  Route::any('/commentaire', 'CommentaireController@commentaire')->name('commentaire');

  // Récupérer l'URI /media et renvoyer une vue media
  Route::any('/media', 'MediaController@media')->name('media');

  // Récupérer l'URI /contact et renvoyer une vue contact
  Route::any('/contact', 'ContactController@contact')->name('contact');



  /*
  * Routes Utilisateur
  * (Groupage) +  Controlleur + Vue
  */
  Route::group(['prefix' => 'utilisateur'], function() {
    Route::any('/add', 'UtilisateurController@utilisateur')->name('utilisateur/add');
    Route::any('/list', 'UtilisateurController@lister')->name('utilisateur/list');
    // Bouton "Supprimer" a coté de chaque utilisateur
    Route::any('/delete/{id}', 'UtilisateurController@delete')->name('utilisateur/delete');
  });


  /*
  * Routes Article
  * (Groupage) +  Controlleur + Vue
  */
  Route::group(['prefix' => 'article'], function() {
    Route::any('/add', 'ArticleController@article')->name('add');
    Route::any('/list', 'ArticleController@lister')->name('article/list');
    // Lien/action ppur changer l'état de visibilité (visible ou invisible) d'un article
    Route::any('/visibilite/{id}', 'ArticleController@visibility')->name('article/visibilite');
    // Bouton "Supprimer" a coté de chaque article pour supprimer l'article correspondant.
    Route::any('/delete/{id}', 'ArticleController@delete')->name('article/delete');
    // Page "Voir" ou quand on clique sur le titre d'un article ou son id, on est renvoyé vers le détail de l'article en question
    Route::any('/voir/{id}', 'ArticleController@voir')->name('article/voir');
    // Bouton depuis la page "Voir" qui permet d'exporter dans un fichier PDF les détails de l'article en question (librairie barryvdh/laravel-dompdf)
    Route::any('/exportPDF/{id}', 'ArticleController@exportPDF')->name('article/exportPDF');
    // Bouton "Favoris" (avec un icône coeur remplis/vide) qui permet de stocker des articles mis en favoris ou de le supprimer des favoris
    Route::any('/favoris/{id}/', 'ArticleController@favoris')->name('article/favoris');
    // Route::any('/panier/{id}/{action}', 'ArticleController@panier')->name('article/panier');

    // Vider le panier des favoris (dans le Header)
    Route::get('/panier/clear/{id?}', 'ArticleController@clearCart')->name('article.clear');
    // Route pour le paiement des articles favoris aujouté au panier (via API Stripe)
    Route::any('/paiement', 'ArticleController@paiement')->name('article/paiement');

  });


  /*
  * Routes Commentaire
  * (Groupage) +  Controlleur + Vue
  */
  Route::group(['prefix' => 'commentaire'], function() {
    Route::any('/list', 'CommentaireController@lister')->name('commentaire/list');
    // Système de modération avec un lien permettant de modifier l'état du commentaires (En ligne - En relecture - A supprimer)
    Route::any('/etat/{id}', 'CommentaireController@etat')->name('commentaire/etat');
    // Bouton "Supprimer" pour pouvoir supprimer le commentaire dont l'état est "A supprimer"
    Route::any('/delete/{id}', 'CommentaireController@delete')->name('commentaire/delete');
    // Pouvoir éditer un commentaire (avec modifcation du contenu et ajout d'une note de 1 à 5)
    Route::any('/edition/{id}', 'CommentaireController@editionCommentaire')->name('commentaire/edition');
  });

});

// Route d'authentification
Route::auth();
