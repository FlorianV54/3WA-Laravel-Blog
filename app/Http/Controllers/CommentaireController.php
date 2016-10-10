<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Validator;
use Carbon\Carbon;
use App\Commentaire;
use Auth;

class CommentaireController extends Controller
{

  // Lister tous les commentaires
  public function lister(){
    $commentaires = Commentaire::all(); // récupérer tous les commentaires
    // transporteur => c'est un conteneur de données
    // elle envoi les données du controleur
    return view('commentaire/list', [
      'commentaires' => $commentaires
    ]);
  }

  // Système de modération avec un lien permettant de modifier l'état du commentaires (En ligne - En relecture - A supprimer)
  public function etat(Request $request, $id){

    $commentaire = Commentaire::find($id);

    if ($commentaire->etat == 1) {
      $commentaire->etat = 0;
    }
    elseif ($commentaire->etat == 2) {
      $commentaire->etat = 1;
    }
    else {
      $commentaire->etat = 2;
    }
    // OU
    // $commentaire->etat++;
    // if($commentaire->etat > 2) $commentaire->etat = 0;

    $commentaire->save();

    return redirect()->route('commentaire/list')
      ->with('success', "L'état du commentaire a bien été modifié");
  }

  // Bouton "Supprimer" pour pouvoir supprimer le commentaire dont l'état est "A supprimer"
  public function delete(Request $request, $id){

    $commentaire = Commentaire::find($id);

    $commentaire->delete();

    return redirect()->route('commentaire/list')
    ->with('danger', "Votre commentaire a bien été supprimé");
  }


  // Pouvoir éditer un commentaire (avec modifcation du contenu et ajout d'une note de 1 à 5)
  public function editionCommentaire(Request $request, $id){

    $validator = Validator::make($request->all(), [
      'content' => 'required|min:15|max:3000',
      'note' => 'required',
    ]);

    // si mon formulaire a été envoyé/soumis et qu'il a échoué au niveau des validations
    if ($validator->fails() && $request->isMethod('post')) {
      return redirect()->route('commentaire/edition', compact('id'))
      ->withErrors($validator) // avec erreurs
      ->withInput(); // avec champs remplis
    }
    elseif ($request->isMethod('post')) {
      $commentaire = Commentaire::find($id);
      $commentaire->content = $request->content;
      $commentaire->note = $request->note;
      $commentaire->save();

      // redirection avec message de success
      return redirect()->route('commentaire/list')
        ->with('success', "Votre commentaire a bien été modifié");
    }

    return view('commentaire/edition');
  }


  // Ajout du commentaire en BDD
  public function add(Request $request){

    $commentaire = new Commentaire();
    $commentaire->article_id = $request->articleId;
    $commentaire->content = $request->content;
    $commentaire->user_id = Auth::user()->id;
    $commentaire->save();
  }


}
