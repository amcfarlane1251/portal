<?php
/**
 * Add a survey
 * @package ElggPages
*/

$container_guid = get_input('guid');
$title = 

$content = elgg_view_form('surveys/add', array('enctype' => 'multipart/form-data'), $container_guid);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));