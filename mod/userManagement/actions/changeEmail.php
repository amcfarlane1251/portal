<?php
$email = get_input('email');
$guid = get_input('guid');

if(!$email){
	register_error('Please enter an email');
	forward(REFERER);
}

$userMgmt = UserManagement::withID($guid);

if($userMgmt->changeEmail($email)) {
	if($userMgmt->user->deactivated)
	{
		system_message(elgg_echo('changeEmail:success'));
		forward("usermgmt/activate?email={$email}&guid={$guid}");
	}

	system_message(elgg_echo('changeEmail:success'));
	unset($_SESSION['guid']);
	login(get_entity($guid));
	forward();
}
else {
	forward(REFERER);
}