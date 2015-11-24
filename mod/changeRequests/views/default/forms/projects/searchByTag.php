<?php

$params = array(
	'name' => 'q',
	'class' => 'elgg-input-search mbm',
	'value' => $tag_string,
);
echo elgg_view('input/text', $params);

echo elgg_view('input/hidden', array(
	'name' => 'searchType',
	'value' => 'tag',
));

echo elgg_view('input/submit', array('value' => elgg_echo('search:go')));