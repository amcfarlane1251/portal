<?php
function apiPageHandler($page){
	//common vars for all resources
	$method = $_SERVER['REQUEST_METHOD'];
	switch($page[0]) {
		case 'session':
			$session = new Session();
			//get request payload
			$username = get_input('username');
			$password = get_input('password');
			//check HTTP method
			switch($method) {
				case 'GET':
					exit;
					break;
				case 'POST':
					if($session->authenticate($username, $password)){
						$user = get_user_by_username($username);
						foreach($user as $index => $attribute) {
							$data[$index] = $attribute;
						}
					}
					echo json_encode(array('status'=>'success', 'data'=>$data));
					exit;
					break;
			}
			$result = array('status' => 'success', 'data' => array('message'=>'test', 'message2'=>'test2'));
			echo json_encode($result);
			exit;
			break;
		default:
			return false;
	}
	return true;
}