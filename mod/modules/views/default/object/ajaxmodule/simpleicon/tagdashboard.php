<?php
/**
 * Modules tagdashboard simpleicon list view.
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2013
 * @link http://www.thinkglobalschool.com/
 * 
 * @uses $vars['default_view'] which tagdashboard view to link too (null | media)
 */

$entity = $vars['entity'];

$default_view = elgg_extract('default_view', $vars, false);

if (!$entity) {
	return '';
}

$url = $entity->getURL();

if (in_array($default_view, array('media', 'timeline'))) {
	$url .= "#{$default_view}";
}

$owner = $vars['entity']->getOwnerEntity();
$friendlytime = elgg_view_friendly_time($entity->time_created);

if ($entity->title) {
	$title = $entity->title;
} else if ($entity->name) {
	$title = $entity->name;
} else {
	$title = $entity->getURL();
}

$info .= "<a href=\"{$url}\">{$title}</a>";
		
$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
		
$info .= "<p class='elgg-subtext'><a href=\"{$vars['url']}profile/{$owner->username}\">{$owner->name}</a> {$friendlytime}</p>";

$icon = "<a href='{$url}'><img src='{$entity->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
