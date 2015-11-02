<?php

elgg_register_event_handler('init', 'system', 'changeReqsInit');

/**
 * Initialize the plugin.
 *
 */
function changeRequestsInit() {
	// register a library of helper functions
	elgg_register_library('elgg:changeReqs', elgg_get_plugins_path() . 'projects/lib/changeReqs.php');
	elgg_load_library('elgg:changeReqs');
	
	// register a project handler, so we can have nice URLs
	elgg_register_page_handler('changeReqs', 'changeReqs_page_handler');


	// register some actions
	$requests_action_base = elgg_get_plugins_path() . 'projects/actions/requests';
	elgg_register_action("requests/add", "$requests_action_base/add.php");
	elgg_register_action("requests/edit", "$requests_action_base/edit.php");

	// add to groups
	add_group_tool_option('projects', elgg_echo('changeReqs:enableGroupTool'), true);
	//elgg_extend_view('groups/tool_latest', 'projects/group_module');

	// Language short codes must be of the form "projects:key"
	// where key is the array key below
	elgg_set_config('changeReqs', array(
		'title' => 'text',
		'description' => 'longtext',
		'project_type' => 'dr_down',
		'cost' => 'text',
		'organization' => 'text',
		'funding' => 'text',
		'status' => 'dr_down',
		'start_date' => 'date',
		'end_date' => 'date',
		'assigned_to[]' => 'assign_to',		
		'tags' => 'tags',
		'access_id' => 'access',
		'write_access_id' => 'write_access',
		'upload' => 'file',
	));

	// write permission plugin hooks
	
	// Access permissions
	//elgg_register_plugin_hook_handler('access:collections:write', 'all', 'projects_write_acl_plugin_hook');
	//elgg_register_plugin_hook_handler('access:collections:read', 'all', 'projects_read_acl_plugin_hook');
}

/**
 * Dispatcher for projects.
 * URLs take the form of
 *  All projects:        projects/all
 *  User's projects:     projects/owner/<username>
 *  Friends' projects:   projects/friends/<username>
 *  View project:        projects/view/<guid>/<title>
 *  New project:         projects/add/<guid> (container: user, group, parent)
 *  Edit project:        projects/edit/<guid>
 *  History of project:  projects/history/<guid>
 *  Revision of project: projects/revision/<id>
 *  Group projects:      projects/group/<guid>/all
 *
 * Title is ignored
 *
 * @param array $project
 * @return bool
 */
function changeReqs_page_handler($changeReqs) {

	if (!isset($changeReqs[0])) {
		$changeReqs[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('changeReqss'), 'changeReqs/all');

	$base_dir = elgg_get_plugins_path() . 'changeRequests/pages/changeReqs';

	$changeReqs_type = $changeReqs[0];
	switch ($changeReqs_type) {
		case 'request':
			set_input('guid', $changeReqs[1]);
			include "$base_dir/request.php";
			break;
		case 'search':
			include "$base_dir/search.php";
			break;
		case 'owner':
			include "$base_dir/owner.php";
			break;
		case 'friends':
			include "$base_dir/friends.php";
			break;
		case 'view':
			set_input('guid', $changeReqs[1]);
			include "$base_dir/view.php";
			break;
		case 'add':
			set_input('guid', $changeReqs[1]);
			include "$base_dir/new.php";
			break;
		case 'edit':
			set_input('guid', $changeReqs[1]);
			include "$base_dir/edit.php";
			break;
		case 'group':
			include "$base_dir/owner.php";
			break;
		case 'history':
			set_input('guid', $changeReqs[1]);
			include "$base_dir/history.php";
			break;
		case 'revision':
			set_input('id', $changeReqs[1]);
			include "$base_dir/revision.php";
			break;
		case 'all':
			include "$base_dir/world.php";
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
function projects_url($entity) {
	$title = elgg_get_friendly_title($entity->title);
	return "projects/view/$entity->guid/$title";
}

/**
 * Override the project annotation url
 *
 * @param ElggAnnotation $annotation
 * @return string
 */
function projects_revision_url($annotation) {
	return "projects/revision/$annotation->id";
}

/**
* Returns a more meaningful message
*
* @param unknown_type $hook
* @param unknown_type $entity_type
* @param unknown_type $returnvalue
* @param unknown_type $params
*/
function project_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];
	if (($entity instanceof ElggEntity) && (($entity->getSubtype() == 'project_top') || ($entity->getSubtype() == 'project'))) {
		$descr = $entity->description;
		$title = $entity->title;
		//@todo why?
		$url = elgg_get_site_url() . "view/" . $entity->guid;
		$owner = $entity->getOwnerEntity();
		return $owner->name . ' ' . elgg_echo("projects:via") . ': ' . $title . "\n\n" . $descr . "\n\n" . $entity->getURL();
	}
	return null;
}

/**
 * Override the default entity icon for projects
 *
 * @return string Relative URL
 */
function projects_icon_url_override($hook, $type, $returnvalue, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'project_top') ||
		elgg_instanceof($entity, 'object', 'project')) {
		switch ($params['size']) {
			case 'small':
				return 'mod/projects/images/projects.gif';
				break;
			case 'medium':
				return 'mod/projects/images/projects_lrg.gif';
				break;
		}
	}
}

/**
 * Add a menu item to the user ownerblock
 */
function projects_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "projects/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('projects', elgg_echo('projects'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->projects_enable != "no") {
			$url = "projects/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('projects', elgg_echo('projects:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add links/info to entity menu particular to projects plugin
 */
function projects_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'projects') {
		return $return;
	}

	// remove delete if not owner or admin
	if (!elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != $entity->getOwnerGuid()) {
		foreach ($return as $index => $item) {
			if ($item->getName() == 'delete') {
				unset($return[$index]);
			}
		}
	}

	$options = array(
		'name' => 'history',
		'text' => elgg_echo('projects:history'),
		'href' => "projects/history/$entity->guid",
		'priority' => 150,
	);
	$return[] = ElggMenuItem::factory($options);

	return $return;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function projects_write_permission_check($hook, $entity_type, $returnvalue, $params)
{
	
	if ($params['entity']->getSubtype() == 'project'
		|| $params['entity']->getSubtype() == 'project_top') {

		$write_permission = $params['entity']->write_access_id;
		$user = $params['user'];

		if (($write_permission) && ($user)) {
			// $list = get_write_access_array($user->guid);
			$list = get_access_array($user->guid); // get_access_list($user->guid);

			if (($write_permission!=0) && (in_array($write_permission,$list))) {
				return true;
			}
			
			
		}
	}
}

/**
 * Extend container permissions checking to extend can_write_to_container for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function projects_container_permission_check($hook, $entity_type, $returnvalue, $params) {

	if (elgg_get_context() == "projects") {
		if (elgg_get_page_owner_guid()) {
			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
		}
		if ($project_guid = get_input('project_guid',0)) {
			$entity = get_entity($project_guid);
		} else if ($parent_guid = get_input('parent_guid',0)) {
			$entity = get_entity($parent_guid);
		}
		if ($entity instanceof ElggObject) {
			if (
					can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid)
					|| in_array($entity->write_access_id,get_access_list())
				) {
					return true;
			}
		}
	}

}

