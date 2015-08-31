<?php

	/**
	* Shows the newest members in the Digest
	*
	*/		
		$ts_lower = (int) elgg_extract("ts_lower", $vars);
		$ts_upper = (int) elgg_extract("ts_upper", $vars);
		
		$member_options = array(
				"type" => "user",
				"limit" => 6,
				"relationship" => "member_of_site",
				"relationship_guid" => elgg_get_site_entity()->getGUID(),
				"inverse_relationship" => true,
				"created_time_lower" => $ts_lower,
				"created_time_upper" => $ts_upper
		);
		
		if($newest_members = elgg_get_entities_from_relationship($member_options)){
			if($vars['email']){
				$title = "<h2 class='email'>".elgg_echo("members")."</h2>";
				$title .= "<h5 class='email'>To view the newest members visit ".elgg_get_site_url()."members </h5>";
				$content = "<div class='email-section'>";
				foreach($newest_members as $members){
					$content .= "<div class='member'>";
					$content .= "<h4 class='email'>".$members->name."</h4>";
					$content .= "<p>".$members->description."</p>";
					$content .= "</div>"; 
				}
				$content .= "</div>";

				echo $title . $content;
			}
			else{
				$title = elgg_echo("members");
				$title .= "<h5>To view the newest members visit ".elgg_get_site_url()."members </h5>";
			
				$content = "<table class='digest-profile'>";
			
				foreach($newest_members as $index => $mem){
					if(($index % 3 == 0)){
						// only 3 per line
						$content .= "<tr>";
					}
				
					$content .= "<td>";
					$content .= elgg_view_entity_icon($mem, 'medium', array('use_hover' => false)) . "<br />";
					$content .= $mem->name . "<br />";
					$content .= $mem->briefdescription;
					$content .= "</td>";
						
					if(($index % 3) === 2 ){
						$content .= "</tr>";
					}
				}
			
				if(($index % 3) !== 2){
					// fill up empty columns
					if(($index + 2) % 3){
						$content .= "<td>&nbsp;</td>";
						$content .= "<td>&nbsp;</td>";
					} elseif(($index + 1) % 3){
						$content .= "<td>&nbsp;</td>";
					}
						
					$content .= "</tr>";
				}
					
				$content .= "</table>";
			
				echo elgg_view_module("digest", $title , $content);
			}
		}