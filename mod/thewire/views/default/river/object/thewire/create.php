<?php
/**
 * File river view.
 */

$object = $vars['item']->getObjectEntity();
$excerpt = strip_tags($object->description);
$excerpt = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\%-\~.]*(\?\S+)?)?)?)@', '<br /><a href="$1"><img src="http://images.thumbshots.com/image.aspx?cid=9noXQ%2flYdII%3d&v=1&w=120&url=$1" border="1" /><br/><br />$1</a>', $excerpt);

$excerpt = thewire_filter($excerpt);

$subject = $vars['item']->getSubjectEntity();
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$object_link = elgg_view('output/url', array(
	'href' => "thewire/owner/$subject->username",
	'text' => elgg_echo('thewire:wire'),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
));

$summary = elgg_echo("river:create:object:thewire", array($subject_link, $object_link));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,
	'summary' => $summary,
));
