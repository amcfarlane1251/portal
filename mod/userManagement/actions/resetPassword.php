<?php
$guid = get_input('guid');
$password = get_input('password');
$passwordAgain = get_input('password-again');

if($guid != $_SESSION['userId']) {
	forward('');
}

$userMgmt = UserManagement::withID($guid);

if($userMgmt->changePswd($password, $passwordAgain)) {
	system_message(elgg_echo('resetPassword:success'));
	forward('');
}
else{
	forward(REFERER);
}