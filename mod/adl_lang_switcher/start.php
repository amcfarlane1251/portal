<?php
//echo "test";

elgg_register_action("adl_lang_switcher/switch", elgg_get_plugins_path() . "adl_lang_switcher/actions/adl_lang_switcher/switch.php", "public");
elgg_register_page_handler('adl_lang_switcher', 'adl_lang_switcher_switch_page');


elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'expages_public'); 
function expages_public($hook, $handler, $return, $params){
	$pages = array('action/adl_lang_switcher.*');
	return array_merge($pages, $return);
}


/*
if( get_current_language() == "en" ) {
	$nextLang = "FR";
} else {
	$nextLang = "EN";
}

elgg_register_menu_item('topbar', array(
	'name' => 'switchLang',
	'href' => "action/adl_lang_switcher/switch",
	'text' => elgg_echo($nextLang),
	'is_action' => TRUE,
	'priority' => 200,
	'section' => '',
));
*/                
                


function adl_lang_switcher_switch_page($segments) {
	//die("Testing death");
    if ($segments[0] == 'switch') {
        include elgg_get_plugins_path() . 'adl_lang_switcher/pages/adl_lang_switcher/switch.php';
        return true;
    }
    return false;
}
?>
