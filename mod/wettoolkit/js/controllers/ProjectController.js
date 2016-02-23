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
				$(window).scrollTop(0);
				vm.loaded = false;
				project.getProject(publicKey, signature, $routeParams.project_id).then(function(results){
					vm.project = results.data;

					//set default value for existing project from saved json data
					vm.comments = vm.project.comments;
					vm.course = vm.project.course;
					vm.description = vm.project.description;
					vm.isPriority = vm.project.is_priority;
					vm.isSme = vm.project.is_sme_avail;
					vm.lifeExpectancy = vm.project.life_expectancy;
					vm.org = vm.project.org;
					vm.priority = vm.project.priority;
					vm.scope = vm.project.scope;
					vm.title = vm.project.title;
					if(vm.project.sme) {
						vm.project.sme = JSON.parse(vm.project.sme);
					}
					if(vm.project.opi.length) {
						vm.opis = JSON.parse(vm.project.opi);
					}
					if(vm.project.usa) {
						vm.project.usa = JSON.parse(vm.project.usa);
					}
					vm.loaded = true;
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
			vm.createProject = function (isValid) {
				if(isValid) {
					//prevent duplicate submission by disabling submit button after validation
					$('button[type="submit"]').attr('disabled', true);					
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
			}
			
			vm.editProject = function(isValid) {
				if(isValid) {
					//prevent duplicate submission by disabling submit button after validation
					$('button[type="submit"]').attr('disabled', true);
					project.edit({
						'comments':vm.comments,
						'course':vm.course,
						'description': vm.description,
						'is_limitation': vm.project.is_limitation,
						'is_priority':vm.isPriority,
						'is_sme_avail': vm.isSme,
						'life_expectancy': vm.lifeExpectancy,
						'opi': vm.opis,
						'org':vm.org,
						'priority':vm.priority,
						'project_type':vm.project.project_type,
						'scope' : vm.scope,
						'sme' : vm.project.sme,
						'title':vm.title,
						'update_existing_product': vm.project.update_existing_product
					}, vm.project.id).then(function(success) {
						project.getProjects(publicKey, signature).then(function(results){
							vm.projects = results.data;
							$location.path('projects');
						});
					}, function(error){
						console.log(error);
					});				
				}
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
				$('.list-group-item.active').removeClass('active');
				$(event.target).addClass('active');
				var status = $(event.target).attr('id');
				
				//create the signature
				var paramObject = new Object();
				if(status != 'All') {
					paramObject.status = status;
					paramObject.createdAt
				}
				
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

})();