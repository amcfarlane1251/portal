<?php

	/**
	 * Shows the activity of your friends in the Digest
	 * 
	 */

	$user = elgg_extract("user", $vars, elgg_get_logged_in_user_entity());
	$ts_lower = (int) elgg_extract("ts_lower", $vars);
	$ts_upper = (int) elgg_extract("ts_upper", $vars);
	
	$river_options = array(
		"relationship" => "friend",
		"relationship_guid" => $user->getGUID(),
		"limit" => 5,
		"posted_time_lower" => $ts_lower,
		"posted_time_upper" => $ts_upper,
		"pagination" => false,
		"href" => 'none'
	);

	if($vars['email']){
		if($river_items = elgg_get_river($river_options)){
			$title = "<h2 class='email'>" . elgg_echo("river:friends") . "</h2>";
			$title .= "<h5 class='email'>To view your colleagues activity visit ".elgg_get_site_url()."activity/friends/".$user->username."</h5>";
			echo $title;
			$summary = "<div class='email-section'>";
			foreach($river_items as $item){
				$summary .= "<p>".get_river_item_summary($item)."</p>";
			}
			$summary .= "</div>";

			echo $summary;
		}
	}

	else{
		if($river_items = elgg_list_river($river_options)){
			$title = elgg_view("output/url", array("text" => elgg_echo("river:friends")));
			$title .= "<h5>To view your colleagues activity visit ".elgg_get_site_url()."activity/friends/".$user->username."</h5>";

			echo elgg_view_module("digest", $title, $river_items);
		}
	}
