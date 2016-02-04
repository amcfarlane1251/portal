(function(){
	'use strict';
	
	angular
		.module('portal')
		.controller('Projects', Projects);

		function Projects(project) {
			var vm = this;
			
			vm.projects = [];
			
			//turn request params into JSON object
			var paramObject = new Object();
			
			var queryString = JSON.stringify(paramObject);
			var publicKey = localStorage.getItem('publicKey');
			var hash = CryptoJS.HmacSHA256(CryptoJS.SHA1(queryString).toString(),CryptoJS.SHA1(publicKey).toString());
			var signature = CryptoJS.enc.Base64.stringify(hash);
			
			project.getProjects(publicKey, signature).then(function(results){
				console.log(results);
				vm.projects = results.data;
			}, function(error){
				console.log(error);
			});
		}
	
	angular
		.module('portal')
		.factory('project', project);

		function project($resource) {
			
			function getProjects(publicKey, signature) {
				// ngResource call - TODO: use $httpInterceptor to modify an existing resource object
										//would rather create the resource outside of the scope of each function
				var Project = $resource('api/projects/:id', 
					{id: "@id"}, 
					{
						"query": {
							'params':{'public_key':publicKey}, 
							'headers':{'Signature':signature}
						}
					}
				);
		
				return Project.query().$promise.then(function(results) {
					return results;
				}, function(error){
					console.log(error);
				});
			}
			
			return {
				getProjects: getProjects,
			}
		}
})();