app.controller('VideoController', function VideoController($scope, $firebaseArray, $filter, $sce) {

    // $firebaseArray: C'est un service du module
    // firebase pour récupérer mes données sous forme de tableau

    // récupérer la référence de ma base de données "videos"
    var ref = firebase.database().ref();

    // trié par titre (orderByChild)
    // et limite 4 depuis le 1er résultat (limitToFirst)
    var query = ref.orderByChild("titre"); //always 4

    //  permet de convertir mes données de la query sous forme de tableau
    $scope.datas  = $firebaseArray(query);


  $scope.formattage = function(src){
    return $sce.trustAsResourceUrl(src.replace("watch?v=", "embed/"));
  };
  // Suppression d'une vidéo du "tableau" Firebase
  $scope.remove = function(video){
  		$scope.datas.$remove(video);
  };
  // Ajout d'une vidéo dans le "tableau" Firebase
	$scope.add = function(){
		$scope.datas.$add({
			titre : $scope.titre.trim(),
			description : $scope.description,
			url : $scope.url,
			annee : $scope.annee,
			created_at : $scope.created_at,
		});
	};

});
