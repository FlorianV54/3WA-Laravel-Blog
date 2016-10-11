<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Article;
use Mail;
use Auth;

class ArticleController extends Controller {

  // Lister tous les articles
  public function lister(){
    $articles = Article::all();
    // transporteur => c'est un conteneur de données
    // elle envoi les données du controleur
    return view('article/list', [
      'articles' => $articles
    ]);
  }

  // Lien/action pour rendre visible ou invisible un article
  public function visibility(Request $request, $id){

    $article = Article::find($id); //find() => permet de retourner un article

    if ($article->visibilite == 1) {
      $article->visibilite = 0;
    }
    else {
      $article->visibilite = 1;
    }
    $article->save();

    return redirect()->route('article/list')
      ->with('success', "La visibilitée de l'article a bien été modifié");
  }

  // un bouton "Supprimer" a coté de chaque article pour pouvoir supprimer l'article correspondant.
  public function delete(Request $request, $id){

    // Recevoir un mail lorsqu'un article est supprimé
    // 'email/welcome', [] => Nom de la vue + Transporteur de données
    Mail::send('email/welcome', [],
      function ($m){
        $m->from('florianvarenne@gmail.com', 'Florian VARENNE');
        $m->to('toto@gmail.com', 'TOTO')
        ->subject('Un article a été supprimé');
    });

    $article = Article::find($id);

    $article->delete();

    return redirect()->route('article/list')
      ->with('danger', "Votre article a bien été supprimé");

  }

  // Page "Voir" ou quand on clique sur le titre d'un article ou son id, on est renvoyé vers le détail de l'article en question
  public function voir(Request $request, $id){

    $article = Article::find($id); // récupére l'article par rapport à son ID
    return view('article/voir', [
      'article' => $article
    ]);
  }

  // Bouton depuis la page "Voir" qui permet d'exporter dans un fichier PDF les détails de l'article en question (librairie barryvdh/laravel-dompdf)
  public function exportPDF($id) {

    $article = Article::find($id);

    $dompdf = \App::make('dompdf.wrapper');
    $dompdf->loadHtml(
      "<h1># ".$article->id."</h1>".
      "<h2>".$article->titre."</h2>".
      "<img src='".$article->image."' width='400' />".
      "<br>".
      "<h3>Résumé</h3>".
      "<p>".$article->resume."</p>".
      "<h3>Description</h3>".
      "<p>".$article->description."</p>".
      "<h3>Note</h3>".
      "<p>".$article->note."</p>".
      "<h3>Année Publication</h3>".
      "<p>".$article->annee_publication."</p>".
      "<h3>Date de création</h3>".
      "<p>".$article->date_creation."</p>"
    );
    $dompdf->setPaper('A4', 'portrait');
    return $dompdf->stream('result', ["Attachment" => 0]);
  }

  // Bouton "Favoris" (avec un icône coeur remplis/vide) qui permet de stocker des articles mis en favoris ou de le supprimer des favoris
  public function favoris(Request $request, $id){

    // POUR STOCKAGE EN BDD
    $article = Article::find($id);

    if ($article->favoris == 0) {
      if ($article->favoris == 0) {
        $article->favoris = 1;
      }
      else {
        $article->favoris = 0;
      }
      $article->save();

      return redirect()->route('article/list')
        ->with('success', "L'article a été ajouté au favoris");
    }
    elseif ($article->favoris == 1) {
      if ($article->favoris == 1) {
        $article->favoris = 0;
      }
      else {
        $article->favoris = 1;
      }
      $article->save();

      return redirect()->route('article/list')
        ->with('danger', "L'article a été retiré des favoris");
    }

  }

  // // POUR STOCKAGE EN SESSION (+ voir la Route "article/panier")
  // public function panier(Article $id, $action){
  //
  //   $likes  = session('likes', []);
  //   if ($action == 'like') {
  //     $likes[$id->id] = $id->id;
  //     $message = "L'article {$id->titre} a bien été liké";
  //   }
  //   else {
  //     unset($likes[$id->id]);
  //     $message = "L'article {$id->titre} a bien été disliké";
  //   }
  //
  //   session()->put('likes', $likes);
  //
  //   return back()
  //   ->with('success', '$message');
  //
  // }

  // // Methode pour vider le panier
  // public function clearCart($id = null){
  //   if(!$id) {
  //     session()->pull('likes'); //nettoyage du panier
  //   }
  //   else {
  //     $likes = session('likes', []);
  //     unset($likes[$id]); //supprimer un element d'un tableau à partir d'une clef
  //     session()->put('likes', $likes);
  //   }
  //   return redirect()->route('article.list')
  //   ->with('success',"article supprimé");
  // }

  // Vider le panier des favoris (dans le Header)
  public function clearCart($id = null){
    if(!$id){
      session()->pull('likes');
    }else{
      $likes = session('likes', []);
      unset($likes[$id]); //supprimer un element d'un tableau à partir d'une clef
      session()->put('likes', $likes);
    }
    return back()
    ->with('success',"article supprimé");
  }


  // Système de "paiement" via l'API Stripe
  public function paiement(Request $request){

    // $somme => le prix total des articles favoris
    $somme = Article::where('favoris', '=', '1')->sum('prix');
    // $somme => "Sous-total" arrondi à 2 chiffres après virgule
    $somme = round($somme, 2);
    // $sommeTotal => "Sous-total" + TVA de 20% (le tout arrondi à 2 chiffres après virgule)
    $sommeTotal = round(($somme + $somme * 0.20), 2);

    // Si on a soumis le formulaire
    if($request->isMethod('post')){
      // clé "privé" de Stripe (Test Secret Key) pour que mon serveur puisse s'y connecter
      \Stripe\Stripe::setApiKey(env('MY_PRIVATE_KEY_STRIPE'));
      //create a customer pour Stripe
      $customer = \Stripe\Customer::create(array(
        "description" =>  Auth::user()->prenom ." ".Auth::user()->nom,
        "email" => Auth::user()->email,
        "source" => $request->stripeToken // obtenu via l'étape précédente
      ));
      // créer une charge
      \Stripe\Charge::create([
        "amount" => $sommeTotal * 100, // En centimes !!!
        "currency" => "eur",
        "customer" => $customer->id
      ]);

      return redirect()->route('article/paiement') // redirige vers la page paiement
        ->with('success', "Vous avez bien été débité de ".$sommeTotal ."€");
    }

    return view('article/paiement', [
      "somme" => $somme
    ]);

  }



}
