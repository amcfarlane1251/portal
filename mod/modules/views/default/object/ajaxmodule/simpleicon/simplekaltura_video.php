<?php
/**
 * Modules Simplekaltura video view
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

$length = elgg_echo('simplekaltura:label:vidlength', array(simplekaltura_sec2hms($entity->duration)));

$play_count = (is_int($entity->plays)) ? $entity->plays : elgg_echo('simplekaltura:label:unavailable');

$plays = elgg_echo('simplekaltura:label:vidplays', array($play_count));

$info .= "<a href=\"{$entity->getURL()}\">{$entity->title}</a>";

$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
		
$info .= "<p class='elgg-subtext'><a href=\"{$vars['url']}profile/{$owner->username}\">{$owner->name}</a> {$friendlytime} <br /> {$length} <br /> {$plays}</p>";

$pop_url = elgg_get_site_url() . 'ajax/view/simplekaltura/popup?entity_guid=' . $entity->guid;

$icon = "<a class='simplekaltura-lightbox' href='{$pop_url}'><img src='{$entity->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
