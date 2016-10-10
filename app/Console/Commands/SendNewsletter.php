<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utilisateur;
use Mail;

class SendNewsletter extends Command
{
  /**
  * The name and signature of the console command.
  *
  * @var string
  */
  protected $signature = 'send:newsletter';

  /**
  * The console command description.
  *
  * @var string
  */
  protected $description = 'Send a newsletter for bad users';

  /**
  * Create a new command instance.
  *
  * @return void
  */
  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Execute the console command.
  *
  * @return mixed
  */
  public function handle() {
    // requete pour récupérer les utilisateurs inactifs dans les commmentaires
    $users = Utilisateur::getBadUser();

    foreach ($users as $user) {
      // envoyer un mail à chacun des utilisateurs
      Mail::send('email/newsletter', ['user' => $user ],
      function ($m) use($user){
        $m->from('florianvarenne@gmail.com', 'Florian VARENNE');
        $m->to($user->email, $user->nom)
        ->subject("N'oubliez pas de poster des commentaires !!!");
      });
    }

  }

}
