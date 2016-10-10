// Initialisation de l'apllication "app"
var app = angular.module('app', ['firebase']);

// configure l'affichage de nos données de la scope
// #{ .... }# => pour déférencier les {{ }} de BLADE (car Laravel-blade prend des doubles accolades par défaut, comme Angular)
app.config(function($interpolateProvider){
  $interpolateProvider.startSymbol('#{').endSymbol('}#');
});

/**
 * FILTRES
 */
// Filtre pour afficher l'heure des post dans le Tchat et autres ("il y a ... heure ou secondes etc..")
app.filter('ago', function() {
  return function(input){
    moment.locale('fr'); // initialize moment en français
    var dateTime = new Date(input);
    dateTime = moment(dateTime).fromNow();
    // fromNow() : transformer en format humain
    return dateTime;
  };
});

// Filtre pour supprimer les balises HTML générées par CKEditor lors de l'édition d'un commentaire
app.filter('suppBalisesHTML', function() {
  return function(input){
    return input ? String(input).replace(/<[^>]+>/gm, '') : '';
  };
});


/**
 * CONTROLLER pour le module "Tchat"
 */
app.controller('TchatController', function TchatController($scope, $http, $interval) {

    // $http => permet d'interroger une URL et de retourner les données en JSON
    // $interval => permet de rafraîchir les données sur une période de temps

  $scope.titre = "Tchat";

  $scope.messages = [];

  $scope.skipe = 0; // skipe => pour sauter un élément
  $scope.take = 5;

  $('.slimtest').scroll(function () {
    if ($('.slimtest').scrollTop() > 80) {
      $scope.take += 5;
    }
  });


  /**
   * Différence entre 2 taleaux d'objets par leur IDs
   * Passer de 90° à 45° sur le CPU
   */
  function areDifferentByIds(a, b) {
    var idsA = a.map( function(x){ return x.id; }).sort();
    var idsB = b.map( function(x){ return x.id; }).sort();
    return (idsA.join(',') !== idsB.join(',') );
  }

  // je charge mes donnees en JSON avec le module $http
  $interval(function(){
    $http.get('/admin/tchat/' + $scope.skipe + "/" + $scope.take)
      .then(function(response) {
        if (areDifferentByIds($scope.messages,response.data)) {
          $scope.messages = response.data;  // response.data sont les données renvoyées du serveur
        }
    });
  }, 500); // intervalle de temps en millisecondes par défaut (500 = 1/2 seconde)



  // ajout d'un message dans le Tchat
  $scope.add = function(){

    if ($scope.content.length > 0) { // pour ne pas envoyer du contenu "vide"
      // http post me permet de faire une REQUETE en Post
      $http.post('/admin/tchat-add', // url (uri)
      {'content' : $scope.content.trim()})
      // content : name de mon input-group
      // $scope.content: c'est la valeur de mon input-group
      // envoies des données
      .then(function(response) {
        $scope.content = '';
      });
    }
  };

});



/**
 * CONTROLLER pour le module "Article Aléatoire avec ajout de commentaires"
 */
app.controller('CommentaireController', function CommentaireController($scope, $http, $interval) {

  $scope.categorie = '';

  // Pour afficher l'article aléatoire
  $scope.article = '';

  $http.get('/admin/article-aleatoire').then(function(response) {
      $scope.article = response.data; // response.data sont les données renvoyées du serveur
      $scope.articleId = $scope.article.id;

      // Ajout commentaires
      $scope.commentaires = [];
      $scope.take = 5;

      $('.slimtest').scroll(function () {
        if ($('.slimtest').scrollTop() > 80) {
          $scope.take += 5;
        }
      });

      /**
      * Différence entre 2 taleaux d'objets par leur IDs
      * Passer de 90° à 45° sur le CPU
      */
      function areDifferentByIds(a, b) {
        var idsA = a.map( function(x){ return x.id; }).sort();
        var idsB = b.map( function(x){ return x.id; }).sort();
        return (idsA.join(',') !== idsB.join(',') );
      }

      // je charge mes donnees en JSON avec le module $http
      $interval(function(){
        $http.get('/admin/commentaires/article-' + $scope.articleId + "/" + $scope.take)
        .then(function(response) {
          if (areDifferentByIds($scope.commentaires,response.data)) {
            $scope.commentaires = response.data;  // response.data sont les données renvoyées du serveur
          }
        });
      }, 500); // intervalle de temps en millisecondes par défaut (500 = 1/2 seconde)


      // Ajout d'un commentaire à l'article aléatoire
      $scope.add = function(){

      if ($scope.content.length > 0) { // pour ne pas envoyer du contenu "vide"
        // http post me permet de faire une REQUETE en Post
        $http.post('/admin/commentaire-add', // url (uri)
        {
          'content' : $scope.content.trim(),
          'articleId' : $scope.articleId,
        })
        // content : name de mon input-group
        // $scope.content: c'est la valeur de mon input-group
        // envoies des données
        .then(function(response) {
          $scope.content = '';
        });
      }
    };

    // Suppression d'un commentaire ajouté à un article
    $scope.delete = function(){

      // http post me permet de faire une REQUETE en Post
      $http.post('/admin/commentaire/delete', // url (uri)
      {'content' : $scope.content.trim()})
      // content : name de mon input-group
      // $scope.content: c'est la valeur de mon input-group
      // envoies des données
      .then(function(response) {
        $scope.content = '';
      });
    };

    // pour récupérer le titre de la catégorie en fonction de l'article aléatoire affiché
    $http.get('/admin/commentaires/categorie-' + $scope.article.categorie_id).then(function(response) {
      $scope.categorie = response.data;
      $scope.categorie = $scope.categorie[0].titre; // $scope.categorie[0].titre => pour récupérer le titre de la catégorie dans le tableau d'objet [0]
    });

  });

});
