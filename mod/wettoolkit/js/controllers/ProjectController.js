(function(){
	'use strict';
	
	angular
		.module('portal')
		.controller('Projects', Projects);

		function Projects(project, $location, Upload) {
			var vm = this;
			
			vm.projects = [];
			vm.opis = [];
			
			//turn request params into JSON object
			var paramObject = new Object();
			
			var queryString = JSON.stringify(paramObject);
			var publicKey = localStorage.getItem('publicKey');
			var hash = CryptoJS.HmacSHA256(CryptoJS.SHA1(queryString).toString(),CryptoJS.SHA1(publicKey).toString());
			var signature = CryptoJS.enc.Base64.stringify(hash);
			
			project.getProjects(publicKey, signature).then(function(results){
				vm.projects = results.data;
			}, function(error){
				console.log(error);
			});
			
			//add opi to vm
			vm.addContact = function() {
				vm.opis.push({});
			}
			
			vm.removeContact = function(index) {
				vm.opis.splice(index, 1);
			}
			
			//create a project
			vm.createProject = function () {
				project.create({
					'course':vm.course,
					'description': vm.description,
					'is_priority':vm.isPriority,
					'opi': vm.opis,
					'org':vm.org,
					'project_type':vm.type,
					'scope' : vm.scope,
					'status': 'Submitted',
					'title':vm.title,
				}).then(function(success) {
					Upload.upload({
						url: 'api/projects',
						data: {files:vm.files, 'projectId':success.data.id, 'accessId':success.data.accessId,'action':'attachFile'}
					}).then(function(success){
						project.getProjects(publicKey, signature).then(function(results){
							$location.path('projects');
						});
					}, function(error){
						console.log(error);
					});
				}, function(error){
					console.log(error);
				});
			}
		}
	
	angular
		.module('portal')
		.factory('project', project);

		function project($resource) {
			
			function getProjects(publicKey, signature) {
				// ngResource call - TODO: use $httpInterceptor to modify an existing resource object
										//would rather create the resource outside of the scope of each function
				var Project = $resource('api/projects/:id', 
					{}, 
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
			
			function create(data) {
				data.user_id = parseInt(localStorage.getItem('publicKey'));
				//stringify JSON 
				var queryString = JSON.stringify(data);
				//create signature
				var publicKey = localStorage.getItem('publicKey');
				var hash = CryptoJS.HmacSHA256(CryptoJS.SHA1(queryString).toString(),CryptoJS.SHA1(publicKey).toString());
				var signature = CryptoJS.enc.Base64.stringify(hash);
				
				var Project = $resource('api/projects/:id', 
					{}, 
					{
						"save": {
							method:'POST',
							'params':{'public_key':publicKey},
							'headers':{'Signature':signature}
						}
					}
				);

				return Project.save(data).$promise.then(function(success) {
					return success;
				}, function(error) {
					console.log(error);
				});
			}
			
			return {
				getProjects: getProjects,
				create : create
			}
		}
})();