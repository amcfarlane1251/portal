<?php

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $project
 * @return array
 */
function change_reqs_prepare_form_vars($project = null, $parent_guid = 0) {

	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'project_type' => '',
		'cost' => '',
		'organization' => '',
		'funding' => '',
		'status' => '',
		'start_date' => '',
		'end_date' => '',
		'assigned_to[]' => '',		
		'access_id' => ACCESS_DEFAULT,
		'write_access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'upload' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $project,
		'parent_guid' => $parent_guid,
	);

	if ($project) {
		foreach (array_keys($values) as $field) {
			if (isset($project->$field)) {
				$values[$field] = $project->$field;
			}
		}

		$opis = elgg_get_entities_from_relationship(array(
			"relationship" => "opi",
			"relationship_guid" => $project->guid,
			"inverse_relationship" => true
		));
		$values['opis'] = $opis;
	}

	if (elgg_is_sticky_form('project')) {
		$sticky_values = elgg_get_sticky_values('project');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('project');

	return $values;
}

/**
 * register title buttons
 *
*/
function projects_register_title_buttons(){
	elgg_register_title_button();
}
