<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Categorie;
use App\Media;
use App\Commentaire;
use Mail;
use App;
use Twitter;

class WelcomeController extends Controller {

  // Modifier la langue
  public function langue($locale) {
    // Toute la configuration de notre application
    // setLocale() => permet de modifier la langue
    App::setLocale($locale);
    return redirect()
    ->back()
    ->with('success',
      trans('messages.successLangue')
    );
  }

  // Répartition des articles par catégories (retourner du JSON - un tableaux d'objet en JS)
  public function statsCategories() {

    $nbCat = Article::getNbArticlesByCategories();

    // parser les values
    foreach ($nbCat as $key => $categorie) {
      // caster une chaine en nombre
      $nbCat[$key]['value'] = (int) $nbCat[$key]['value'];
    }
    return $nbCat->toJson();
  }

  // Nombres de commentaires par articles
  public function statsCommentaires() {

    $nbCom = Commentaire::getNbCommentairesByArticles();

    // parser les values
    foreach ($nbCom as $key => $comments) {
      // caster une chaine en nombre
      $nbCom[$key]['value'] = (int) $nbCom[$key]['value'];
    }
    return $nbCom->toJson();
  }

  // Nombres de commentaires par année (sur les 5 dernières années)
  public function statsCommentairesAnnee() {

    $datas = [];

    for ($i = date('Y')-5; $i <= date('Y'); $i++) {
      $datas[] = [
        'year' => (string) $i,
        'value' => Commentaire::getNbCommentairesByYears($i)
       ];
    }
    return $datas;
  }




  /**
   * Home page
   */
  public function welcome() {

    // 4 Widgets du Dashboard
    $nbArticles = Article::getNbArticlesVisibles(1)->nb;
    $nbCategories = Article::getNbCategoriesFilled();
    $nbMedias = Media::getNbMediasUtilises();
    $nbCommentaires = Commentaire::getNbCommentairesActifs(2)->nb;

    // Module pour afficher mes 4 derniers tweets ou rt
    $tweets = Twitter::getUserTimeline(['screen_name' => 'Florian_V_', 'count' => 4, 'format' => 'object']);

    // dd($tweets);

    return view ('welcome',
      ['nbArticles' => $nbArticles,
      'nbCategories' => $nbCategories,
      'nbMedias' => $nbMedias,
      'nbCommentaires' => $nbCommentaires,
      'tweets' => $tweets,
      ]
    );

  }


  // Pour tweeter (ajouter un Tweet au module et sur Twitter)
  public function addTweet(Request $request) {
    Twitter::postTweet(['status' => $request->tweet]);
    return redirect()
    ->back()
    ->with('success', 'Tweet envoyé !');
  }

}
