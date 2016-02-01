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
		case 'project':
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
			exit;
			break;
		default:
			exit;
			break;
	}
	return true;
}