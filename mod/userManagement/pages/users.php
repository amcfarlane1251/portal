<?php
/* TODO: User query string
 * $_SERVER['QUERY_STRING'];
 */
$deactivated = $_GET['deactivated'];

$userMgmt = new UserManagement();
$users = $userMgmt->getUsers($deactivated);
$obj = array();
foreach($users as $user) {
	$userArr = array(
		'guid' => $user->guid,
		'name' => $user->name,
	);
	array_push($obj, $userArr);
}

echo json_encode($obj);