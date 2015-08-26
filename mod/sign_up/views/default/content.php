<?php
/**
* ONGARDE Sign Up Form
*/

if(!elgg_is_logged_in()){
	$site_url = elgg_get_site_url();
	$sign_up_url = $elgg_get_plugins_path() . "sign_up/";

	if (elgg_get_config('https_login')) {
			$sign_up_url = str_replace("http:", "https:");
	}

	$title = "Register for an account";

	$content = elgg_view_title($title);

	//add the sign up form to this section
	$content .= elgg_view_form("signup/signup");

	//optionally, add content for the sidebar
	$sidebar = "";

	//layout the page
	$body = elgg_view_layout
}
?>