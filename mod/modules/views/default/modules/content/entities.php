<?php
/**
 *  Ajaxmodule content suitable for entities
 *
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 * @uses $vars['container_guid'] 	  Container guid for content
 * @uses $vars['tag']				  Tag to match
 * @uses $vars['tags']                Multiple tags
 * @uses $vars['subtypes'] 			  Subtypes
 * @uses $vars['limit] 				  Limit
 * @uses $vars['listing_type']		  Type of listing to use (optional)
 * @uses $vars['owner_guids']         Restrict content to these owner guids
 * @uses $vars['created_time_upper']  Upper time created limit
 * @uses $vars['created_time_lower']  Lower time created limit
 * @uses $vars['restrict_tag']        Wether to restrict to tag (classic elgg_get_metadata)
 */

// Manually supporting params
$supported_params = array(
	'types',
	'container_guid',
	'tag',
	'tags',
	'subtypes',
	'limit',
	'listing_type',
	'listing_type_override',
	'owner_guids',
	'created_time_upper',
	'created_time_lower',
	'restrict_tag',
	'albums_images',
	'loadaction',
	'access_show_hidden_entities',
	'context',
);

// Unique ID for the module
$id = uniqid();

echo "
	<div id='{$id}' class='ajaxmodule-content-container'>
		<div class='options'>
";

// Build inputs
foreach($supported_params as $param) {
	
	$value = elgg_extract($param, $vars, NULL);
	
	// JSON encode arrays
	if (is_array($value)) {
		$value = json_encode($value);
	}
	
	// Cast booleans
	if (is_bool($value)) {
		$value = (int)$value;
	}
	
	echo elgg_view('input/hidden', array(
		'name' => $param,
		'id' => $param,
		'value' => $value,
		'disabled' => 'disabled',
	));
}

if ($vars['hide_empty']) {
	echo elgg_view('input/hidden', array(
		'name' => 'hide_empty', 
		'id' => 'hide_empty', 
		'value' => 1,
		'disabled' => 'disabled',
	));
}

echo "
		</div>
		<div class='content'>
			<div class='elgg-ajax-loader'></div>
		</div>
	</div>
";
