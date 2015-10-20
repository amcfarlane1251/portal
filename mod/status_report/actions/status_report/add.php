<?php

$variables = elgg_get_config('report');
$input = array();
foreach ($variables as $name => $type) {
	$input[$name] = get_input($name);
	if ($name == 'title') {
		$input[$name] = strip_tags($input[$name]);
	}
}

$title = "MPG Learning Technologies - Weekly - Status Report | " . $input['date'] . " | " . $input['project_title'];
$access_id = (int) get_input("access_id");
$container_guid = (int) get_input('container_guid', 0);
$guid = (int) get_input('guid');

elgg_make_sticky_form('status_report');

$report = new ElggObject();

$report->subtype = "status_report";
$report->title = $title;
$report->access_id = $access_id;
$report->container_guid = $container_guid;
$report->guid = $guid;
$report->summary = $project_summary;
$guid = $report->save();

if (sizeof($input) > 0) {
	foreach ($input as $name => $value) {
		$report->$name = $value; echo $name.',';
	}
}

elgg_clear_sticky_form('status_report');

if($guid) {
	system_message(elgg_echo('report:saved'));
	add_to_river('river/object/create', 'create', elgg_get_logged_in_user_guid(), $report->guid);
	forward($report->getURL());
} else {
	register_error("Status Report could not be saved");
    forward(REFERER);
}
