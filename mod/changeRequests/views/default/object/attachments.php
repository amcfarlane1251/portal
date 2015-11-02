<?php
/**
 * Page attachments
 *
 * Display attachments for a project
 *
 * @package ElggPages
 *
 * @uses $vars['projectId']
 */
$projectId = $vars['projectId'];

$attachments = elgg_get_entities_from_relationship(array(
	"relationship" => "attachment",
	"relationship_guid" => $projectId,
	"inverse_relationship" => true
	));
if($attachments){
	$content = "<p class='label'>Attachments</p>";
	foreach($attachments as $attachment){
		$content .= elgg_view_entity($attachment, array('full_view' => false));
	}
}
echo $content;
