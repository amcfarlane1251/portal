<?php
/**
 * Create a new project
 *
 * @package ElggPages
 */

gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);
if (!$container) {

}

$parent_guid = 0;
$project_owner = $container;
if (elgg_instanceof($container, 'object')) {
	$parent_guid = $container->getGUID();
	$project_owner = $container->getContainerEntity();
}

elgg_set_page_owner_guid($project_owner->getGUID());
elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('projects'), elgg_get_site_url()."projects");
$title = elgg_echo('projects:add');
elgg_push_breadcrumb($title);

$vars = projects_prepare_form_vars(null, $parent_guid); 
$content = elgg_view_form('projects/edit', array('enctype' => 'multipart/form-data'), $vars);
$sidebar .= elgg_view('projects/sidebar/search');
$sidebar .= elgg_view('projects/sidebar/searchByTag');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar
));

echo elgg_view_page($title, $body);
