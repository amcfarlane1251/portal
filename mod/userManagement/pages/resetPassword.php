<?php
$title = elgg_echo('resetPassword');
$content = elgg_view_form('resetPassword', array('class' => 'responsive-form'));

$body = elgg_view_layout('walled_garden', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page('', $body, 'walled_garden');