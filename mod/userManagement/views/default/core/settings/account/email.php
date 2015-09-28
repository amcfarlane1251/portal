<?php
/**
 * Provide a way of setting your email
 *
 * @package Elgg
 * @subpackage Core
 */

$user = elgg_get_page_owner_entity();
if ($user) {
	$title = elgg_echo('email:settings');
	$content = elgg_echo('email:address:label') . ': ';
	$content .= elgg_view('input/email', array(
		'name' => 'email',
		'value' => $user->email,
	));

	if(elgg_is_admin_logged_in()) {
		echo elgg_view_module('info', $title, $content);
	}
	else{
		echo elgg_view_module('info', $title, $content, array('class'=>'hidden'));
	}
}