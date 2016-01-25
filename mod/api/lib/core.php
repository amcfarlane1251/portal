<?php
function apiPageHandler($page){
	//common vars for all resources
	$method = $_SERVER['REQUEST_METHOD'];
	$apiKey = get_input('api_key');
	
	switch($page[0]) {
		case 'user':
			$userId = get_input('userId');
			$signature = get_input('signature');
			$session = Session::retrieve($userId, $signature);
			//$session->
		case 'session':
			$session = new Session($_POST['username'], $_POST['password'], $apiKey);
			//check HTTP method
			switch($method) {
				case 'GET':
					exit;
					break;
				case 'POST':
					//create a session
					if( $session->validate() ) {
						//passed model validation
						if( $session->authenticate() ) {
							//passed authentication, get auth token return 200 response code
							$session->getAuthToken();
							
							$session->setHeader(200);
							$status = 'success';
							$data['authToken'] = $session->getAuthToken();
						}
						else{
							//did not pass authentication, return 401 - unauthorized
							header('X-PHP-Response-Code: 401', true, 401);
							$status = 'fail';
							$data = $session->errors;
						}
					}
					else{
						//model validation has failed - client error
						header('X-PHP-Response-Code: 400', true, 400);
						$status = 'fail';
						$data = $session->errors;
					}
					//set the content type
					echo json_encode(array('status'=>$status, 'data'=>$data));
					exit;
					break;
			}
			exit;
			break;
		default:
			return false;
	}
	return true;
}