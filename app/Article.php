<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model
{
  /**
   * Liaison entre le Model et la table en bdd
   * Nom de ma table
   */
  protected $table = "articles";


  // Récupérer les articles par catégories
  public static function getNbArticlesByCategories() {

    return Article::select(DB::raw('COUNT(articles.id) as value'), 'categorie.titre as label')
     ->join('categorie', 'categorie.id', '=', 'articles.categorie_id')
     ->groupBy('categorie_id')
     ->get();
  }


  // Récupérer les articles visibles
  public static function getNbArticlesVisibles($visibilite){

    return DB::table('articles')
      ->select(DB::raw('COUNT(*) as nb'))
      ->where('visibilite', '=', $visibilite)
      ->first();
  }


  // Récupérer les catégories remplis
  public static function getNbCategoriesFilled() {
    return Article::join('categorie', 'categorie.id', '=', 'articles.categorie_id')
     ->count();
  }


}
