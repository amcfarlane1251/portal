<?php

$item = $vars['item'];

$item_class = $item->getItemClass();
if ($item->getSelected()) {
	$item_class = "$item_class elgg-state-selected";
}

$children = $item->getChildren();
if ($children) {
	$item->addLinkClass('elgg-menu-parent');
	$item_class = "$item_class has-dropdown";
}

echo "<li class=\"$item_class\">";
echo $item->getContent();
if ($children) {
	echo elgg_view('navigation/menu/topbar/section', array(
		'items' => $children,
		'class' => 'elgg-menu elgg-child-menu dropdown',
	));
}
echo '</li>';
