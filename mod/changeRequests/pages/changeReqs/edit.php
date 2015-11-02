<?php
/**
 * Edit a project
 *
 * @package ElggPages
 */

gatekeeper();


$project_guid = (int)get_input('guid');
$project = get_entity($project_guid);
if (!$project) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

$container = $project->getContainerEntity();
if (!$container) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

elgg_set_page_owner_guid($container->getGUID());

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('projects'), elgg_get_site_url()."projects");
elgg_push_breadcrumb($project->title, $project->getURL());




if ($project->canEdit()) {
	$title = elgg_echo("projects:edit");
	$vars = projects_prepare_form_vars($project);
	$content = elgg_view_form('projects/edit', array('enctype' => 'multipart/form-data'), $vars);
}

else{
	$content = elgg_echo("projects:noaccess");
}

$sidebar = elgg_view('projects/sidebar/search');
$sidebar .= elgg_view('projects/sidebar/searchByTag');
$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar
));

echo elgg_view_page($title, $body);
