<?php
$email = get_input('email');
$guid = get_input('guid');

if(!$email){
	register_error('Please enter an email');
	forward(REFERER);
}

$userMgmt = UserManagement::withID($guid);

if($userMgmt->changeEmail($email))
{
	if($userMgmt->user->deactivated)
	{
		system_message(elgg_echo('changeEmail:success'));
		forward("usermgmt/activate?email={$email}&guid={$guid}");
	}
	else{
		system_message(elgg_echo('changeEmail:success'));
		forward('');
	}
}
else{
	forward(REFERER);
}