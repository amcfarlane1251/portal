<?php

$site = elgg_get_site_entity();

if (HYPEFORUM_CATEGORIES_TOP) { // global forum categories are enabled
	$options = array(
		'types' => 'object',
		'subtypes' => 'hjforumcategory',
		'limit' => 0,
		'container_guids' => $site->guid
	);

	// order by priority
	$options = hj_framework_get_order_by_clause('md.priority', 'ASC', $options);

	$categories = elgg_get_entities($options);

	echo elgg_view_entity_list($categories, array(
		'list_class' => 'forum-category-list'
	));
} else {
	$params = array(
		'list_id' => "siteforums",
		'container_guids' => array($site->guid),
		'subtypes' => array('hjforum')
	);
	echo elgg_view('framework/forum/lists/forums', $params);
}