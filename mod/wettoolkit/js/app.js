(function(){
	'use strict';
	
	angular
		.module('portal', [
			'ngResource',
			'ngRoute',
			'ngFileUpload'
		]);
		
	angular
		.module('portal')
		.config(function($routeProvider) {
			$routeProvider.when('/projects',{
				templateUrl: 'projects/list',
				controller: 'Projects as vm',
			}).
			when('/projects/create',{
				templateUrl: 'projects/add',
				controller: 'Projects as vm',
			}).
			when('/projects/view/:project_id',{
				templateUrl: function(params){return 'projects/view/'+params.project_id;},
				controller: 'Projects as vm'
			}).
			when('/projects/edit/:project_id',{
				templateUrl: function(params){return 'projects/edit/'+params.project_id;},
				controller: 'Projects as vm'
			}).
			otherwise({
				redirectTo: '/projects'
			});
		});
})();