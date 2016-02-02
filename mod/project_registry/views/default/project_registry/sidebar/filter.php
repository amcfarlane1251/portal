<?php

$url = elgg_get_site_url() . 'projects/search?subtype=project_registry';;

elgg_register_menu_item('page', array(
	'name' => 'projects:all',
	'text' => elgg_echo('all'),
	'href' =>  "$url&filter=all",
));