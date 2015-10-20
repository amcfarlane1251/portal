<?php

$report = elgg_extract('entity', $vars, FALSE);
$full = elgg_extract('full_view', $vars, FALSE);

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'status_report',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$params = array(
	'entity' => $report,
	'metadata' => $metadata,
);

$params = $params + $vars;

if($full) {
	$body = elgg_view('object/report/summary', $params);
	echo elgg_view('object/elements/full', array(
		'entity' => $report,
		'title' => false,
		'body' => $body,
	));
}
else {
	$body = elgg_view('object/report/condensed', $params);
	echo elgg_view('object/elements/full', array(
		'entity' => $report,
		'title' => false,
		'body' => $body,
	));
}