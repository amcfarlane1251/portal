<?php

$class = elgg_extract('class', $vars, '');

foreach ($vars['items'] as $menu_item) {
	$menu_items .= elgg_view('navigation/menu/topbar/item', array(
		'item' => $menu_item,
	));
}

echo "<ul class=\"$class\">" . $menu_items . '</ul>';
