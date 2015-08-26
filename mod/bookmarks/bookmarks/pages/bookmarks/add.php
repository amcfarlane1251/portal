<?php
/**
 * Add bookmark page
 *
 * @package Bookmarks
 */

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('bookmarks:add');
elgg_push_breadcrumb($title);

$vars = bookmarks_prepare_form_vars();

if(elgg_is_xhr()){
			$vars['is_ajax'] = 1;
			$content = elgg_view_form('bookmarks/save', array('id'=>'ajax-form'), $vars);

			echo "<div style='height:500px;'>";
			echo elgg_view_title($title);
			echo $content;
			echo "</div>";
} else {
	$content = elgg_view_form('bookmarks/save', array(), $vars);
	$body = elgg_view_layout('content', array(
		'filter' => '',
		'content' => $content,
		'title' => $title,
	));

	echo elgg_view_page($title, $body);
}