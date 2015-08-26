<?php
/**
 * Modules book simpleicon list view.
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
	
$book = $vars['entity'];

if (!$book) {
	return '';
}

$title = $book->title;

$info .= "<a href=\"{$book->getURL()}\">{$title}</a>";
		
$info .= elgg_view_menu('simpleicon-entity', array(
	'entity' => $vars['entity'],
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));
		
// Authors string
if ($book->authors) {
	$author_label = elgg_echo('readinglist:label:author');
	if (is_array($book->authors)) {
		$authors = implode(", ", $book->authors);
	} else {
		$authors = $book->authors;
	}
	$authors = $author_label . $authors;

	$info .= "<p class='elgg-subtext'>{$authors}</p>";
}

$icon = "<a href='{$book->getURL()}'><img src='{$book->getIconURL('tiny')}' border='0' /></a>";

//display
echo elgg_view_image_block($icon, $info);
