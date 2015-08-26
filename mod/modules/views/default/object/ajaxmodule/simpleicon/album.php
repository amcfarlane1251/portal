<?php
/**
 * Modules Album simpleicon view
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
	
$entity = $vars['entity'];

if (!$entity) {
	return '';
}

$owner = $entity->getOwnerEntity();
$friendlytime = elgg_view_friendly_time($entity->time_created);


$info .= "<a href=\"{$entity->getURL()}\">{$entity->title}</a>";

$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
		
$info .= "<p class='elgg-subtext'><a href=\"{$vars['url']}profile/{$owner->username}\">{$owner->name}</a> {$friendlytime}</p>";

$pop_url = elgg_get_site_url() . "photos/thumbnail/{$entity->getGUID()}/large/img.jpg";


//get album cover if one was set 
if ($cover_guid = $entity->getCoverImageGuid()) {
	$src = elgg_get_site_url() . "photos/thumbnail/{$cover_guid}/thumb/";
} else {
	$src = elgg_get_site_url() . 'mod/tidypics/graphics/empty_album.png';
}

$icon = "<a class='' href='{$entity->getURL()}'><img src='$src' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
