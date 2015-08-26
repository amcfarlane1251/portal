<?php
/**
 * History of this project
 *
 * @uses $vars['project']
 */

$title = elgg_echo('projects:history');

if ($vars['project']) {
	$options = array(
		'guid' => $vars['project']->guid,
		'annotation_name' => 'project',
		'limit' => 20,
		'reverse_order_by' => true
	);
	$content = elgg_list_annotations($options);
}

echo elgg_view_module('aside', $title, $content);