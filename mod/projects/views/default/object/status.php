<?php
/**
 *	View the status of a request 
 *	@uses $vars['projectId']
*/

$project = get_entity($vars['projectId']);
$vars['project'] = $project;
group_gatekeeper();

$title = $project->title;

$content = '<h3>Description: </h3>' .$project->description;
$content .= '<h3>Status: </h3> '.$project->status;

echo $content;
