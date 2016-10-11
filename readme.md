# Back-office Blog

![Dashboard](/public/images/dashboard.png)

Back-office d'administration d'un Blog (créé durant ma formation à la [3W Academy](https://3wa.fr/))

- CRUD (utilisateurs, articles, médias ...)
- Dashboard (Widgets de stats, graph Morris Chart, affichage de tweets et vidéos stockés via Firebase)
- Export HTML en PDF avec [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- Système de chat en temps réel
- Système de paiement (API Stripe)
- Système d'envoi de mails (MailTrap)
- Authentification via formulaire d'inscription ou via réseaux sociaux (APIs Facebook/Twitter)
- ...

## Tech
- Projet créé sous `Laravel 5.2` avec une partie front en `Angular JS`
- Fonctionnelle avec les environnements `LAMP/WAMP/MAMP...`
- Thème utilisé [AdminLTE-2.3.6 design](https://almsaeedstudio.com/preview)

## Installation
- La base de données `blog.sql` est stocké dans le dossier `\database\_BDD`
- Toutes les dépendances nécessaires sont répertoriées dans le fichier `composer.json`
```
composer install
```
#### !!! N'oubliez pas de renseigner votre propre fichier .env avec toutes les informations nécessaires :
- **BDD**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=xxxxxxxxxxxxxxx
DB_PASSWORD=xxxxxxxxxxxxxxx
```

- **MailTrap**
```
MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxxxxxxxxxxxxx
MAIL_PASSWORD=xxxxxxxxxxxxxxx
MAIL_ENCRYPTION=null
```

- **API Twitter**
```
# Pour s'authentifier via Twitter sur la page de Login
AUTH_TWITTER_CONSUMER_KEY=xxxxxxxxxxxxxxx
AUTH_TWITTER_CONSUMER_SECRET_KEY=xxxxxxxxxxxxxxx
CALLBACK_URL=http://localhost:8000/auth/twitter/callback
```
> - créez votre propre app Twitter à l'adresse `https://apps.twitter.com/`
```
# Pour l'affichage de vos tweets dans le Dashboard
TWITTER_CONSUMER_KEY=xxxxxxxxxxxxxxx
TWITTER_CONSUMER_SECRET=xxxxxxxxxxxxxxx
TWITTER_ACCESS_TOKEN=xxxxxxxxxxxxxxx
TWITTER_ACCESS_TOKEN_SECRET=xxxxxxxxxxxxxxx
```
> - créez votre propre app Twitter à l'adresse `https://apps.twitter.com/`
> - dans le fichier `WelcomeController.php` modifiez la ligne ci-dessous avec votre propre login Twitter
```
$tweets = Twitter::getUserTimeline(['screen_name' => 'votre identifiant Twitter', 'count' => 4, 'format' => 'object']);
```

- **API Facebook**
```
FACEBOOK_CLIENT_ID=xxxxxxxxxxxxxxx
FACEBOOK_CLIENT_SECRET=xxxxxxxxxxxxxxx
FACEBOOK_CALLBACK_URL=http://localhost:8000/auth/facebook/callback
```
> - créez votre propre app Facebook à l'adresse `https://developers.facebook.com/`

- **API Stripe**
> - connectez-vous ou créez un compte à l'adresse `https://stripe.com/fr`, puis `Account Settings` et `API keys`
```
# Pour le paiement des articles (Test Secret Key)
MY_PRIVATE_KEY_STRIPE=xxxxxxxxxxxxxxx
```
> - dans le fichier `paiement.blade.php` modifiez la ligne ci-dessous avec votre propre clé  `Test Publishable Key`
```
Stripe.setPublishableKey('votre Test Publishable Key ');
```

## Connexion
Pour se connecter au Back-Office :
```
C:\xxxxx\yyyyyy\zzzzz\blog> php artisan serve
```
- [http://localhost:8000/login](http://localhost:8000/login)
- login `test@test.com`
- password `test123`

![Login](/public/images/login.png)

## Auteurs
* **Florian VARENNE** - [FlorianV54](https://github.com/FlorianV54)

Avec l'aide de **Julien Boyer** [Symfomany](https://github.com/Symfomany) - formateur à la [3W Academy](https://3wa.fr/)
