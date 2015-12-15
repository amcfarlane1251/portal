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
							
							//did not pass authentication, return 200
							header("HTTP/1.1 200 OK");
							$status = 'success';
							$data['id'] = $user->guid;
							$data['name'] = $user->name;
							$data['username'] = $user->username;
							$data['email'] = $user->email;
						}
						else{
							//did not pass authentication, return 401
							header('X-PHP-Response-Code: 401', true, 401);
							$status = 'fail';
							$data = $session->errors;
						}
					}
					else{
						//validation has failed
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