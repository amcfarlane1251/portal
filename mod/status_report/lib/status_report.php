<?php

function report_prepare_form_vars($report = null, $parent_guid = 0) {

	// input names => defaults
	$values = array(
		'project_summary' => '',
		'project_team' => '',
		'date' => '',

		'schedule_comments' => '',
		'schedule_action_required' => '',
		'schedule_previous_grade' => '',
		'schedule_grade' => '',

		'scope_comments' => '',
		'scope_action_required' => '',
		'scope_previous_grade' => '',
		'scope_grade' => '',

		'resources_comments' => '',
		'resources_action_required' => '',
		'resources_grade' => '',
		'resources_previous_grade' => '',

		'budget_comments' => '',
		'budget_action_required' => '',
		'budget_previous_grade' => '',
		'budget_grade' => '',

		'change_comments' => '',
		'change_action_required' => '',
		'change_previous_grade' => '',
		'change_grade' => '',

		'riskissue' => '',
		'mitigation_startegy' => '',
		'responsible' => '',
		'due_date' => '',
		'accomplishments_this' => '',
		'accomplishments_next' => '',

		'access_id' => ACCESS_DEFAULT,
		'write_access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $report,
		'parent_guid' => $parent_guid,
	);

	if ($report) {
		foreach (array_keys($values) as $field) {
			if (isset($report->$field)) {
				$values[$field] = $report->$field;
			}
		}
	}

	if (elgg_is_sticky_form('report')) {
		$sticky_values = elgg_get_sticky_values('report');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('report');

	return $values;
}