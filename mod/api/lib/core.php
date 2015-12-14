<?php
function apiPageHandler($page){
	switch($page[0]) {
		case 'session':
			$result = array('status' => 'success', 'data' => array('message'=>'test', 'message2'=>'test2'));
			echo json_encode($result);
			exit;
			break;
		default:
			return false;
	}
	return true;
}