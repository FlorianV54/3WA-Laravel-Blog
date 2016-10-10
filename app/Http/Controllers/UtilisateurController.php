<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Validator;
use Carbon\Carbon;
use App\Utilisateur;

class UtilisateurController extends Controller {

  // Lister tous les utilisateurs
  public function lister(){
    $users = Utilisateur::all(); // récupérer tous les utilisateurs
    // transporteur => c'est un conteneur de données
    // elle envoi les données du controleur
    return view('utilisateur/list', [
      'users' => $users
    ]);
  }

  // Bouton "Supprimer" a coté de chaque utilisateur
  public function delete(Request $request, $id){

    $utilisateur = Utilisateur::find($id);

    $utilisateur->delete();

    return redirect()->route('utilisateur/list')
      ->with('danger', "L'utilisateur a bien été supprimé");
  }

  // Créer un nouvel utilisateur
  public function utilisateur(Request $request){

    $validator = Validator::make($request->all(), [
      'nom' => 'required|min:3|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'prenom' => 'required|min:3|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'email' => 'required|email|unique:user',
      'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_#+$@$!%*?&])[A-Za-z\d-_#+$@$!%*?&]{6,}/',
      'confirmationPassword' => 'required|same:password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_#+$@$!%*?&])[A-Za-z\d-_#+$@$!%*?&]{6,}/',
      'telephone' => ['required','regex:/^(\(\+[\d]{2,3}?\)|0|\+33|0033)[1-9]([0-9]{8}|([0-9\-\.\/ ]){12})\b/'],
      'code_postal' => ['required','regex:/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/'],
      'ville' => 'required|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'date_naissance' => 'required',
      'biographie' => 'required|min:15|max:3000',
      'image' => 'image|dimensions:min_width=100,min_height=200',
    ]);

    // si mon formulaire a été envoyé/soumis et qu'il a échoué au niveau des validations
    if ($validator->fails() && $request->isMethod('post')) {
      return redirect()->route('utilisateur') // redirige vers le nom de la route
      ->withErrors($validator) // avec erreurs
      ->withInput(); // avec champs remplis
    }
    elseif ($request->isMethod('post')) {
      // formulaire est soumis et valide
      // enregistrer en bdd l'utilisateur
      $utilisateur = new Utilisateur();
      $utilisateur->nom = $request->nom;
      $utilisateur->prenom = $request->prenom;
      $utilisateur->email = $request->email;
      $utilisateur->password = bcrypt($request->password);
      $utilisateur->confirmation_password = bcrypt($request->confirmation_password);
      $utilisateur->telephone = $request->telephone;
      $utilisateur->code_postal = $request->code_postal;
      $utilisateur->ville = $request->ville;
      $utilisateur->date_naissance = Carbon::CreateFromFormat('d/m/Y', $request->date_naissance)->format('Y-m-d');
      $utilisateur->biographie = $request->biographie;
      $utilisateur->date_auth = Carbon::now($request->date_auth)->format('Y-m-d H:i:s');

      // pour l'upload d'image
      if ($request->hasFile('image')) { // 'image' => c'est le "name" du champs
        $destinationPath = public_path("/images/"); // destination
        $file = $request->file('image'); // je récupère le fichier
        $fileName = $file->getClientOriginalName(); // je récupère le nom du fichier
        $file->move($destinationPath, $fileName); // je bouge le fichier
        $utilisateur->image = $fileName; // enregistrement en bdd du nom du fichier
      }

      $utilisateur->save();

      // redirection avec message de success
      return redirect()->route('utilisateur')
        ->with('success', "L'utilisateur a bien été créé");
    }
    return view('utilisateur/add');
  }

}
