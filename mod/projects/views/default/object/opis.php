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

$opis = get_opis($projectId);

if($opis){
	$content = "<p class='label'>OPI's</p>";
	foreach($opis as $opi){
		$content .= elgg_view_entity($opi, array('full_view' => false));
	}
}

echo $content;
