<?php
/**
 * Ajaxmodule Container
 * This view simply provides a pretty 'box' for the ajaxmodule content
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
 * @uses $vars['restrict_tag']		Only display content from container WITH tag (not both)
 * @uses $vars['module_type']		Type of module (info|aside|featured|etc..)
 * @uses $vars['module_class'] 		Class for module
 * @uses $vars['module_id']			ID for module
 * @uses $vars['hide_empty']        Hide if empty
 */

$vars['loadaction'] = 'entities';

$body = elgg_view('modules/content/entities', $vars);

$options = array(
	'id' => $vars['module_id'],
	'class' => $vars['module_class'],
);

// Don't display anything if the module will be empty
if ($vars['hide_empty']) {
	$options['class'] = $options['class'] . ' hidden';
}


$module_type = $vars['module_type'] ? $vars['module_type'] : 'info'; // Default type

echo elgg_view_module($module_type, $vars['title'], $body, $options);
