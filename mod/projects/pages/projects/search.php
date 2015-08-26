<?php

$title = elgg_echo('projects:all');

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('projects'));

$db_prefix = elgg_get_config("dbprefix");

projects_register_title_buttons();

$query = sanitise_string(get_input("q"));
$searchType = get_input('searchType');
if (!empty($query)) {
	
	//search title and description project fields
	$profile_fields = array_keys(elgg_get_config("projects"));
	if(!empty($profile_fields)){
		$params['joins'] = array(
			"JOIN {$db_prefix}objects_entity ge ON e.guid = ge.guid", 
			"JOIN {$db_prefix}metadata md on e.guid = md.entity_guid",
			"JOIN {$db_prefix}metastrings msv ON md.value_id = msv.id"
		);
	}
	else {
		$params["joins"] = array("JOIN {$db_prefix}groups_entity ge ON e.guid = ge.guid");
	}

	if($searchType == "tag"){
		$where = "e.subtype = 21 AND (msv.string LIKE '%$query%')";
	}
	else{
		$where = "e.subtype = 21 AND (ge.title LIKE '%$query%' OR ge.description LIKE '%$query%')";
	}
	$params['wheres'] = array($where);
	$params['full_view'] = false;

	$content = elgg_list_entities($params);
	$sidebar .= elgg_view('projects/sidebar/search');
	$sidebar .= elgg_view('projects/sidebar/searchByTag');

	$params = array(
		"content" => $content,
		'sidebar' => $sidebar
	);
}
$body = elgg_view_layout("content", $params);

echo elgg_view_page($title, $body);