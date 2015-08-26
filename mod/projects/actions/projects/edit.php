<?php
/**
 * Create or edit a project
 *
 * @package ElggPages
 */

$variables = elgg_get_config('projects');
$attachments = $_FILES['upload'];

$input = array();
$opis = array();
foreach ($variables as $name => $type) {
	if($name == 'assigned_to[]'){
		foreach($_POST['assigned_to'] as $assignee){
			$opis[] = $assignee;
		}
	}
	else{
		$input[$name] = get_input($name);
		if ($name == 'title') {
			$input[$name] = strip_tags($input[$name]);
		}
		if ($type == 'tags') {
			$input[$name] = string_to_tag_array($input[$name]);
		}
	}
}

// Get guids
$project_guid = (int)get_input('project_guid');
$container_guid = (int)get_input('container_guid');
$parent_guid = (int)get_input('parent_guid');

elgg_make_sticky_form('project');

if (!$input['title']) {
	register_error(elgg_echo('projects:error:no_title'));
	forward(REFERER);
}

if(!projects_check_opis($opis)){
	register_error(elgg_echo('projects:error:invalid_opis'));
	forward(REFERER);
}

if ($project_guid) {
	$project = get_entity($project_guid);
	if (!$project || !$project->canEdit()) {
		register_error(elgg_echo('projects:error:no_save'));
		forward(REFERER);
	}
	$new_project = false;
} else {
	$project = new ElggObject();
	if ($parent_guid) {
		$project->subtype = 'project';
	} else {
		$project->subtype = 'project_top';
	}
	$new_project = true;
}

if (sizeof($input) > 0) {
	foreach ($input as $name => $value) {
		$project->$name = $value;
		//echo "$project->$name = $value";
	}
}

// need to add check to make sure user can write to container
$project->container_guid = $container_guid;

if ($parent_guid) {
	$project->parent_guid = $parent_guid;
}

//first opi is the project owner
error_log((int)$opis[0]);
$project->container_guid = (int)$opis[0];
$project->access_id = (int)1;

if ($project->save()) {
	//create opi relationships
	if($opis){
		//remove old opis first
		if($oldOpis = get_opis($project->guid)){
			foreach($oldOpis as $oldOpi){
				if(!in_array($oldOpi, $opis)){
					remove_entity_relationship($oldOpi->guid, "opi", $project->guid);
				}
			}
		}
		foreach($opis as $opi){
			$user = get_entity($opi);
			if($user){
				$user->addRelationship($project->guid, 'opi');
			}
			else{
				register_error("Problem registering OPI's with project.");
				forward(REFERER);
			}
		}
	}
	
	//upload attachments
	if ($attachments) {
		projects_upload_attachments($attachments, $project);
	}

	elgg_clear_sticky_form('project');


	// Now save description as an annotation
	$project->annotate('project', $project->description, $project->access_id);

	system_message(elgg_echo('projects:saved'));

	if ($new_project) {
		add_to_river('river/object/project/create', 'create', elgg_get_logged_in_user_guid(), $project->guid);
	}

	forward($project->getURL());
} else {
	register_error(elgg_echo('projects:error:no_save'));
	forward(REFERER);
}
