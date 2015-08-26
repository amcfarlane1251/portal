<?php

echo elgg_view('navigation/menu/topbar/section', array(
	'items' => $vars['menu']['default'],
	'class' => "elgg-menu-topbar elgg-menu-topbar-default title-area",
	'section' => 'default',
	'name' => 'topbar',
));

echo '<section>';
echo elgg_view('navigation/menu/topbar/section', array(
	'items' => $vars['menu']['alt'],
	'class' => "elgg-menu-topbar elgg-menu-topbar-alt",
	'section' => 'default',
	'name' => 'topbar',
));
echo '</section>';

