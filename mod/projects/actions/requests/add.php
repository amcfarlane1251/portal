<?php
/**
 * Create a project
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

// always set write access to private for a request so only the admin can edit
$project->write_access_id = 0;

if ($parent_guid) {
	$project->parent_guid = $parent_guid;
}

//make the project a request
$project->request = 'Requested';

if ($project->save()) {
	//create opi relationships
	if($opis){
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
	$project->annotate('project', $project->description, 2);

	system_message(elgg_echo('projects:saved'));

	if ($new_project) {
		add_to_river('river/object/project/create', 'create', elgg_get_logged_in_user_guid(), $project->guid);
	}

	$requestor = get_entity($container_guid);

	$message = "ADL,";
	$message .= "\n\n A project has been requested by $requestor->name.";
	$message .= "\n\n Title: $project->title";
	$message .= "\n Description: $project->description";
	$message .= "\n Type: $project->project_type";
	$message .= "\n Cost: $project->cost";
	$message .= "\n Organization: $project->organization";
	$message .= "\n Funding: $project->funding";
	$message .= "\n Status: $project->status";
	$message .= "\n Start Date: $project->start_date";
	$message .= "\n End Date: $project->end_date";
	$message .= "\n Tags: ";
	if($project->tags){
		$lastElem = end($project->tags); 
		foreach($project->tags as $tag){
			if($tag == $lastElem){
				$message .= $tag;
			}
			else{
				$message .= $tag.", ";
			}
		}
	}
	$message .= "\n OPIs: ";
	foreach($opis as $opi){
		$opi_object = get_entity($opi);
		$name = $opi_object->name;
		$contact = $opi_object->email;
		$message .= "\n Name: $name, Contact: $contact";
	}
	$message .= "\n\nLogin as an administrator to view this request at ".$project->getURL();

	//send email to ADL lab
	notify_user(130228, $container_guid, "Project Requested", $message, NULL, 'email');


	//check if project is not a group project
	if(!elgg_instanceof($requestor,'group')){
		$project->container_guid = (int)$opis[0];
	}
	
	//first opi is the project owner
	$project->container_guid = (int)$opis[0];
	$project->access_id = (int)1;

	// Now save description as an annotation
	$project->annotate('project', $project->description, 2);
	
	$project->save();
	forward($project->getURL());
} else {
	register_error(elgg_echo('projects:error:no_save'));
	forward(REFERER);
}