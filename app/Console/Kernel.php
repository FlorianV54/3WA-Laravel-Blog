<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
  /**
  * The Artisan commands provided by your application.
  *
  * @var array
  */
  protected $commands = [
    // enregister le nom de la classe parmis les commandes Laravel
    Commands\SendNewsletter::class,
  ];

  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule) {
    // Pour planifier l'envoi de newsletter toutes les minutes
    // depuis une console (cmd) => faire un "crontab -e" et ajouter la commande ci-dessous pour checker tous les 2 minutes
    // *2 * * * * >> php /chemin vers le dossier blog/blog/artisan schedule:run

    $schedule->command('send:newsletter')->everyMinute();
    // voir https://laravel.com/docs/5.3/scheduling#defining-schedules
  }

}
