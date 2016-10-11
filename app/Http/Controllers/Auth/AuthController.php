<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Carbon\Carbon;
use Auth;
use Socialite;
use App\Utilisateur;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
  * Where to redirect users after login / registration.
  *
  * @var string
  */
  protected $redirectTo = '/admin';

  // Redirection vers la page de login après déconnnexion
  protected $redirectAfterLogout = '/login';

  /**
  * Create a new authentication controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
  }

  // "custom" Logout (si on a été connecté via un compte Facebook ou Twitter)
  public function logout() {
    Session::forget('LoginMethode');
    Auth::logout();
    return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function validator(array $data)
  {
    $dt = new Carbon('-18 years', 'Europe/Paris'); // pour valider que l'utilisateur et majeur

    return Validator::make($data, [
      'nom' => 'required|min:3|max:255|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'email' => 'required|email|max:255|unique:user',
      'password' => 'required|min:6|confirmed',
      'prenom' => 'required|min:3|max:255|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'telephone' => ['required','regex:/^(\(\+[\d]{2,3}?\)|0|\+33|0033)[1-9]([0-9]{8}|([0-9\-\.\/ ]){12})\b/'],
      'code_postal' => ['required','regex:/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/'],
      'ville' => 'required|regex:/^[a-z][a-zéèçàù\'\-\ ]+$/i',
      'date_naissance' => 'required|date_format:d/m/Y|before:'.$dt->format('d/m/Y'),
      'biographie' => 'required|min:15|max:3000',
      'image' => 'image|dimensions:min_width=100,min_height=200',
    ]);
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return Utilisateur
  */
  protected function create(array $data)
  {
    $fileName = "";

    // pour l'upload d'image
    if (isset($data['image']) && !empty($data['image'])) {
      $destinationPath = public_path("/images/"); // destination
      $file = $data['image']; // je récupère le fichier
      $fileName = $file->getClientOriginalName(); // je récupère le nom du fichier
      $file->move($destinationPath, $fileName); // je bouge le fichier
    }

    $date_naissance = Carbon::CreateFromFormat('d/m/Y', $data['date_naissance']);

    return Utilisateur::create([
      'nom' => $data['nom'],
      'prenom' => $data['prenom'],
      'ville' => $data['ville'],
      'code_postal' => $data['code_postal'],
      'date_naissance' => Carbon::parse($date_naissance),
      'telephone' => $data['telephone'],
      'biographie' => $data['biographie'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'image' => $fileName,
    ]);
  }



  // AUTHENTIFICATION via TWITTER
  /**
  * Redirect the user to the Twitter authentication page.
  *
  * @return Response
  */
  public function redirectToProviderTwitter()
  {
    return Socialite::driver('twitter')->redirect();
  }

  /**
  * Obtain the user information from Twitter.
  *
  * @return Response
  */
  public function handleProviderCallbackTwitter(Request $request)
  {
    try {
      $user = Socialite::driver('twitter')->user();
    } catch (Exception $e) {
      return redirect('auth/twitter');
    }

    $authUser = $this->findOrCreateUserTwitter($user);

    Auth::login($authUser, true);

    $request->session()->put('LoginMethode', 'twitter');

    return redirect()->route('welcome');
  }

  /**
  * Return user if exists; create and return if doesn't
  *
  * @param $twitterUser
  * @return User
  */
  private function findOrCreateUserTwitter($twitterUser)
  {
    $authUser = Utilisateur::where('twitter_id', $twitterUser->id)->first();

    if ($authUser){
      return $authUser;
    }

    return Utilisateur::create([
      'nom' => $twitterUser->name,
      'twitter_id' => $twitterUser->id,
      'image' => $twitterUser->avatar_original,
    ]);
  }


  // AUTHENTIFICATION via FACEBOOK
  /**
  * Redirect the user to the Facebook authentication page.
  *
  * @return Response
  */
  public function redirectToProviderFacebook()
  {
    return Socialite::driver('facebook')->redirect();
  }

  /**
  * Obtain the user information from Facebook.
  *
  * @return Response
  */
  public function handleProviderCallbackFacebook(Request $request)
  {
    try {
      $user = Socialite::driver('facebook')->user();
    } catch (Exception $e) {
      return redirect('auth/facebook');
    }

    $authUser = $this->findOrCreateUserFacebook($user);

    Auth::login($authUser, true);

    $request->session()->put('LoginMethode', 'facebook');

    return redirect()->route('welcome');
  }

  /**
  * Return user if exists; create and return if doesn't
  *
  * @param $facebookUser
  * @return Utilisateur
  */
  private function findOrCreateUserFacebook($facebookUser)
  {
    $authUser = Utilisateur::where('facebook_id', $facebookUser->id)->first();

    if ($authUser){
      return $authUser;
    }

    return Utilisateur::create([
      'nom' => $facebookUser->name,
      'email' => $facebookUser->email,
      'facebook_id' => $facebookUser->id,
      'image' => $facebookUser->avatar
    ]);
  }


}
