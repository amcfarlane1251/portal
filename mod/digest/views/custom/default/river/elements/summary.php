<?php
/**
 * Short summary of the action that occurred
 *
 * @vars['item'] ElggRiverItem
 */
$item = $vars['item'];

$summary = get_river_item_summary($item);
if ($summary == $key) {
	$key = "river:$action:$type:default";
	$summary = elgg_echo($key, array($subject->name, $object_text));
}

echo $summary;