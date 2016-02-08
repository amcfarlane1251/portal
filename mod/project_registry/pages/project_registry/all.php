<?php
/**
 * All files
 *
 */

$title = elgg_echo('projects');

$content = 
	"<section ng-app='portal' ng-controller='Projects as vm'>
		<div ng-view></div>
	</section>";
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

$body = elgg_view_layout('one_sidebar', array(
	'content' => $content,
	'title' => null,
	'sidebar' => $sidebar,
	'filter_override' => elgg_view('project_registry/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);