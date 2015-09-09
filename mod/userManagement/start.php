<?
//start.php
elgg_register_event_handler('init', 'system', 'userManagementInit');

function userManagementInit()
{
	$pluginPath = elgg_get_plugins_path().'userManagement/';
	//register actions
	elgg_register_action('login', $pluginPath.'actions/login.php', 'public');
	elgg_register_action('activate', $pluginPath.'actions/activate.php', 'public');
	elgg_register_action('users/import', $pluginPath."actions/import.php", 'admin');
	//register page handler for routes
	elgg_register_page_handler('usermgmt', 'userManagementPageHandler');
}

function userManagementPageHandler($page)
{
	switch($page[0]){
		case 'deactivate':
			$userMgmt = new UserManagement();

			$userMgmt->getInactiveUsers();
			$userMgmt->deactivateUsers();
		break;
		//activate account form
		case 'activate':
			include(elgg_get_plugins_path().'userManagement/pages/activate.php');
		break;
		//activate account action
		case 'activation':
			$userMgmt = new UserManagement();

			$userGuid = get_input('u');
			$code = get_input('c');
			$user = get_entity($userGuid);
			if(!$user)
			{
				register_error(elgg_echo('activate:error'));
				forward(REFERER);
			}
			$userMgmt->setUser($user);

			if(!$userMgmt->validateCode($code))
			{
				register_error(elgg_echo('activate:error'));
				forward(REFERER);
			}

			//activate user
			if($userMgmt->activateUser())
			{
				system_message(elgg_echo('activate:success'));
				forward(REFERER);
			}
		break;

		case 'import':
			admin_gatekeeper();
			elgg_admin_add_plugin_settings_menu();
			elgg_set_context('admin');

			elgg_unregister_css('elgg');
			elgg_load_js('elgg.admin');
			elgg_load_js('jquery.jeditable');

			$vars = array('page' => $page);
			$view = 'usermanagement/' . implode('/',$page);
			$title = "Import Users";

			$content = elgg_view($view);

			$body = elgg_view_layout('admin', array('content' => $content, 'title' => $title));
			echo elgg_view_page($title, $body, 'admin');
		break;

		case 'registerEmails':
			include(elgg_get_plugins_path()."userManagement/pages/registerEmails.php");
			break;

		default:
			return false;
	}
	return true;
}