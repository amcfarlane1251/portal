<?php

gatekeeper();

$title = elgg_echo('report:add');
 
$content = elgg_view_form('edit');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);