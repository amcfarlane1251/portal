<?php
/**
 * Search for content all projects
 *
 */

$url = elgg_get_site_url(). 'projects/search';
$body = elgg_view_form('projects/search', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
), $vars);

echo elgg_view_module('aside', elgg_echo('projects:search:title'), $body);