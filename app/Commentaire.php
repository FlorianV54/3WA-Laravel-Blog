<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Commentaire extends Model
{
  /**
   * Liaison entre le Model et la table en bdd
   * Nom de ma table
   */
  protected $table = "comments";


  // récupérer les commentaires actifs (état "en ligne")
  public static function getNbCommentairesActifs($etat){

    return DB::table('comments')
      ->select(DB::raw('COUNT(*) as nb'))
      ->where('etat', '=', $etat)
      ->first();
  }


  // récupérer les commentaires par articles
  public static function getNbCommentairesByArticles() {

    return Commentaire::select(DB::raw('COUNT(comments.id) as value'), 'articles.titre as label')
     ->join('articles', 'articles.id', '=', 'comments.article_id')
     ->groupBy('article_id')
     ->get();
  }


  // récupérer les commentaires par années
  public static function getNbCommentairesByYears($annee) {

    return Commentaire::select(DB::raw('COUNT(*) as value'))
      ->whereYear('created_at', '=', $annee)
      ->first()->value;
  }

}
