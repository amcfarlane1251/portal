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
			$signature = $headers['signature'];
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
			$signature = $headers['signature'];
			
			switch($method) {
				case 'GET':
					$publicKey = get_input('public_key');
					$params = array();
					
					if($page[1]) {
						$session = new Session($publicKey, $signature, $params);
						if($session->verifySignature()) {
							//load single resource
							$project = Project::withID($page[1]);
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
							$projects = Project::all($params);
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
					$publicKey = get_input('public_key');
					$payload = array();
					$payload['title'] = $_POST['title'];
					$payload['description'] = $_POST['description'];
					$payload['scope'] = $_POST['scope'];
					$payload['course'] = $_POST['course'];
					$payload['org'] = $_POST['org'];
					$payload['user_id'] = (int)$_POST['user_id'];
					$payload['project_type'] = $_POST['project_type'];
					$payload['is_priority'] = $_POST['is_priority'] == "true" ? true : false;
					$payload['priority'] = $_POST['priority'];
					$payload['is_sme_avail'] = $_POST['is_sme_avail'] == "true" ? true : false;
					$payload['is_limitation'] = $_POST['is_limitation'] == "true" ? true : false;
					$payload['update_existing_product'] = $_POST['update_existing_product'];
					$payload['life_expectancy'] = $_POST['life_expectancy'] == "true" ? true : false;
					
					$session = new Session($publicKey, $signature, $payload);
					
					if($session->verifySignature()) {
						$project = new Project($payload);
						
						if($project->validate()) {
							if($project->create()) {
								$session->setHeader(200);
							}
							else{
								$session->setHeader(500);
							}
						}
						else{
							$session->setHeader(400);
						}
					}
					else{
						$session->setHeader(401);
					}
					
					
					exit;
					break;
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
			exit;
			break;
		default:
			exit;
			break;
	}
	return true;
}