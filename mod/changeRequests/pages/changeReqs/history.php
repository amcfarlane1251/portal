<?php
/**
 * History of revisions of a project
 *
 * @package ElggPages
 */

$project_guid = get_input('guid');

$project = get_entity($project_guid);
if (!$project) {

}

$container = $project->getContainerEntity();
if (!$container) {

}

elgg_set_page_owner_guid($container->getGUID());

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($container->name, "projects/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($container->name, "projects/owner/$container->username");
}
projects_prepare_parent_breadcrumbs($project);
elgg_push_breadcrumb($project->title, $project->getURL());
elgg_push_breadcrumb(elgg_echo('projects:history'));

$title = $project->title . ": " . elgg_echo('projects:history');

$content = list_annotations($project_guid, 'project', 20, false);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('projects/sidebar/navigation', array('project' => $project)),
));

echo elgg_view_page($title, $body);
