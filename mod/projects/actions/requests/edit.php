<?php
/**
 * Edit a project request
 * @package ElggPage
*/

$input = array();
$input['status'] = get_input('status');
$input['guid'] = get_input('guid');

$request = get_entity($input['guid']);
$request->status = $input['status'];

if($request->save()){
	system_message(elgg_echo('projects:saved'));
	forward(REFERER);
}
else{
	register_error(elgg_echo('projects:error:no_save'));
	forward(REFERER);
}
