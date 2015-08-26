<?php
/**
 * Ajaxmodule simple object view
 * - This view is an attempt at showing a simple listing view for ALL objects
 *
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

if ($vars['entity']->title) {
	$title = $vars['entity']->title;
} else if ($vars['entity']->name) {
	$title = $vars['entity']->name;
} 

if ($title) {
	$title = "<h3><a href='{$vars['entity']->getURL()}'>{$title}</a></h3>";
}

$owner = get_user($vars['entity']->owner_guid);

$time = elgg_view_friendly_time($vars['entity']->time_created);

$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$owner_link = "<a href='{$vars['url']}profile/{$owner->username}/'>{$owner->name}</a>";

$desc = $vars['entity']->description;	

// If entity has an excerpt (blogs)
if ($vars['entity']->excerpt) {
	$desc = $vars['entity']->excerpt;
}

$desc = parse_urls($desc);

// Strip out hashtags
$regex = '/#([A-Aa-z0-9_-]+)/is';

$desc = (preg_replace($regex, '', $desc));

$list_body = <<<HTML
	$title
	<div class=\"elgg-list-content\">$desc</div>
	<span style='display: block' class='elgg-subtext'>
		by $owner_link $time
	</span>
HTML;

echo elgg_view_image_block($owner_icon, $list_body);
