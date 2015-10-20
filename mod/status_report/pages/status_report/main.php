<?php

$title = elgg_echo('report:title');

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('report:title'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'status_report',
	'full_view' => false,
	'no_results' => elgg_echo('report:none'),
));

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'filter_override' => elgg_view('filter_override/reportpageoverride',array("filter_context"=>'all')),
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);