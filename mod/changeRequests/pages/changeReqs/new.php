<?php
/**
 * Create a new project
 *
 * @package ElggPages
 */

gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);
if (!$container) {

}

$parent_guid = 0;
$changeReqOwner = $container;
if (elgg_instanceof($container, 'object')) {
	$parent_guid = $container->getGUID();
	$changeReqOwner = $container->getContainerEntity();
}

elgg_set_page_owner_guid($changeReqOwner->getGUID());
elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('changeReqs'), elgg_get_site_url()."changeReqs");
$title = elgg_echo('changeReqs:add');
elgg_push_breadcrumb($title);

$vars = change_reqs_prepare_form_vars(null, $parent_guid); 
$content = elgg_view_form('changeReqs/edit', array('enctype' => 'multipart/form-data'), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
