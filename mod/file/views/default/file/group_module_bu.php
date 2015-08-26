<?php
/**
 * Group file module
 */


$group = elgg_get_page_owner_entity();

if ($group->file_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "file/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'file',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$file_content = elgg_list_entities($options);
elgg_pop_context();

if (!$file_content) {
	$file_content = '<p>' . elgg_echo('file:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "file/add/$group->guid",
	'text' => elgg_echo('file:add'),
	'is_trusted' => true,
));

$files = elgg_extract("files", $vars, array());
	$folder = elgg_extract("folder", $vars);
	
	$folder_content = elgg_view("file_tools/breadcrumb", array("entity" => $folder));	
	
	if(!($sub_folders = file_tools_get_sub_folders($folder))){
		$sub_folders = array();
	}
	
	$entities = array_merge($sub_folders, $files) ;
	
	if(!empty($entities)) {
		$params = array(
			"full_view" => false,
			"pagination" => false
		);
		
		elgg_push_context("file_tools_selector");
		
		$files_content = elgg_view_entity_list($entities);
		elgg_pop_context();
	}
	
	if(empty($files_content)){
		$files_content = elgg_echo("No sub-folder found");
	} else {
		$files_content .= "<div class='clearfix'>";
		$files_content .= "</div>";
	}
	
	$files_content .= elgg_view("graphics/ajax_loader");

?>

<?php
$content = $folder_content . $files_content . $file_content;

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('file:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
?>

