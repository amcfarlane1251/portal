<?php

elgg_register_event_handler('init', 'system', 'status_report_init');

function status_report_init() {

	elgg_register_library('elgg:report', elgg_get_plugins_path() . 'status_report/lib/status_report.php');

	elgg_register_menu_item('site', array(
		'name' => 'report',
		'text' => elgg_echo('report:title'),
		'href' => "report/main"
	));

	//page handlers
	elgg_register_page_handler('report', 'status_report_page_handler');

	//url handler
	elgg_register_entity_url_handler('object', 'status_report', 'status_report_url');

	//register actions
	$action_base = elgg_get_plugins_path() . 'status_report/actions/status_report';
	elgg_register_action("edit", "$action_base/add.php");

	elgg_set_config('report', array(
		'project_summary' => 'longtext',
		'project_team' => 'text',
		'date' => 'text',
		'project_title' => 'text',

		'schedule_comments' => 'text',
		'schedule_action_required' => 'text',
		'schedule_previous_grade' => 'dropdown',
		'schedule_grade' => 'dropdown',

		'scope_comments' => 'text',
		'scope_action_required' => 'text',
		'scope_previous_grade' => 'dropdown',
		'scope_grade' => 'dropdown',

		'resources_comments' => 'text',
		'resources_action_required' => 'text',
		'resources_grade' => 'dropdown',
		'resources_previous_grade' => 'dropdown',

		'budget_comments' => 'text',
		'budget_action_required' => 'text',
		'budget_previous_grade' => 'dropdown',
		'budget_grade' => 'dropdown',

		'change_comments' => 'text',
		'change_action_required' => 'text',
		'change_previous_grade' => 'dropdown',
		'change_grade' => 'dropdown',

		'riskissue' => 'text',
		'mitigation_strategy' => 'text',
		'responsible' => 'text',
		'due_date' => 'text',
		'accomplishments_this' => 'longtext',
		'accomplishments_next' => 'longtext',
		'percent_complete' => 'text',
		
		'milestone_title' => 'text',
		'milestone_title2' => 'text',
		'milestone_title3' => 'text',
		'milestone_title4' => 'text',
		'milestone_title5' => 'text',
		'milestone_title6' => 'text',
		'milestone_title7' => 'text',
		'milestone_title8' => 'text',
		'milestone_title9' => 'text',
		'milestone_title10' => 'text',

		'milestone_date' => 'text',
		'milestone_date2' => 'text',
		'milestone_date3' => 'text',
		'milestone_date4' => 'text',
		'milestone_date5' => 'text',
		'milestone_date6' => 'text',
		'milestone_date7' => 'text',
		'milestone_date8' => 'text',
		'milestone_date9' => 'text',
		'milestone_date10' => 'text',
	));
}

/**
*Dispatcher for the status reports pages
*	Main page 			report/main
*
*@param array $report
*@return bool
*/
function status_report_page_handler($report) {
	elgg_load_library('elgg:report');

	elgg_load_js('jquery-treeview');
	elgg_load_css('jquery-treeiew');

	elgg_register_js('add', 'mod/status_report/js/add.js');
	elgg_load_js('add');

	if(!isset($report[0])) {
		$report[0] = 'main';
	}

	elgg_push_breadcrumb(elgg_echo('report:title'), 'report/main');

	$base_dir = elgg_get_plugins_path() . 'status_report/pages/status_report';

	$report_page = $report[0];
	switch($report_page) {
		case 'main':
			include "$base_dir/main.php";
			break;
		case 'add':
			set_input('guid', $report[1]);
			include "$base_dir/new.php";
			break;
		case 'view':
			set_input('guid', $report[1]);
			include "$base_dir/view.php";
			break;
		default:
			return false;
	}
	return true;
}

function status_report_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return "report/view/$entity->guid/$title";
}