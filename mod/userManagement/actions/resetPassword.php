<?php
$guid = get_input('guid');
$password = get_input('password');
$passwordAgain = get_input('passwordAgain');

if($guid != $_SESSION['guid']) {
	forward('');
}

$userMgmt = new UserManagement($guid);

if($password != $passwordAgain) {
	register_error(elgg_echo('resetPassword:error:passwordMismatch'));
	forward(REFERER);
}