<?php
/**
 * View a revision of project
 *
 * @package ElggPages
 */

$id = get_input('id');
$annotation = elgg_get_annotation_from_id($id);
if (!$annotation) {
	forward();
}

$project = get_entity($annotation->entity_guid);
if (!$project) {
	
}

elgg_set_page_owner_guid($project->getContainerGUID());

group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
}

$title = $project->title . ": " . elgg_echo('projects:revision');

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($container->name, "projects/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($container->name, "projects/owner/$container->username");
}
projects_prepare_parent_breadcrumbs($project);
elgg_push_breadcrumb($project->title, $project->getURL());
elgg_push_breadcrumb(elgg_echo('projects:revision'));

$content = elgg_view('object/project_top', array(
	'entity' => $project,
	'revision' => $annotation,
	'full_view' => true,
));

$sidebar = elgg_view('projects/sidebar/history', array('project' => $project));

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
