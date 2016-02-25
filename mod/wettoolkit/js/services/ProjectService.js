(function() {
	'use strict';

	angular
		.module('portal')
		.factory('project', project);

		function project($resource, helper, $q) {
			
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
					return $q.reject(error);
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
					return $q.reject(error);
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
					return $q.reject(error);
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
					return $q.reject(error);
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
					return $q.reject(error);
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
					return $q.reject(error);
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

})();