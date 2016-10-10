<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tchat;

class TchatController extends Controller {

  // Ajouter un message dans le module Tchat du Dashboard
  public function add(Request $request){
    $tchat = new Tchat();
    $tchat->content = $request->content;
    $tchat->save();
  }
}
