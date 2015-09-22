<?php
$email = get_input('email');
$guid = get_input('guid');
if(!$email){
	register_error('Please enter an email');
	forward(REFERER);
}

$userMgmt = UserManagement::withID($guid);

if($userMgmt->sendEmail('activate',$email, $guid)){
	system_message(elgg_echo('email:activate:sent'));
	unset($_SESSION['guid']);
	forward('/');
}
else{
	unset($_SESSION['guid']);
	forward(REFERER);
}