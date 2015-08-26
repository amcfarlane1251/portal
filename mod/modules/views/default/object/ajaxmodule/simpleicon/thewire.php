<?php
/**
 * Modules generic simpleicon list view.
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
$friendlytime = elgg_view_friendly_time($entity->time_created);


$info .= "<span class='modules-thewire-quote'>&#8220; </span><span style='font-weight: bold; font-size: 1em'>$entity->description</span><span class='modules-thewire-quote'> &#8221;</span>";
		
$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$info .= "<p class='elgg-subtext'><a href=\"{$vars['url']}profile/{$owner->username}\">{$owner->name}</a> {$friendlytime}</p>";

$icon = "<a href='{$entity->getURL()}'><img src='{$entity->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
