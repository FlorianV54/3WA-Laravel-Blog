<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Validator;
use Carbon\Carbon;
use App\Media;

class MediaController extends Controller {

  public function media(Request $request){

    $validator = Validator::make($request->all(), [
      'titre' => 'required|regex:/[\w\d\_\-\ ]{3,}/i|unique:media',
      'page' => 'required|exists:page,id',
      'url' => 'required|active_url',
      'visibilite' => 'required|in:0,1',
      'date_activation' => 'required|date|after:yesterday',
    ]);

    // si mon formulaire a été envoyé/soumis et qu'il a échoué au niveau des validations
    if ($validator->fails() && $request->isMethod('post')) {
      return redirect()->route('media') // redirige vers le nom de la route
      ->withErrors($validator) // avec erreurs
      ->withInput(); // avec champs remplis

    } elseif ($request->isMethod('post')) {
      // formulaire est soumis et valide
      // enregistrer en bdd le media
      $media = new Media();
      $media->titre = $request->titre;
      $media->page_id = $request->page_id;
      $media->url = $request->url;
      $media->visibilite = $request->visibilite;
      $media->date_activation = Carbon::parse($request->date_activation)->format('Y-m-d');
      $media->save();

      // redirection avec message de success
      return redirect()->route('media')
        ->with('success', 'Votre vidéo a bien été envoyé');
    }
    return view('media');
  }

}
