<?php
/**
 * All files
 *
 */

elgg_push_breadcrumb(elgg_echo('projects'));

elgg_register_title_button();

$limit = get_input("limit", 15);

$title = elgg_echo('projects:all');

$content = elgg_list_entities(array(
	'types' => 'object',
	'subtypes' => 'project_registry',
	'limit' => $limit,
	'full_view' => FALSE
));
if (!$content) {
	$content = elgg_echo('projects:none');
}

$sidebar = elgg_view('project_registry/sidebar/filter');
$sidebar .= elgg_view('project_registry/sidebar/find');

switch ($vars['page']) {
	case 'submitted':

		break;
	case 'underreview':

		break;
	case 'inprogress':

		break;
	case 'completed':

		break;
	case 'onhold':
	
		break;
	default:
		break;
}

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
	'filter_override' => elgg_view('project_registry/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);