<?php
/**
 * Projects List navigation
 */

$tabs = array(
	'submitted' => array(
		'title' => elgg_echo('projects:label:submitted'),
		'url' => "projects/submitted",
		'selected' => $vars['selected'] == 'submitted',
	),
	'underreview' => array(
		'title' => elgg_echo('projects:label:underreview'),
		'url' => "projects/underreview",
		'selected' => $vars['selected'] == 'underreview',
	),
	'inprogress' => array(
		'title' => elgg_echo('projects:label:inprogress'),
		'url' => "projects/inprogress",
		'selected' => $vars['selected'] == 'inprogress',
	),
	'completed' => array(
		'title' => elgg_echo('projects:label:completed'),
		'url' => "projects/completed",
		'selected' => $vars['selected'] == 'completed',
	),
	'onhold' => array(
		'title' => elgg_echo('projects:label:onhold'),
		'url' => "projects/onhold",
		'selected' => $vars['selected'] == 'onhold',
	),
);

echo elgg_view('navigation/tabs', array('tabs' => $tabs));