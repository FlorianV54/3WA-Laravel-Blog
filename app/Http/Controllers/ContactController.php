<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Validator;
use App\Contact;

/**
 * Request $request: un objet representant ma requete
 * $request => contient toutes les donnees en POST de manieres sécurisés
 *
 */
class ContactController extends Controller
{
  public function contact(Request $request) {

    $validator = Validator::make($request->all(), [
      'nom' => 'required|min:3|regex:/^[a-zA-Z][a-zéèçàù\'\-\ ]+$/i',
      'email' => 'required|email',
      'message' => 'required|min:5|max:400',
      'site' => 'active_url',
      'sujet' => 'required|in:contact,article,demande,autre',
      'genre' => 'required|in:masculin,feminin',
      'cgu' => 'required',
    ]);

    // si mon formulaire a été envoyé/soumis et qu'il a échoué au niveau des validations
    if ($validator->fails() && $request->isMethod('post')) {
      return redirect()->route('contact') // redirige vers le nom de la route
      ->withErrors($validator) // avec erreurs
      ->withInput(); // avec champs remplis

    } elseif ($request->isMethod('post')) {
      // formulaire est soumis et valide
      // enregistrer en bdd le contact
      $contact = new Contact();
      $contact->genre = $request->genre;
      $contact->nom = $request->nom;
      $contact->sujet = $request->sujet;
      $contact->email = $request->email;
      $contact->site = $request->site;
      $contact->message = $request->message;
      $contact->save();

      // redirection avec message de success
      return redirect()->route('contact')
        ->with('success', 'Votre formulaire a bien été envoyé');
    }
    return view('contact');
  }

}
