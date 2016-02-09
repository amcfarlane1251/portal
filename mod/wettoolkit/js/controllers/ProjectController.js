(function(){
	'use strict';
	
	angular
		.module('portal')
		.controller('Projects', Projects);

		function Projects(project, $location, Upload, $routeParams) {
			var vm = this;

			vm.projects = [];
			
			//sign request
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
			
			//get single project
			if($routeParams.project_id) {
				project.getProject(publicKey, signature, $routeParams.project_id).then(function(results){
					vm.project = results.data;
				}, function(error){
					console.log(error);
				});
			}
			
			//create a project
			vm.opis = [];
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
					'comments':vm.comments,
					'course':vm.course,
					'description': vm.description,
					'is_limitation': vm.isLimitation,
					'is_priority':vm.isPriority,
					'is_sme_avail': vm.isSme,
					'life_expectancy': vm.lifeExpectancy,
					'opi': vm.opis,
					'org':vm.org,
					'priority':vm.priority,
					'project_type':vm.type,
					'scope' : vm.scope,
					'sme' : vm.sme,
					'status': 'Submitted',
					'title':vm.title,
					'update_existing_product': vm.updateExistingProduct,
				}).then(function(success) {
					Upload.upload({
						url: 'api/projects',
						data: {files:vm.files, 'projectId':success.data.id, 'accessId':success.data.accessId,'action':'attachFile'}
					}).then(function(success){
						project.getProjects(publicKey, signature).then(function(results){
							vm.projects = results.data;
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
			
			function getProject(publicKey, signature, id) {
				var Project = $resource('api/projects/:id', 
					{id: "@id"}, 
					{
						"get": {
							'params':{'public_key':publicKey},
							'headers':{'Signature':signature}
						}
					}
				);
		
				return Project.get({}, {'id': id}).$promise.then(function(results) {
					console.log(results);
					return results;
				}, function(error){
					console.log(error);
				});
			}
			
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
				var queryString = angular.toJson(data);
				console.log(queryString);
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
				getProject: getProject,
				getProjects: getProjects,
				create : create
			}
		}
})();