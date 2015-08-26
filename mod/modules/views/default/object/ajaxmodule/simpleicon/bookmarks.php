<?php
/**
 * Modules Custom bookmarks simpleicon list view.
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$bookmark = $vars['entity'];

if (!$bookmark) {
	return '';
}
		
$info = elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$info .= "<a target='_blank' href=\"{$bookmark->address}\">{$bookmark->title}</a>";
		
$icon = "<a href='{$bookmark->address}'><img src='{$bookmark->getIconURL('tiny')}' border='0' /></a>";
	
//display
echo elgg_view_image_block($icon, $info);
