<?php
/**
 * the wire
 *
 */

$title = "Start a Discussion";
$content .= elgg_view_form('thewire/add', array('name' => 'elgg-wire'));

echo elgg_view_module('thewire', $title, $content);

