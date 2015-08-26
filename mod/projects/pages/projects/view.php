<?php
/**
 * View a single project
 *
 * @package ElggPages
 */

$project_guid = get_input('guid');
$project = get_entity($project_guid);
if (!$project) {
	forward();
}
elgg_pop_breadcrumb();
elgg_set_page_owner_guid($project->getContainerGUID());

group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
}

$title = $project->title;

elgg_push_breadcrumb(elgg_echo('projects'), elgg_get_site_url()."projects");
if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($container->name, "projects/group/$container->guid/all");
} else {
	//elgg_push_breadcrumb($container->name, "projects/owner/$container->username");
}

$content = elgg_view_entity($project, array('full_view' => true));
$content .= elgg_view('object/opis',array('projectId'=>$project_guid));
$content .= elgg_view('object/attachments',array('projectId'=>$project_guid));
$content .= elgg_view_comments($project);

if (elgg_get_logged_in_user_guid() == $project->getOwnerGuid()) {
	$url = "projects/add/$project->guid";
	elgg_register_menu_item('title', array(
			'name' => 'subproject',
			'href' => $url,
			'text' => elgg_echo('projects:newchild'),
			'link_class' => 'elgg-button elgg-button-action',
	));
}
$sidebar = elgg_view('projects/sidebar/navigation');
$sidebar .= elgg_view('projects/sidebar/search');
$sidebar .= elgg_view('projects/sidebar/searchByTag');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
