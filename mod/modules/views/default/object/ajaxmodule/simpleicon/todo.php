<?php
/**
 * Modules todo simpleicon list view.
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

$owner = $vars['entity']->getOwnerEntity();

// Add due date
$date = is_int($entity->due_date) ? date("F j, Y", $entity->due_date) : $entity->due_date;
$due_date = elgg_echo('todo:label:due', array($date));

if ($entity->title) {
	$title = $entity->title;
} else if ($entity->name) {
	$title = $entity->name;
} else {
	$title = $entity->getURL();
}

$info .= "<a href=\"{$entity->getURL()}\">{$title}</a>";
		
$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
		
$info .= "<p class='elgg-subtext'><a href=\"{$vars['url']}profile/{$owner->username}\">{$owner->name}</a><br />{$due_date}</p>";

$icon = "<a href='{$entity->getURL()}'><img src='{$entity->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
