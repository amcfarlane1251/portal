<?php
/**
 * All files
 *
 */

elgg_push_breadcrumb(elgg_echo('projects'));

elgg_register_title_button();

$limit = get_input("limit", 15);

$title = elgg_echo('projects');

$content = 
	"<section ng-app='portalApp' ng-controller='ProjectController'>
		<div ng-repeat='project in projects' class='project col-md-6'>
			<div class='project-header'>
				<h3>{{project.title}}</h3>
				<h5>Submitted by {{project.owner}} on {{project.time_created}}</h5>
			</div>
		</div>
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

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
	'filter_override' => elgg_view('project_registry/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);