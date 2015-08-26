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
$db_prefix = elgg_get_config('dbprefix');
elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'file',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
	'wheres' => "NOT EXISTS ( SELECT 1 FROM {$db_prefix}entity_relationships WHERE guid_two = e.guid AND relationship = 'folder_of' )"
);
//$content = elgg_list_entities_from_relationship($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('file:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "file/add/$group->guid",
	'text' => elgg_echo('file:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('file:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
