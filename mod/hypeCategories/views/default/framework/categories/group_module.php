<?php
/**
 * Group categories module
 */
namespace hypeJunction\Categories;

$container = elgg_get_page_owner_entity();

if (elgg_instanceof($container, 'user')) {
	// do not show on user owned pages
	return;
}

if (!elgg_instanceof($container, 'group')) {
	$container = elgg_get_site_entity();
} else if (!HYPECATEGORIES_GROUP_CATEGORIES || $container->categories_enable == "no") {
	return;
}

$count = get_subcategories($container->guid, array('count' => true));

if (!$count && !$container->canEdit()) {
	return;
}

$title = elgg_echo('categories:group_module');

$vars['container'] = $container;
$body = elgg_view('framework/categories/tree', $vars);

$content = elgg_view_module('aside', "", $body, array(
	'class' => 'categories-sidebar-tree-module',
));

if ($container->canEdit()) {
	$footer = elgg_view('output/url', array(
		'text' => elgg_echo('categories:manage'),
		'href' => PAGEHANDLER . "/manage/$container->guid",
		'is_trusted' => true
	));
}



echo elgg_view('groups/profile/module', array(
	'title' => $title, 
	'content' => $content,
	'all_link' => $footer
));

