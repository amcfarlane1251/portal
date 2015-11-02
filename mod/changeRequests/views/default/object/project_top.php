<?php
/**
 * View for project object
 *
 * @package ElggPages
 *
 * @uses $vars['entity']    The project object
 * @uses $vars['full_view'] Whether to display the full view
 * @uses $vars['revision']  This parameter not supported by elgg_view_entity()
 */


$full = elgg_extract('full_view', $vars, FALSE);
$project = elgg_extract('entity', $vars, FALSE);
$revision = elgg_extract('revision', $vars, FALSE);

if (!$project) {
	return TRUE;
}

// projects used to use Public for write access
if ($project->write_access_id == ACCESS_PUBLIC) {
	// this works because this metadata is public
	$project->write_access_id = ACCESS_LOGGED_IN;
}


if ($revision) {
	$annotation = $revision;
} else {
	$annotation = $project->getAnnotations('project', 1, 0, 'desc');
	if ($annotation) {
		$annotation = $annotation[0];
	}
}

$project_icon = elgg_view('projects/icon', array('annotation' => $annotation, 'size' => 'small'));

$editor = get_entity($annotation->owner_guid);
$editor_link = elgg_view('output/url', array(
	'href' => "projects/owner/$editor->username",
	'text' => $editor->name,
	'is_trusted' => true,
));

$date = elgg_view_friendly_time($annotation->time_created);
$editor_text = elgg_echo('projects:strapline', array($date, $editor_link));
$tags = elgg_view('output/tags', array('tags' => $project->tags));
$categories = elgg_view('output/categories', $vars);

$comments_count = $project->countComments();
//only display if there are commments
if ($comments_count != 0 && !$revision) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $project->getURL() . '#project-comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'projects',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$editor_text $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets') || $revision) {
	$metadata = '';
}

if ($full) {
$status = elgg_get_excerpt($project->status);

	$body = elgg_view('output/longtext', array('value' => $annotation->value));

	$params = array(
		'entity' => $project,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);
	echo elgg_view('object/elements/full', array(
		'entity' => $project,
		'title' => false,
		'icon' => $project_icon,
		'summary' => $summary,
		
	));
?>
<div class="project-stats">
			<p>
				<span class="label"><?php echo elgg_echo("Description"). ": " ?></span><?php echo elgg_get_excerpt($project->description);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo("Type"). ": " ?></span><?php echo elgg_get_excerpt($project->project_type);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo('Cost') . ": " ?></span><?php echo elgg_get_excerpt($project->cost);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo("Organization") . ": " ?></span><?php echo elgg_get_excerpt($project->organization);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo('Funding Source') . ": " ?></span><?php echo elgg_get_excerpt($project->funding);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo("Start Date") . ": " ?></span><?php echo elgg_get_excerpt($project->start_date);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo('End Date') . ": " ?></span><?php echo elgg_get_excerpt($project->end_date);?>
			</p>
			<p>
				<span class="label"><?php echo elgg_echo('Status') . ": " ?></span>
							<?php echo $status; ?>
			</p>
<?php
} else {
	// brief view

	$excerpt = elgg_get_excerpt($project->description);

	$params = array(
		'entity' => $project,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	echo elgg_view_image_block($project_icon, $list_body);
}
