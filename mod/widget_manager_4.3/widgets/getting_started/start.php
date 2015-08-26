<?php
	function widget_getting_started_init()	{
	
	elgg_extend_view("css/elgg", "widgets/getting_started/css");
	elgg_register_widget_type("getting_started", elgg_echo("widget_manager:widgets:getting_started:name"), elgg_echo("widget_manager:widgets:getting_started:name"), "groups,index,dashboard,profile", true);
	}	
	
	elgg_register_event_handler("widgets_init", "widget_manager", "widget_getting_started_init");
/**	
elgg_register_plugin_hook_handler('register', 'menu:composer', 'facebook_theme_composer_menu_handler');
		
	elgg_register_ajax_view('thewire/composer');
	elgg_register_ajax_view('messageboard/composer');
	elgg_register_ajax_view('blog/composer');
	elgg_register_ajax_view('file/composer');
	elgg_register_ajax_view('bookmarks/composer');
*/


	/**
 * Adds menu items to the "composer" at the top of the "wall".  Need to also add
 * the forms that these items point to.
 * 
 * @todo Get the composer concept integrated into core
 
function facebook_theme_composer_menu_handler($hook, $type, $items, $params) {
    $entity = $params['entity'];

    $pageowner = elgg_get_page_owner_entity();

    if (elgg_is_active_plugin('thewire') && $entity->canWriteToContainer(0, 'object', 'thewire')) {
        $items[] = ElggMenuItem::factory(array(
            'name' => 'thewire',
            'href' => "/ajax/view/thewire/composer?container_guid=$entity->guid",
            'text' => elgg_view_icon('share') . elgg_echo("Share"),
            'priority' => 100,
        ));

		
		//trigger any javascript loads that we might need
		elgg_view('thewire/composer');
	}
	
	if (elgg_is_active_plugin('messageboard') && $entity->canAnnotate(0, 'messageboard')) {
		$items[] = ElggMenuItem::factory(array(
			'name' => 'messageboard',
			'href' => "/ajax/view/messageboard/composer?entity_guid=$entity->guid",
			'text' => elgg_view_icon('speech-bubble-alt') . elgg_echo("Status"),
			'priority' => 200,
		));
		
		//trigger any javascript loads that we might need
		elgg_view('messageboard/composer');
	}
	
	if (elgg_is_active_plugin('bookmarks') && $entity->canWriteToContainer(0, 'object', 'bookmarks')) {
		$items[] = ElggMenuItem::factory(array(
			'name' => 'bookmarks',
			'href' => "/ajax/view/bookmarks/composer?container_guid=$entity->guid",
			'text' => elgg_view_icon('push-pin') . elgg_echo("Bookmarks"),
			'priority' => 300,
		));
		
		//trigger any javascript loads that we might need
		elgg_view('bookmarks/composer');
	}
	
	if (elgg_is_active_plugin('blog') && $entity->canWriteToContainer(0, 'object', 'blog')) {
		$items[] = ElggMenuItem::factory(array(
			'name' => 'blog',
			'href' => "/ajax/view/blog/composer?container_guid=$entity->guid",
			'text' => elgg_view_icon('speech-bubble') . elgg_echo("Blog"),
			'priority' => 600,
		));
		
		//trigger any javascript loads that we might need
		elgg_view('blog/composer');
	}
	
	if (elgg_is_active_plugin('file') && $entity->canWriteToContainer(0, 'object', 'file')) {
		$items[] = ElggMenuItem::factory(array(
			'name' => 'file',
			'href' => "/ajax/view/file/composer?container_guid=$entity->guid",
			'text' => elgg_view_icon('clip') . elgg_echo("Files"),
			'priority' => 700,
		));
		
		//trigger any javascript loads that we might need
		elgg_view('file/composer');
	}
	
	return $items;

}
*/
