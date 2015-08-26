<?php
/**
 * Pages function library
 */

if(isset($_POST['action'])){
	if($_POST['action'] == 'getOpis'){
		get_opis($_POST['projectId'], true);
	}
}

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $project
 * @return array
 */
function projects_prepare_form_vars($project = null, $parent_guid = 0) {

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
 * Recurses the project tree and adds the breadcrumbs for all ancestors
 *
 * @param ElggObject $project Page entity
 */
function projects_prepare_parent_breadcrumbs($project) {
	if ($project && $project->parent_guid) {
		$parents = array();
		$parent = get_entity($project->parent_guid);
		while ($parent) {
			array_push($parents, $parent);
			$parent = get_entity($parent->parent_guid);
		}
		while ($parents) {
			$parent = array_pop($parents);
			elgg_push_breadcrumb($parent->title, $parent->getURL());
		}
	}
}

/**
 * Register the navigation menu
 * 
 * @param ElggEntity $container Container entity for the projects
 */
function projects_register_navigation_tree($container) {
	if (!$container) {
		return;
	}

	$top_projects = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'project_top',
		'container_guid' => $container->getGUID(),
	));

	foreach ($top_projects as $project) {
		elgg_register_menu_item('projects_nav', array(
			'name' => $project->getGUID(),
			'text' => $project->title,
			'href' => $project->getURL(),
		));

		$stack = array();
		array_push($stack, $project);
		while (count($stack) > 0) {
			$parent = array_pop($stack);
			$children = elgg_get_entities_from_metadata(array(
				'type' => 'object',
				'subtype' => 'project',
				'metadata_name' => 'parent_guid',
				'metadata_value' => $parent->getGUID(),
			));
			
			foreach ($children as $child) {
				elgg_register_menu_item('projects_nav', array(
					'name' => $child->getGUID(),
					'text' => $child->title,
					'href' => $child->getURL(),
					'parent_name' => $parent->getGUID(),
				));
				array_push($stack, $child);
			}
		}
	}
}

/**
 *
 * upload attachments for a project
 * @param ElggEntity 
 *
*/
function projects_upload_attachments($attachments, $project){
	$count = count($attachments['name']);
	for ($i = 0; $i < $count; $i++) {
		if ($attachments['error'][$i] || !$attachments['name'][$i]) {
			continue;
		}

		$name = $attachments['name'][$i];

		$file = new ElggFile();
		$file->container_guid = $project->guid;
		$file->title = $name;
		$file->access_id = (int) $project->access_id;

		$prefix = "file/";
		$filestorename = elgg_strtolower(time() . $name);
		$file->setFilename($prefix . $filestorename);


		$file->open("write");
		$file->close();
		move_uploaded_file($attachments['tmp_name'][$i], $file->getFilenameOnFilestore());

		$saved = $file->save();

		if ($saved) {
			$mime_type = ElggFile::detectMimeType($attachments['tmp_name'][$i], $attachments['type'][$i]);
			$info = pathinfo($name);
			$office_formats = array('docx', 'xlsx', 'pptx');
			if ($mime_type == "application/zip" && in_array($info['extension'], $office_formats)) {
				switch ($info['extension']) {
					case 'docx':
						$mime_type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
						break;
					case 'xlsx':
						$mime_type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
						break;
					case 'pptx':
						$mime_type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
						break;
				}
			}

			// check for bad ppt detection
			if ($mime_type == "application/vnd.ms-office" && $info['extension'] == "ppt") {
				$mime_type = "application/vnd.ms-powerpoint";
			}

			//add_metastring("projectId");

			//$file->projectId = $project_guid;
			$file->setMimeType($mime_type);
			$file->originalfilename = $name;
			if (elgg_is_active_plugin('file')) {
				$file->simpletype = file_get_simple_type($mime_type);
			}
			$saved = $file->save();
			if($saved){
				$file->addRelationship($project->guid, 'attachment');
			}
		}
	}
}

function projects_check_opis($opis){
	if(!$opis){
		return false;
	}
	
	foreach($opis as $name => $value){
		$tempArray = array();
		foreach($opis as $opi){
			$tempArray[] = $opi;
		}
		unset($tempArray[$name]);

		if(in_array($value, $tempArray)){
			return false;
		}
	}
	
	return true;
}

/** 
 * get OPIs
 *
*/
function get_opis($projectId, $json = null){
	if(!$projectId){
		return null;
	}
	$opis = elgg_get_entities_from_relationship(array(
		"relationship" => "opi",
		"relationship_guid" => $projectId,
		"inverse_relationship" => true
	));
	if($json){
		$numItems = count($opis);
		$i = 0;
		foreach($opis as $key=>$opi){
			if(++$i === $numItems){
				echo ($opi->guid);
			}
			else{
				echo ($opi->guid. ',');
			}
		}
		exit();
	}
	return $opis;
}

/**
 * register title buttons
 *
*/
function projects_register_title_buttons(){
	elgg_register_title_button();
	elgg_register_title_button('','request');
}
