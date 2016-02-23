<?php
/**
 * All files
 *
 */

$title = elgg_echo('projects');

$content = 
"<script src='/portal/node_modules/angular/angular.min.js'></script>
<script src='/portal/node_modules/angular-resource/angular-resource.min.js'></script>
<script src='/portal/node_modules/angular-route/angular-route.min.js'></script>
<script src='/portal/node_modules/angular-messages/angular-messages.min.js'></script>
<script src='/portal/node_modules/ng-file-upload/dist/ng-file-upload-shim.min.js'></script>
<script src='/portal/node_modules/ng-file-upload/dist/ng-file-upload.min.js'></script>
<script src='/portal/node_modules/angular-animate/angular-animate.min.js'></script>
	<section ng-app='portal' style='position:relative;'>
		<link rel='stylesheet' href='mod/project_registry/css/styles.css'/>
		<div ng-view class='fade'>
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

$body = elgg_view_layout('one_column', array(
	'content' => $content,
	'title' => null,
	'sidebar' => null,
	'filter_override' => elgg_view('project_registry/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);