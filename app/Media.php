<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Media extends Model
{
  /**
   * Liaison entre le Model et la table en bdd
   * Nom de ma table
   */
  protected $table = "media";


  // récupérer les médias utilisés
  public static function getNbMediasUtilises(){

    return Media::join('article_media', 'article_media.media_id', '=', 'media.id')
    ->groupBy('article_media.media_id')
    ->get()->count();
  }


}
