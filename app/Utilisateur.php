<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Utilisateur extends Authenticatable {
  /**
   * Liaison entre le Model et la table en bdd
   * Nom de ma table
   */
  protected $table = "user";



  /**
   * Envoyer une newsletter des utilisateurs qui n'ont pas encore commenté
   */
  public static function getBadUser(){
    return DB::table('user')->select('nom', 'email')
    ->leftJoin('comments', 'comments.user_id', '=', 'user.id')
    ->whereNull('comments.user_id')
    ->get();
  }


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'image', 'nom', 'prenom', 'ville', 'code_postal', 'date_naissance', 'telephone', 'biographie', 'email', 'password', 'twitter_id', 'facebook_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];


}
