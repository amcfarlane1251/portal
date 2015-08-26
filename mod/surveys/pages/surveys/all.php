<?php
/**
 * all survey submission
 * @package elggPages
*/

gatekeeper();

$surveyGuid = get_input('guid');

if($surveyGuid){
	$title = elgg_echo("surveys:submissions:all"); 

	$content = elgg_list_entities(array(
		'types' => 'object',
		'subtypes' => 'survey_submission',
		'container_guid' => $surveyGuid,
		'full_view' => false,
	));

	$body = elgg_view_layout('content', array(
		'filter_context' => 'all',
		'content' => $content,
		'title' => $title
	));

	echo elgg_view_page($title, $body);
}
else{
	$title = elgg_echo("surveys:all"); 

	//elgg_register_title_button();

	$content = elgg_list_entities(array(
		'types' => 'object',
		'subtypes' => 'survey',
		'full_view' => false,
	));

	$body = elgg_view_layout('content', array(
		'filter_context' => 'all',
		'content' => $content,
		'title' => $title
	));

	echo elgg_view_page($title, $body);
}