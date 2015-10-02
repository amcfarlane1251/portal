<?php
$guids = get_input('user-guids');
$userMgmt = new UserManagement();

if(is_array($guids)) {
	foreach($guids as $guid) {
		$user = get_entity($guid);
		$userMgmt->setUser($user);
		if(!$userMgmt->activateUser()) {
			$error = 'Unable to activate '.$user->username;
		}
	}
}
elseif($guids) {
	$user = get_entity($guids);
	$userMgmt->setUser($user);
	if(!$userMgmt->activateUser()) {
		$error = 'Unable to activate '.$user->username;
	}
}

if($error) {
	register_error($error);
}
else{
	system_message('Users activated');
}

forward(REFERER);