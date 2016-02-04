portalApp.controller('ProjectController', function($scope, $http) {
	$scope.projects = [];
	var config = {headers: {
			'Signature': 'vhB9d99R8+HEhyne7o+6x5DnsW0DbzGYA35KLOWb+J4='
		}
	};
	
	$http.get('../api/projects?public_key=25121', config).
		success(function(data, status, headers, config){
			$scope.projects = data.data;
		});
});