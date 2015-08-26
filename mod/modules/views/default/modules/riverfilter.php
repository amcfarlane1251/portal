<?php
/**
 * Riverajaxmodule Custom River Filter
 *
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */

// Create selection array
$options = array();
$options['type=all'] = elgg_echo('river:select', array(elgg_echo('all')));
$registered_entities = elgg_get_config('registered_entities');

if (!empty($registered_entities)) {
	foreach ($registered_entities as $type => $subtypes) {
		// subtype will always be an array.
		if (!count($subtypes)) {
			$label = elgg_echo('river:select', array(elgg_echo("item:$type")));
			$options["type=$type"] = $label;
		} else {
			foreach ($subtypes as $subtype) {
				$label = elgg_echo('river:select', array(elgg_echo("item:$type:$subtype")));
				$options["type=$type&subtype=$subtype"] = $label;
			}
		}
	}
}

asort($options);

$params = array(
	'id' => 'modules-river-type-selector',
	'options_values' => $options,
);
$selector = $vars['selector'];
if ($selector) {
	$params['value'] = $selector;
}

echo "<label>" . elgg_echo('filter') . " " . elgg_echo('type') . ": </label>";

// Type/subtype filter
echo elgg_view('input/chosen_dropdown', $params);

// Roles filter (if enabled)
if (elgg_is_active_plugin('roles')) {
		
	$params = array(
		'id' => 'modules-river-role-selector',
		'show_all' => TRUE,
	);
	
	echo "<label>" . elgg_echo('role') . ": </label>";
	echo elgg_view('input/roledropdown', $params);
}

