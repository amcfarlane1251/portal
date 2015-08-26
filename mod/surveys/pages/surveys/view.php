<?php
/**
 * View a survey submission
 * @package ElggPages
*/

gatekeeper();

$survey_guid = get_input('guid');

$survey = get_entity($survey_guid);

$content = elgg_view_entity($survey, array('full_view' => true));

$title = 'Survey Results';

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title
));

echo elgg_view_page($title, $body);