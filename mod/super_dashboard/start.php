<?php 
/*
 *
 * Super Dashboard
 *
 * @author SW Social Web
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright (c) SW Social Web 2014
 *
 * Based on Youtube TV by RiverVanRain
 *
 */

function super_dashboard_init() {
     
	 elgg_register_page_handler('super_dashboard', 'super_dashboard_page_handler');
	 
	 if (elgg_is_logged_in()) {
	 $item = new ElggMenuItem('ytv', elgg_echo('super_dashboard:title'), 'super_dashboard');
	 elgg_register_menu_item('site', $item);
	 }
	 
	 elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'super_dashboard_owner_block_menu');
	
     //elgg_register_widget_type("ytv", elgg_echo("ytv:title"), elgg_echo("ytv:description"), "ytv", false);

	//elgg_extend_view("css/elgg", "ytv/css");
	//elgg_register_js('elgg.ytv','mod/ytv/js/ytv.js');
	
		elgg_register_menu_item('topbar', array(
		'name' => 'dashboard',
		'href' => 'super_dashboard',
		'text' => elgg_view_icon('home') . elgg_echo('dashboard'),
		'priority' => 450,
		'section' => 'alt',
	));

		
}

function super_dashboard_page_handler($page) {
   $current_user = elgg_get_logged_in_user_entity();
  
  if (isset($page[0])) {
		$username = $page[0];
		$user = get_user_by_username($username);
		elgg_set_page_owner_guid($user->guid);
	} elseif (elgg_is_logged_in()) {
		forward('super_dashboard/'.$current_user->username);
	}
	else {
	forward('404');
	}
    
	require_once dirname(__FILE__) . '/pages/super_dashboard.php';
	return true;
}

function ytv_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "ytv/{$params['entity']->username}";
		$item = new ElggMenuItem('super_dashboard', elgg_echo('super_dashboard:title'), $url);
		$return[] = $item;
	}
	return $return;
}

elgg_register_event_handler("init", "system", "super_dashboard_init");