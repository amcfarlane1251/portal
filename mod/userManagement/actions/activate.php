<?php
$email = get_input('email');

if(!$email){
	register_error('Please enter an email');
	forward(REFERER);
}

$userMgmt = new UserManagement();

if($userMgmt->sendEmail('activate',$email)){
	system_message(elgg_echo('email:activate:sent'));
	forward('/');
}
else{
	register_error(elgg_echo('email:activate:invalidEmail'));
	forward(REFERER);
}