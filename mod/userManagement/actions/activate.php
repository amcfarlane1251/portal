<?php
$email = get_input('email');
$guid = get_input('guid');
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
	forward(REFERER);
}