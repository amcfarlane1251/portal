<?php
/**
 * Search by tag all projects
 *
 */

$url = elgg_get_site_url(). 'projects/search';
$body = elgg_view_form('projects/searchByTag', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
), $vars);

echo elgg_view_module('aside', elgg_echo('projects:search:tagTitle'), $body);