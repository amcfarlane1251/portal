<?php
function apiPageHandler($page){
	//common vars for all resources
	$headers = apache_request_headers();
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch($page[0]) {
		case 'authenticate':
			switch($method) {
				case 'POST':
					$authenticate = new Authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
					
					if($authenticate->validate()) {
						if($authenticate->login()) {
							header("HTTP/1.1 200 OK");
							
							$responseInfo = $authenticate->getResponseInfo();
							
							$data['userId'] = $responseInfo['userId'];
							$data['publicKey'] = $responseInfo['publicKey'];
							$data['privateKey'] = $responseInfo['privateKey'];
							$status = 'success';
						}
						else{
							//unauthorized
							header('X-PHP-Response-Code: 401', true, 401);
							
							$data = $authenticate->errors;
							$status = 'fail';
						}
					}
					else{
						//model validation has failed - client error
						header('X-PHP-Response-Code: 400', true, 400);
						
						$status = 'fail';
						$data = $authenticate->errors;
					}
					header('Content-type: application/json');
					echo json_encode(array('status'=>$status, 'data'=>$data));
					
					exit;
					break;
			}
			exit;
			break;
			
		case 'users':
			$signature = $headers['Signature'];
			switch($method) {
				case 'PUT':
					$publicKey = 25121;
					$userId = $page[1];
					$payload = array();
					
					//sanitize input
					$payload = json_decode(file_get_contents("php://input"), true);
					//$payload = json_encode($putVars);
					/*foreach($putVars as $key => $value) {
						if($key!='signature') {
							$payload[$key] = $value;
						}
					}*/
					
					$session = new Session($publicKey, $signature, $payload);
					
					if($session->verifySignature()) {
						$user = new User();
						
						foreach($payload as $key => $value) {
							$user->$key = $value;
						}
						
						if($user->validate()) {
							if($user->update()) {
								//return 200
								$session->setheader(200);
							}
							else{
								//return 
							}
						}
						else{
							//return 400 - client error
							$session->setheader(400);
						}
					}
					else{
						//return 401 - unauthorized
						$session->setheader(401);
					}
					
					exit;
					break;
			}
		case 'projects':
			$signature = $headers['Signature'];
			
			switch($method) {
				case 'GET':
					$publicKey = get_input('public_key');
					$params = array();
					
					if($page[1]) {
						$session = new Session($publicKey, $signature, $params);
						if($session->verifySignature()) {
							//load single resource
							$project = Project::withID($page[1],$session);
							$data = $project;
							$session->setHeader(200);
						}
						else{
							$session->setHeader(401);
						}
					}
					else{
						//retreive all resources with optional filters
						$status = get_input('status', null);
						$createdAt = get_input('created_at', null);

						$status ? $params['status'] = $status : '';
						$createdAt ? $params['created_at'] = $createdAt : '';
						
						$session = new Session($publicKey, $signature, $params);
						if($session->verifySignature()) {
							$projects = Project::all($params, $session);

							$data = $projects->getCollection();
							$session->setHeader(200);
						}
						else{
							$session->setHeader(401);
						}
					}
					
					header('Content-type: application/json');
					echo json_encode(array('status'=>$status, 'data'=>$data), 32);
					
					exit;
					break;
				case 'POST':
					if(get_input('action') == 'attachFile'){
						$session =  new Session(null, null, null);
						if(Project::saveAttachments($_FILES['files'], $_POST['projectId'], $_POST['accessId'])) {
							$session->setHeader(200);
							
							$status = 'success';
						}
						else{
							$session->setHeader(400);
							$status = 'error';
						}
					}
					else{
						$publicKey = get_input('public_key');
						$postdata = file_get_contents("php://input");
						$payload = json_decode(file_get_contents("php://input"), true);
						$payload['user_id'] = (int) $payload['user_id'];
						$session = new Session($publicKey, $signature, $payload);

						if($session->verifySignature()) {
							//check if edit or creation
							if($page[1]){
								$project = Project::withID($page[1], $session);
								
								if($project){
									if($project->can_edit) {
										if($project->edit($payload)) {
											$data = $project;
											$session->setHeader(200);
										}
										else{
											$session->setHeader(500);
											$status = 'error';
											$data = array('message' => 'There was an error saving the project resource');
										}
									}
									else{
										$session->setHeader(401);
										$status = 'fail';
										$data = array('message' => 'Insufficient access privledges');
									}
								}
								else {
									$session->setHeader(404);
									$status = 'error';
								}
							}
							else{
								$project = Project::withParams($payload);

								if($project->validate()) {
									if($project->create()) {
										$session->setHeader(201);
										$status = 'success';
										$data = array('id'=>$project->id, 'accessId'=>$project->access_id);
										$project->sendEmail('submit');
									}
									else{
										$session->setHeader(500);
									}
								}
								else{
									$session->setHeader(400);
								}
							}
						}
						else{
							$session->setHeader(401);
						}
					}
					header('Content-type: application/json');
					echo json_encode(array('status'=>$status, 'data'=>$data), 32);
					exit;
					break;
				case 'PUT':
					$publicKey = get_input('public_key');
					$payload = json_decode(file_get_contents("php://input"), true);
					
					$session = new Session($publicKey, $signature, $payload);
					
					if($session->verifySignature()) {
						$project = Project::withID($page[1],$session);
						if($project->update($payload)) {
							$session->setHeader(200);
							$status = 'success';
							$data = array('id'=>$project->id);
						}
						else{
							$session->setHeader(500);
						}
						
					}
					else{
						//return 401 - unauthorized
						$session->setheader(401);
					}
					
					header('Content-type: application/json');
					echo json_encode(array('status'=>$status, 'data'=>$data), 32);
					
					exit;
					break;
				case 'DELETE':
					$publicKey = get_input('public_key');
					
					if($page[1]) {
						$session = new Session($publicKey, $signature, $params);
						if($session->verifySignature()) {
							$project = Project::withID($page[1], $session);
							if($project) {
								$result = Project::delete($project);

								if ($result) {
									$session->setHeader(200);
									$status = 'success';
									$data = null;
								}
								else{
									$session->setHeader(500);
									$status = 'fail';
								}
							}
							else {
								$session->setHeader(404);
								$status = 'error';
							}
						}
						else {
							$session->setHeader(401);
							$status = 'error';
						}						
					}
					
					header('Content-type: application/json');
					echo json_encode(array('status'=>$status, 'data'=>$data), 32);
					
					exit;
					break;
			}
			exit;
			break;
		default:
			exit;
			break;
	}
	return true;
}