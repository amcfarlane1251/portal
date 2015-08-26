<?php

elgg_register_event_handler('init', 'system', 'easytheme_init');
elgg_unregister_plugin_hook_handler('register', 'menu:river', 'elgg_river_menu_setup');

if(isset($_GET['lang']) && in_array($_GET['lang'], array("en", "fr"))){
	$_SESSION['ongarde-lang']=$_GET['lang'];
}
if(isset($_SESSION['ongarde-lang'])){
	elgg_set_config("language",$_SESSION['ongarde-lang']);
}

function easytheme_init() {
		
	        elgg_extend_view('css/elgg', 'easytheme/css');
		elgg_unregister_menu_item('topbar', 'elgg_logo');

		
		//Remove the default menu items
		elgg_unregister_menu_item('site', 'blog');
		elgg_unregister_menu_item('site', 'activity');
		elgg_unregister_menu_item('site', 'file');
		elgg_unregister_menu_item('site', 'members');
		elgg_unregister_menu_item('site', 'pages');
		elgg_unregister_menu_item('site', 'thewire');
		elgg_unregister_menu_item('site', 'bookmarks');
		elgg_unregister_menu_item('site', elgg_echo('tasks'));
                elgg_unregister_menu_item('site', 'answers');
		elgg_unregister_menu_item('site', 'groups');
		elgg_unregister_menu_item('site', 'photos');
                elgg_extend_view('css/admin', 'easytheme/admin');
                
                
                elgg_extend_view ('page/elements/head','easytheme/meta');

		$base = elgg_get_plugins_path() . 'easytheme/actions/easytheme';
		elgg_register_action('easytheme/settings/save', "$base/save.php", 'admin');
		//Removes the "More" from the navigation menu
		//elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');

elgg_register_menu_item('topbar', array(

	'name' => 'bmark',

	'text' => '',

	'title' => 'Bookmarks',

	'href' => 'bookmarks/all',
	
	'parent_name' => '',
	
	'priority' => 600

));	
		
		elgg_register_menu_item('site', array(

	'name' => 'home',

	'text' => elgg_echo('ongarde:home'),

	'href' => '/',
	
	'parent_name' => '',
	
	'priority' => 100

));


       /* elgg_register_menu_item('site', array(




	'name' => 'wiki',

	'text' => 'Wiki',

	'href' => 'http://198.164.43.9/mediawiki-1.19.2/',

	'target' => '_blank',	
	'parent_name' => '',
	
	'priority' => 1400

));*/

elgg_register_menu_item('site', array(

	'name' => 'page',

	'text' => elgg_echo('ongarde:page'),

	'href' => 'pages/all',
	
	'parent_name' => 'browse',
	
	'priority' => 400 

));
elgg_register_menu_item('site', array(

	'name' => 'files',

	'text' => elgg_echo('ongarde:files'),

	'href' => 'file/all',
	
	'parent_name' => '',
	
	'priority' => 500

));

elgg_register_menu_item('site', array(

	'name' => 'blogs',

	'text' => elgg_echo('ongarde:blog'),

	'href' => 'blog/all',
	
	'parent_name' => 'browse',
	
	'priority' => 700

));

elgg_register_menu_item('site', array(

	'name' => 'activity',

	'text' => elgg_echo('ongarde:activity'),

	'href' => 'activity/all',
	
	'parent_name' => '',
	
	'priority' => 700

));

elgg_register_menu_item('site', array(

	'name' => 'browse',

	'text' => elgg_echo('ongarde:browse'),

	'href' => '#',
	
	'parent_name' => '',
	
	'priority' => 800

));

elgg_register_menu_item('site', array(

        'name' => 'badges',

        'text' => elgg_echo('Badges'),

        'href' => 'points/badges',

        'parent_name' => 'browse',

        'priority' => 2000

));

elgg_register_menu_item('site', array(

	'name' => 'groups', 
	
	'text' => elgg_echo('ongarde:groups'),

	'href' => 'groups/all',

	'parent_name' => 'browse', 

	'priority' => 900

));
/*elgg_register_menu_item('site', array(


        'name' => 'photos',

        'text' => elgg_echo('ongarde:photos'),

        'href' => 'photos/all',

        'parent_name' => 'browse',

        'priority' => 1000

));*/
elgg_register_menu_item('site', array(

	'name' => 'bookmarks',
	
	'text' => elgg_echo('ongarde:bookmark'),

	'href' => 'bookmarks/all',

	'parent_name' => 'browse',

	'priority' => 1200

));

/*	elgg_register_menu_item('site', array(

		
		'name' => 'projects',
		
		'text' => 'Projects',
		
		'title' => 'Create a Project',
		
		'href' => 'projects/all',
		
		'parent_name' => '',
		
		'priority' => 800
	));*/
	elgg_register_menu_item('site', array(
		
		'name' => 'dndlearn',
		
		'text' => 'DNDLearn',
		
		'title' => '',
		
		'href' => 'https://dln-rad.forces.gc.ca/login',
	
		'target' => '_black',
		
		'parent_name' => '',
		
		'priority' => 3000

	));

 elgg_register_menu_item('site', array(

                'name' => 'news',

                'text' => 'App Store',

                'title' => '',

                'href' => 'http://s14.ongarde.net',

                'target' => '_black',

                'parent_name' => '',

                'priority' => 2000

        ));


elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
elgg_register_plugin_hook_handler('prepare', 'menu:site', 'customize_site_menu_setup');


}



//$default_items = elgg_extract('default', $vars['menu'], array());
//$more_items = elgg_extract('more', $vars['menu'], array());


 






//--------------------



//------------------------------------------------------------
function customize_site_menu_setup($hook, $type, $return, $params) {

    $featured_menu_names = elgg_get_config('site_featured_menu_names');
    $custom_menu_items = elgg_get_config('site_custom_menu_items');
    
    if ($featured_menu_names || $custom_menu_items) {
        // we have featured or custom menu items

        $registered = $return['default'];

        // set up featured menu items
        $featured = array();
        foreach ($featured_menu_names as $name) {
            foreach ($registered as $index => $item) {
                if ($item->getName() == $name) {
                    $featured[] = $item;
                    unset($registered[$index]);
                }
            }
        }

        // add custom menu items
        $n = 1;
        foreach ($custom_menu_items as $title => $url) {
            $item = new ElggMenuItem("custom$n", $title, $url);
            $featured[] = $item;
            $n++;
        }
        
        //register the remaining items
        foreach ($registered as $index => $item) {
            $featured[] = $item;
        }

        $return['default'] = $featured;
        //do not add the "More" button
        //$return['more'] = $registered;
    } else {
        // no featured menu items set
        $max_display_items = 10;

        // the first n are shown, rest added to more list
        // if only one item on more menu, stick it with the rest
        $num_menu_items = count($return['default']);
        if ($num_menu_items > ($max_display_items + 1)) {
            $return['more'] = array_splice($return['default'], $max_display_items);
        }
    }

	return $return;
}

function easytheme_river_menu_handler($hook, $type, $items, $params) {
	$item = $params['item'];

	$object = $item->getObjectEntity();
	if (!$item->annotation_id && $object instanceof ElggEntity) {
		if ($object->canAnnotate(0, 'generic_comment')) {
			$items[] = ElggMenuItem::factory(array(
				'name' => 'comment',
				'href' => "#comments-add-$object->guid",
				'text' => elgg_view_icon('speech-bubble'),
				'title' => elgg_echo('comment:this'),
				'rel' => "toggle",
				'priority' => 50,
			));
		}
		
		if ($object instanceof ElggUser && !$object->isFriend() && $owner->guid != $user->guid) {
			$items[] = ElggMenuItem::factory(array(
				'name' => 'addfriend',
				'href' => "/action/friends/add?friend=$object->guid",
				'text' => elgg_view_icon('addfriend') . elgg_echo('friend:user:add', array($object->name)),
				'is_action' => TRUE,
			));
		}
		if (elgg_instanceof($object, 'object', 'groupforumtopic')) {
			$items[] = ElggMenuItem::factory(array(
				'name' => 'reply',
				'href' => "#groups-reply-$object->guid",
				'title' => elgg_echo('reply:this'),
				'text' => elgg_echo('reply'),
			));
		}
	}

	return $items;
}

