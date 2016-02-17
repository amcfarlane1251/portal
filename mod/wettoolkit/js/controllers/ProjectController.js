(function(){
	'use strict';
	
	angular
		.module('portal')
		.controller('Projects', Projects);

		function Projects(project, $location, Upload, $routeParams, helper) {
			var vm = this;

			vm.projects = [];
			vm.opis = [];
			
			vm.statuses = [{name:'Submitted', id: 'Submitted'},{name:'Under Review', id: 'Under Review'}];
			vm.projectTypes = {"values":["Courseware","Instructor Support","Learning Application","Learning Technologies",
								"Mobile","Modelling and Simulation", "R and D", "Serious Gaming", "Support"]};
			vm.booleanOptions = {"values":["No","Yes"]};
			vm.multiOptions = {"values":["No","Update","Change"]};
			vm.isPriority = vm.booleanOptions.values[0];
			vm.type = vm.projectTypes.values[0];
			vm.isSme = vm.booleanOptions.values[0];
			vm.isLimitation = vm.booleanOptions.values[0];
			vm.updateExistingProduct = vm.multiOptions.values[0];
			
			//sign request
			var paramObject = new Object();
			var queryString = JSON.stringify(paramObject);
			var publicKey = localStorage.getItem('publicKey');
			
			var signature = helper.createSignature(queryString,publicKey);
			
			//get all projects
			project.getProjects(publicKey, signature).then(function(results){
				vm.projects = results.data;
			}, function(error){
				console.log(error);
			});
			
			//get single project
			if($routeParams.project_id) {
				project.getProject(publicKey, signature, $routeParams.project_id).then(function(results){
					vm.project = results.data;
					//set default value for existing project from saved json data
					vm.isPriority = vm.project.is_priority;
					vm.isSme = vm.project.is_sme_avail;
					if(vm.project.sme) {
						vm.project.sme = JSON.parse(vm.project.sme);
					}
					if(vm.project.opi.length) {
						vm.opis = JSON.parse(vm.project.opi);
					}
					if(vm.project.usa) {
						vm.project.usa = JSON.parse(vm.project.usa);
					}
					$(window).scrollTop(0);
				}, function(error){
					console.log(error);
				});
			}
			
			//partial update - status
			vm.updateStatus = function(index) {
				$('#statusSelect'+index).prop('disabled', 'disabled');
				project.update({
					'field':'status',
					'value':vm.projects[index].status
				}, vm.projects[index].id).then(function(success){
					$('#statusSelect'+index).prop('disabled', false);
				}, function(error){
					console.log(error);
				});
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
					'usa':vm.usa
				}).then(function(success) {
					Upload.upload({
						url: 'api/projects',
						data: {files:vm.files, 'projectId':success.data.id, 'accessId':success.data.accessId,'action':'attachFile'}
					}).then(function(success){
						
					}, function(error){
						console.log(error);
					});
					project.getProjects(publicKey, signature).then(function(results){
						vm.projects = results.data;
						$location.path('projects');
						$(window).scrollTop(0);
					});
				}, function(error){
					console.log(error);
				});
			}
			
			vm.editProject = function() {
				project.edit({
					'comments':vm.comments,
					'course':vm.course,
					'description': vm.description,
					'is_limitation': vm.project.is_limitation,
					'is_priority':vm.project.is_priority,
					'is_sme_avail': vm.project.is_sme_avail,
					'life_expectancy': vm.lifeExpectancy,
					'opi': vm.opis,
					'org':vm.org,
					'priority':vm.priority,
					'project_type':vm.project.project_type,
					'scope' : vm.scope,
					'sme' : vm.sme,
					'title':vm.title,
					'update_existing_product': vm.project.update_existing_product,
					'usa':vm.usa
				}, vm.project.id).then(function(success) {
					project.getProjects(publicKey, signature).then(function(results){
						vm.projects = results.data;
						$location.path('projects');
					});
				}, function(error){
					console.log(error);
				});
			}
			
			vm.deleteProject = function($id) {
				project.remove({}, $id).then(function(success){
					project.getProjects(publicKey, signature).then(function(results){
						vm.projects = results.data;
						$location.path('projects');
					});
				}, function(error){
					console.log(error);
				});
			}
			
			//helper methods
			vm.toggleContainer = function(toggle, container) {
				if(toggle=='Yes'){
					$('#'+container).show();
				}
				else if(toggle=='No'){
					$('#'+container).hide();
				}
			}

			//decide the boolean value of selected option box
			vm.boolOption = function(optionVal) {
				if (optionVal == 'Yes') {
					return true;
				}
				else {
					return false;
				}
			}
			
			//add opi to vm
			vm.addContact = function() {
				vm.opis.push({});
			}
			
			vm.removeContact = function(index) {
				vm.opis.splice(index, 1);
			}
			
			vm.filterProjects = function(event) {
				$(event.target).addClass('active');
				var status = $(event.target).attr('id');
				
				//create the signature
				var paramObject = new Object();
				paramObject.status = status;
				paramObject.createdAt
				var queryString = JSON.stringify(paramObject);
			
				var signature = helper.createSignature(queryString,publicKey);
				
				//get all projects
				project.getProjects(publicKey, signature, paramObject).then(function(results){
					vm.projects = results.data;
				}, function(error){
					console.log(error);
				});
			}
		}
	
	angular
		.module('portal')
		.factory('project', project);

		function project($resource, helper) {
			
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
					return results;
				}, function(error){
					console.log(error);
				});
			}
			
			function getProjects(publicKey, signature, filter) {
				var params = {'public_key':publicKey};
				
				filter = (typeof filter === 'undefined') ? null : filter;
				if(filter) {
					for (var key in filter) {
						if (filter.hasOwnProperty(key)) {
							params[key] = filter[key];
						}
					}
				}
				var Project = $resource('api/projects/:id', 
					{}, 
					{
						"query": {
							'params':params,
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
				var publicKey = localStorage.getItem('publicKey');
				
				var signature = helper.createSignature(queryString,publicKey);
				
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
			
			function edit(data, id) {
				data.user_id = parseInt(localStorage.getItem('publicKey'));
				//stringify JSON 
				var queryString = angular.toJson(data);
				var publicKey = localStorage.getItem('publicKey');
				
				var signature = helper.createSignature(queryString,publicKey);
				
				var Project = $resource('api/projects/:id',
					{id: "@id"},
					{
						"save": {
							method:'POST',
							'params':{'public_key':publicKey},
							'headers':{'Signature':signature}
						}
					}
				);
		
				return Project.save({'id':id},data).$promise.then(function(success){
					return success;
				}, function(error){
					console.log(error);
				});
			}
			
			function update(data, id) {
				//stringify JSON 
				var queryString = angular.toJson(data);
				//create signature
				var publicKey = localStorage.getItem('publicKey');
				var signature = helper.createSignature(queryString,publicKey);
				
				var Project = $resource('api/projects/:id', 
					{id: "@id"}, 
					{
						"update": {
							method:'PUT',
							'params':{'public_key':publicKey},
							'headers':{'Signature':signature}
						}
					}
				);
		
				return Project.update({'id': id},data).$promise.then(function(success){
					return success;
				}, function(error){
					console.log(error);
				});
			}

			function remove(data, id) {
				//stringify JSON 
				var queryString = angular.toJson(data);
				//create signature
				var publicKey = localStorage.getItem('publicKey');
				var signature = helper.createSignature(queryString,publicKey);

				var Project = $resource('api/projects/:id', 
					{id: "@id"}, 
					{
						"remove": {
							method:'DELETE',
							'params':{'public_key':publicKey},
							'headers':{'Signature':signature}
						}
					}
				);

				return Project.remove({'id': id}, data).$promise.then(function(success){
					return success;
				}, function(error){
					console.log(error);
				});
			}
			
			return {
				getProject: getProject,
				getProjects: getProjects,
				create : create,
				edit : edit,
				update : update,
				remove : remove
			}
		}
		
	angular
		.module('portal')
		.service('helper', helper);

		function helper() {
			function createSignature(queryString,publicKey){
				var hashedQS = CryptoJS.SHA1(queryString).toString();
				var privateKey = CryptoJS.SHA1(publicKey).toString();

				var hash = CryptoJS.HmacSHA256(hashedQS,privateKey);

				return CryptoJS.enc.Base64.stringify(hash);
			}
			
			return {
				createSignature : createSignature
			}
		};
        
    angular
		.module('portal')
		.directive('ngConfirmationNeeded', function () {
            return {
                priority: 1,
                terminal: true,
                link: function (scope, element, attr) {
                    var msg = attr.ngConfirmationNeeded || "Are you sure?";
                    var clickAction = attr.ngClick;
                    element.bind('click',function () {
                        if ( window.confirm(msg) ) {
                            scope.$eval(clickAction)
                        }
                    });
                }
            };            
        });
})();