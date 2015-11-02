<?php
/**
 * List all projects
 *
 * @package ElggPages
 */

$title = elgg_echo('projects:all');

elgg_pop_breadcrumb();

projects_register_title_buttons();

$content = elgg_list_entities(array(
	'types' => 'object',
	'subtypes' => 'project_top',
	'full_view' => false,
));
if (!$content) {
	$content = '<p>' . elgg_echo('projects:none') . '</p>';
}
$sidebar = elgg_view('projects/sidebar/search');
$sidebar .= elgg_view('projects/sidebar/searchByTag');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
