<?php
/**
 * Elgg Pages
 *
 * @package ElggPages
 */

elgg_register_event_handler('init', 'system', 'surveys_init');

/**
 * Initialize the projects plugin.
 *
 */
function surveys_init() {
	// register a library of helper functions
	elgg_register_library('surveys', elgg_get_plugins_path() . 'surveys/lib/surveys.php');
	elgg_load_library('surveys');

	//register css
	$css_url = 'mod/surveys/css/styles.css';
	elgg_register_css('surveysCss', $css_url);
	elgg_load_css('surveysCss');
	
	// register a project handler, so we can have nice URLs
	elgg_register_page_handler('surveys', 'surveys_page_handler');

	// register a url handler
	elgg_register_entity_url_handler('object', 'survey', 'surveys_url');
	
	// register entity type for search
	elgg_register_entity_type('object', 'survey');

	// register some actions
	$action_base = elgg_get_plugins_path() . 'surveys/actions';

	elgg_register_action("surveys/submit", "$action_base/submit.php");
	elgg_register_action("surveys/delete", "$action_base/delete.php");
	elgg_register_action("surveys/edit", "$action_base/edit.php");

	// Language short codes must be of the form "projects:key"
	// where key is the array key below
	elgg_set_config('surveys', array(
		'hear[]' => 'custom_checkbox',
		'reason[]' => 'custom_checkbox',
		'overall' =>'dropdown',
		'speakers' => 'dropdown',
		'facilitators' => 'dropdown',
		'topics' => 'dropdown',
		'structure' => 'dropdown',
		'relevance' => 'dropdown',
		'venue' => 'dropdown',
		'overall_length' => 'dropdown',
		'presentations' => 'dropdown',
		'breaks' => 'dropdown',
		'networking' => 'dropdown',
		'groups' => 'dropdown',
		'plenaries' => 'dropdown',
		'worked' => 'plaintext',
		'not_useful' => 'plaintext',
		'useful' => 'plaintext',
		'willAttend' => 'radio',
		'attendExplain' => 'plaintext',
		'help' => 'radio',
		'helpExplain' => 'plaintext',
		'recommend' => 'radio',
		'otherDeparts' => 'radio',
		'otherDepartsExplain' => 'plaintext',
		'usefulDev' => 'radio',
		'usefulDevExplain' => 'plaintext',
		'suggestion' => 'plaintext',
		'final1' => 'radio',
		'final2' => 'radio',
		'final3' => 'radio',
		'final4' => 'radio',
		'final5' => 'radio',
		'final6' => 'radio',
		'final7' => 'radio',
		'final8[]' => 'custom_checkbox',
		'final9' => 'plaintext',
		'final10' => 'text',
	));
	
	// register the hook handler
	//elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'projects_owner_block_menu');

	
	// Access permissions
	//elgg_register_plugin_hook_handler('access:collections:write', 'all', 'projects_write_acl_plugin_hook');
	//elgg_register_plugin_hook_handler('access:collections:read', 'all', 'projects_read_acl_plugin_hook');
}

/**
 * Dispatcher for surveys.
 *
 *
 * @param array $project
 * @return bool
 */
function surveys_page_handler($survey) {
	
	//register js
	//$js_url = 'mod/projects/js/script.js';
	//elgg_register_js('projects', $js_url);
	//elgg_load_js('projects');
	// add the jquery treeview files for navigation
	//elgg_load_js('jquery-treeview');
	//elgg_load_css('jquery-treeview');

	if (!isset($survey[0])) {
		$survey[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('Surveys'), 'surveys/all');

	$base_dir = elgg_get_plugins_path() . 'surveys/pages/surveys';

	$survey_type = $survey[0];
	switch ($survey_type) {
		case 'view':
			set_input('guid', $survey[1]);
			include "$base_dir/view.php";
			break;
		case 'submit':
			include "$base_dir/submit.php";
			break;
		case 'all':
			set_input('guid', $survey[1]);
			include "$base_dir/all.php";
			break;
		case 'edit':
			set_input('guid', $survey[1]);
			include "$base_dir/edit.php";
			break;
		case 'add':
			set_input('guid', $survey[1]);
			include "$base_dir/add.php";
			break;
		default:
			return false;
	}
	return true;
}


/**
 * Override the project url
 * 
 * @param ElggObject $entity Page object
 * @return string
 */
/*function survey_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return "projects/view/$entity->guid/$title";
}*/


