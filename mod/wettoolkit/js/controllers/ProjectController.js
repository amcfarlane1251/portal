portalApp.controller('ProjectController', function($scope, $http) {
	$scope.projects = [];
	
	$http.get('/api/projects').
		success(function(data, status, headers, config){
			$scope.projects = data;
			console.log(data);
		});
});