<?php
/**
 * Riverajaxmodule Container
 * This view simply provides a pretty 'box' for the rivarajaxmodule content
 *
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 * @uses $vars['container_guid'] 	Container guid for content
 * @uses $vars['tag']				Tag to match
 * @uses $vars['subtypes'] 			Subtypes
 * @uses $vars['title'] 			Module title
 * @uses $vars['limit] 				Limit
 * @uses $vars['listing_type']		Type of listing to use (optional)
 * @uses $vars['module_type']		Type of module (info|aside|featured|etc..)
 * @uses $vars['module_class'] 		Class for module
 * @uses $vars['module_id']			ID for module
 */


$body = elgg_view('modules/riverfilter');

$vars['loadaction'] = 'river';

$body .= "<div id='activity-updates'></div>";

$body .= elgg_view('modules/content/river', $vars);

$options = array(
	'id' => $vars['module_id'],
	'class' => $vars['module_class'],
);

$module_type = $vars['module_type'] ? $vars['module_type'] : 'info'; // Default type

echo elgg_view_module($module_type, $vars['title'], $body, $options);
