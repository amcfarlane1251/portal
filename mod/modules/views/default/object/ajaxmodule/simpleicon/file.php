<?php
/**
 * Modules Custom Documents simpleicon list view.
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$file = $vars['entity'];

if (!$file) {
	return '';
}

// Optional override for file download url
if (get_input('listing_type_override') == 'download_files') {
	$url = "mod/file/download.php?file_guid=$file->guid";
} else {
	$url = $file->getURL();
}

$info = elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$info .= "<a href=\"{$url}\">{$file->title}</a>";

$icon = "<a href='{$file->getURL()}'><img style='margin-left: -3px;' height='22' width='22' src='{$file->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
	