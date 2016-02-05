(function(){
	'use strict';
	
	angular
		.module('portal', [
			'ngResource',
			'ngRoute',
		]);
		
	angular
		.module('portal')
		.config(function($routeProvider) {
			$routeProvider.when('/projects',{
				templateUrl: 'projects/list',
			}).
			when('/projects/create',{
				templateUrl: 'projects/add',
			}).
			otherwise({
				redirectTo: '/projects'
			});
		});
})();