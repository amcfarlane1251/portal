<?php
$email = get_input('email');
$guid = get_input('guid');
error_log($email);
error_log($guid);
if(!$email){
	register_error('Please enter an email');
	forward(REFERER);
}

$userMgmt = new UserManagement();

if($userMgmt->sendEmail('activate',$email, $guid)){
	system_message(elgg_echo('email:activate:sent'));
	forward('/');
}
else{
	register_error(elgg_echo('email:activate:invalidEmail'));
	forward(REFERER);
}