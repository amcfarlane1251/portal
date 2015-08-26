<?php
/**
 * List a user's or group's projects
 *
 * @package ElggPages
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	forward('projects/all');
}

// access check for closed groups
group_gatekeeper();

$title = elgg_echo('projects:owner', array($owner->name));

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('projects'), elgg_get_site_url()."projects");

projects_register_title_buttons();

$content = elgg_list_entities(array(
	'types' => 'object',
	'subtypes' => 'project_top',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => $limit,
	'full_view' => false,
));
if (!$content) {
	$content = '<p>' . elgg_echo('projects:none') . '</p>';
}

$filter_context = '';
if (elgg_get_page_owner_guid() == elgg_get_logged_in_user_guid()) {
	$filter_context = 'mine';
}

$sidebar = elgg_view('projects/sidebar/navigation');
$sidebar .= elgg_view('projects/sidebar/search');
$sidebar .= elgg_view('projects/sidebar/searchByTag');

$params = array(
	'filter_context' => $filter_context,
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
);

if (elgg_instanceof($owner, 'group')) {
	$params['filter'] = '';
}

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
