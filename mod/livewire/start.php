<?php
/*
 * Live wire posts
 *
 */
 	  
elgg_register_event_handler('init', 'system', 'livewire_init');

function livewire_init() {
		
		$action_path = dirname(__FILE__) . '/actions';
		
		$plugin = elgg_get_plugin_from_id('livewire');

		elgg_register_action("livewire/add", "$action_path/add.php");		
		elgg_extend_view('js/elgg', 'js/livewire/update');

	elgg_register_widget_type('livewire', elgg_echo('ONGARDE Live'), elgg_echo('Display the wire'), "index,dashboard", true);
		elgg_unregister_page_handler('activity', 'elgg_river_page_handler');
		elgg_register_page_handler('activity', 'livewire_river_page_handler');
	
		if (elgg_is_logged_in()	&& elgg_get_context() == 'activity'){	
			elgg_extend_view('page/layouts/content/header', 'page/elements/riverwire', 1);
	}
}

function livewire_river_page_handler($page) {
	global $CONFIG;
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
	// make a URL segment available in page handler script
	$page_type = elgg_extract(0, $page, $param);
	$page_type = preg_replace('[\W]', '', $page_type);
	if ($page_type == 'owner') {
		$page_type = 'mine';
	}
	set_input('page_type', $page_type);

	require_once("{$CONFIG->path}mod/livewire/pages/river.php");
	return true;
}


