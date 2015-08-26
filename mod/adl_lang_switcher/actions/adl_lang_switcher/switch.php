<?php

//echo get_current_language();

if( get_current_language() == "en" ) {
	$language = "fr";
} else  {
	$language = "en";
}

$user = elgg_get_logged_in_user_entity();

if($user){

	$user->language = $language;

	if($user->save()) {
		system_message(elgg_echo('adl_lang_switcher:switch:success'));
	} else {
		register_error(elgg_echo('adl_lang_switcher:switch:fail'));
	}

}
?>
