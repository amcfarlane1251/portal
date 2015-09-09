<?php
$title = elgg_echo('activate:changeEmail');
$content = elgg_view_form('changeEmail');

$body = elgg_view_layout('walled_garden', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page('', $body, 'walled_garden');