<?php

admin_gatekeeper();

$users = elgg_get_entities(array(
	'type' => 'user',
	'limit' => 0
));

foreach($users as $user)
{
	$user->registeredEmail = $user->email;
	$user->save();
}

forward(REFERER);