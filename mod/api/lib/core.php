<?php
function apiPageHandler($page){
	//common vars for all resources
	$method = $_SERVER['REQUEST_METHOD'];
	switch($page[0]) {
		case 'session':
			$session = new Session($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
			
			//check HTTP method
			switch($method) {
				case 'GET':
					exit;
					break;
				case 'POST':
					if( $session->validate() ) {
						//passed model validation
						if( $session->authenticate() ) {
							$user = get_user_by_username($session->getUsername());
							
							//passed authentication, return 200
							header("HTTP/1.1 200 OK");
							$status = 'success';
							$data['id'] = $user->guid;
							$data['key'] = $user->guid.$user->salt;
							
						}
						else{
							//did not pass authentication, return 401 - unauthorized
							header('X-PHP-Response-Code: 401', true, 401);
							$status = 'fail';
							$data = $session->errors;
						}
					}
					else{
						//validation has failed - client error
						header('X-PHP-Response-Code: 400', true, 400);
						$status = 'fail';
						$data = $session->errors;
					}
					
					//set the content type
					header('Content-type: application/json');
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