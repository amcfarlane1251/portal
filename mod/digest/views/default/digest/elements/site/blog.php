<?php

	/**
	* Shows the latests blogs in the Digest
	*
	*/
	
	$ts_lower = (int) elgg_extract("ts_lower", $vars);
	$ts_upper = (int) elgg_extract("ts_upper", $vars);

	// only show blogs that are published
	$dbprefix = elgg_get_config("dbprefix");
	
	$blog_status_name_id = add_metastring("status");
	$blog_published_value_id = add_metastring("published");
	
	$blog_options = array(
		"type" => "object",
		"subtype" => "blog",
		"limit" => 5,
		"created_time_lower" => $ts_lower,
		"created_time_upper" => $ts_upper,
		"joins" => array(
				"JOIN " . $dbprefix . "metadata bm ON e.guid = bm.entity_guid"				
		),
		"wheres" => array(
				"bm.name_id = " . $blog_status_name_id,				
				"bm.value_id = " . $blog_published_value_id				
		)
	);

	if($blogs = elgg_get_entities($blog_options)){
		if($vars['email']){
			$title = "<h2 class='email'>".elgg_echo("blog:blogs")."</h2>";
			$title .= "<h5 class='email'>To view all site blogs visit ".elgg_get_site_url()."blog/all?filter=newest </h5>";
			$latest_blogs = "<div class='email-section'>";
			foreach($blogs as $blog){
				$latest_blogs .= "<div class='blog'>";
				$latest_blogs .= "<h4 class='email'>". $blog->title . "</h4>";
				$latest_blogs .= "<p>".elgg_get_excerpt($blog->description)."</p>";
				$latest_blogs .= "</div>";
			}
			$latest_blogs .= "</div>";
			echo $title . $latest_blogs;
		}
		else{
			$title = elgg_echo("blog:blogs");
			$title .= "<h5>To view all site blogs visit ".elgg_get_site_url()."blog/all?filter=newest </h5>";
			
			$latest_blogs = "";
			
			foreach($blogs as $blog){
				$latest_blogs .= "<div class='digest-blog'>";
				if($blog->icontime){
					$latest_blogs .= "<img src='". $blog->getIconURL("medium") . "' />";
				}
				$latest_blogs .= "<span>";
				$latest_blogs .= "<h4>". $blog->title . "</h4>";
				$latest_blogs .= elgg_get_excerpt($blog->description);
				$latest_blogs .= "</span>";
				$latest_blogs .= "</div>";
			}
			
			echo elgg_view_module("digest", $title, $latest_blogs);
		}
	}
	