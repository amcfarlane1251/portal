<?php
	
	//set the title
	$title = "Register for an account";

	//start building main column of the page
	$content = elgg_view_title($title);


	//add the sign up form to this section
	$content .= elgg_view_form("sign_up/submit", array("class" => "elgg-form-account", "id" => "register_form"));

	//layout the page
	$body = elgg_view_layout('one_column', array(
		'content' => $content
	));

	//draw the page
	echo elgg_view_page($title, $body);
?>