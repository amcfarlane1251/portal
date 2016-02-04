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
	"<section ng-app='portal' ng-controller='Projects as vm'>
		<div class='row'>
			<div ng-repeat='project in vm.projects' class='project col-sm-6'>
				<div class='project-header'>
					<h3><a href='projects/{{project.id}}'>{{project.title}}</a></h3>
					<h5>".elgg_echo('projects:status')." - <span>{{project.status}}</span></h5>
					<p>".elgg_echo('projects:reqNum')." {{project.req_num}}</p>
					<p>". elgg_echo('projects:submittedBy') ."{{project.owner}} ". elgg_echo('projects:on') ." {{project.time_created}}</p>
				</div>
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