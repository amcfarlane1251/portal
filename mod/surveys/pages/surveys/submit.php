<?php
/**
 * Submit a survey
 * @package elggPages
*/

gatekeeper();

elgg_pop_breadcrumb();
$vars = survey_prepare_form_vars();

$content = elgg_view_form('surveys/submit', array('enctype' => 'multipart/form-data'), $vars);


$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => 'Whole of Government Practitioners Workshop on National Security Issues - Survey'
));

echo elgg_view_page($title, $body);