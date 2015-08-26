<?php

	/**
	* Shows the newest groups in the Digest
	*
	*/
	
	$ts_lower = (int) elgg_extract("ts_lower", $vars);
	$ts_upper = (int) elgg_extract("ts_upper", $vars);
	
	$group_options = array(
		"type" => "group",
		"limit" => 6,
		"created_time_lower" => $ts_lower,
		"created_time_upper" => $ts_upper
	);

	if($newest_groups = elgg_get_entities($group_options)){
		if($vars['email']){
			$title = "<h2 class='email'>".elgg_echo("groups")."</h2>";
			$title .= "<h5 class='email'>To view all groups visit ".elgg_get_site_url()."groups/all/ </h5>";

			$group_items = "<div class='email-section'>";
			foreach($newest_groups as $group){
				$group_items .= "<div class='group'>";
				$group_items .= "<h4 class='email'>".$group->name."</h4>";
				$group_items .= "</div>";
			}
			$group_items .= "</div>";
			echo $title . $group_items;
		}
		else{
			$title = elgg_echo("groups");
			$title .= "<h5>To view all groups visit ".elgg_get_site_url()."groups/all/ </h5>";
			
			$group_items = "<table class='digest-groups'>";
			
			foreach($newest_groups as $index => $group){
				if(($index % 3 == 0)){
					$group_items .= "<tr>";
				}

				$group_items .= "<td>";
				$group_items .= "<img src='".$group->getIconURL('medium')."' />";
				$group_items .= $group->name;
				$group_items .= "</td>";

				if(($index % 3) === 2 ){
					$group_items .= "</tr>";
				}
			}
			
			if(($index % 3) !== 2){
				if(($index + 2) % 3){
					$group_items .= "<td>&nbsp;</td>";
					$group_items .= "<td>&nbsp;</td>";
				} elseif(($index + 1) % 3){
					$group_items .= "<td>&nbsp;</td>";
				}
				
				$group_items .= "</tr>";
			}
				
			$group_items .= "</table>";
			
			echo elgg_view_module("digest", $title, $group_items);
		}
	}
	