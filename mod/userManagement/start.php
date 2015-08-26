<?
//start.php
elgg_register_event_handler('init', 'system', 'userManagementInit');

function userManagementInit()
{
	$pluginPath = elgg_get_plugins_path().'userManagement/';
	//register actions
	elgg_register_action('login', $pluginPath.'actions/login.php', 'public');
	elgg_register_action('activate', $pluginPath.'actions/activate.php', 'public');
	//register page handler for routes
	elgg_register_page_handler('usermgmt', 'userManagementPageHandler');
}

function userManagementAuthHandler($credentials)
{
	if (is_array($credentials) && ($credentials['username']))
    {
        $username = $credentials['username'];
        $user = get_user_by_username($username);
	    
	    if($user->deactivated){
	    	forward('usermgmt/reactivate');
	    }
    }


}

function userManagementPageHandler($page)
{
	switch($page[0]){
		case 'deactivate':
			$userMgmt = new UserManagement();

			$userMgmt->getInactiveUsers();
			$userMgmt->deactivateUsers();
		break;

		case 'activate':
			include(elgg_get_plugins_path().'userManagement/pages/activate.php');
		break;

		case 'activation':
			$userMgmt = new UserManagement();

			$userGuid = get_input('u');
			$code = get_input('c');
			$user = get_entity($userGuid);
			$userMgmt->user = $user;

			if($userMgmt->validateCode($code))
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

		case 'registerEmails':
			include(elgg_get_plugins_path()."userManagement/pages/registerEmails.php");
			break;

		default:
			return false;
	}
	return true;
}