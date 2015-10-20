<?php

$report_guid = get_input('guid');
$report = get_entity($report_guid);

$owner = elgg_get_page_owner_entity();


$title = $report->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($report, array('full_view' => true));

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);

?>